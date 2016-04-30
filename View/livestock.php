<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_POST['Search'])) {
    $displayTitle=true;
    $username = $_SESSION['username'];
    $errorList=livestockErrorCheck($_POST);
    if (count($errorList)<1) {
        
        $PackagePractise=clean($_POST['PackagePractise']);
        $livestockName=clean($_POST['livestockName']);
        $lang=clean($_POST['langID']);
        $searchRow=entity::fetchLivestockPractise($livestockName,$PackagePractise,$lang);
        $row=mysql_num_rows($searchRow);
        if ($row>0) {
            $searchResult=  mysql_result($searchRow, 0, 0);
        }
        }
    else{
        $displayTitle=false;
        $error=$errorList;
    }
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} elseif (isset($_SESSION['menuName'])  && isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
    $displayTitle=false;
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);

    //to make pagination
} else {
    header('location:../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Fadama Information Knowledge &amp; Services</title>
       <script type="text/javascript" src="../script/customscripts.js"></script>
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
              <div id="post">
                <div id="subMenu">
                  <ul>
                    <li> <a class="sideMenuButton" href="SelectSeason.php">Manage Livestock</a> </li>
                  </ul>


                </div>
                <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">View Animal 

                        </div>
                        <?php
                        if (isset($error)) {
                           echo "<div id ='errorMsg'>Proccess Failed: Invalid Data Selection</div>";
                            
                        }
                        unset($error);
                        ?>
                  <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="livestock.php">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                            <td width="25%"> Name</td>
                                            <td width="75%"><select name="livestockName" id="livestockName"   style="width:200px;">
                                            <option value="-1">Select  Livestock--</option>
                                              <?php  
			$cropList=entity::fetchEntityList('livestock');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                                              <option value="<?php echo $fertName; ?>"> <?php echo $fertName; ?></option>
                                              <?php  
			}
			?>
                                      </select></td>

                                  </tr>
                                    <tr>
                                              <td>Package of Practise</td><td>
                                                    <select name="PackagePractise" id="PackagePractise" style="width:200px;">
                                                        <option value="-1">Select PackagePractise</option>
															<?php  
			$result=entity::fetchEntityList('fishery');
     $col= mysql_num_fields($result);
      for ($index = 3; $index < $col; $index++) {
        $fieldname=mysql_fieldname($result, $index);
        $id=$fieldname;
        $data=$fieldname;
      
			?>
                                              <option value="<?php echo $id; ?>"> <?php echo $data; ?></option>
                                              <?php  
			}
			?>			
                                                    </select><div id="Practiseloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div>
                                                </td>
                                    </tr>
                                                <tr>
                                                    <td> Language</td>
                                                    <td><select name="langID" id="langID"  style="width:200px;">
                                                    <option value="-1">Select  Language</option>
                                                      <?php  
			$cropList=entity::fetchEntityList('languages');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                                                    <option value="<?php echo $fertid; ?>"> <?php echo ucfirst($fertName); ?></option>
                                                      <?php  
			}
			?>
                                                  </select></td></tr>
                                                    <tr><td colspan="2" align="center">  <input type="submit" value="Search" name="Search" id="Search" /></td>
                                                    </tr>
                              </table>
                          </form>
                  </div>
                                                   <?php
                                           if ($displayTitle==true) {
                                                           

                                                       ?>
                                                    <table width="100%" cellpadding="3" class="recordTable" >
													  <tr valign="middle" bgcolor="#96C000">
													    <td width="13%">PACKAGE OF PRACTICE</td>
													    <td width="9%">LIVESTOCK NAME</td>
												      <td width="70%">PACKAGE DETAILS</td></tr>
                                                      <?php if ($row>0){
														  ?>
                                                      <tr  id="entityRowEven"><td valign="top"><?php echo strtoupper($PackagePractise); ?></td>
                                                          <td valign="top"><?php echo strtoupper($livestockName); ?></td>
                                                      <td valign="top"><?php
														$list=splitContent($searchResult);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode(ucfirst($value)).'<br>';
															 }
														 ?></td></tr>
                                                      <?php
														  }
														  else{
														  ?>
                                                      <tr bgcolor="#96CA1D">
                                                        <td colspan="8" align="center">No Record Found</td>
                                                      </tr>
                                                       <?php
														  }
														  ?>
                  </table>
                                            <?php
                                                  }
                                                 ?>
                </div>
                                                       
              </div>

                                                        </div>
                                                       <div id="footer">
   <?php include'footer.php';?>
  </div>
                                                        </div>
                                                        </body>
                                                        </html>
