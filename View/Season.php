<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');

//session_start();
if (isset($_POST['View'])) {
    $displayTitle=true;
    $displayUpdate=false;
    $username = $_SESSION['username'];
    $errorList=seasonCheck($_POST);
   $menuTableName= $_SESSION['menuTableName'];
    $menuName=$_SESSION['menuName'];
    if (count($errorList)<1) {    
	    entity::DbConnect();    
        $PackagePractise=clean($_POST['PackagePractise']);
        $crop=clean($_POST['crop']);
        $lang=clean($_POST['langID']);
        $accessChannel=clean($_POST['accessChannel']);
        $searchRow=entity::fetchSeasonPractise($menuTableName,$PackagePractise,$crop,$lang,$accessChannel);
        $row=mysql_num_rows($searchRow);
        if ($row>0) {
			$displayUpdate=true;
            $searchResult=mysql_result($searchRow,0,0);
			$cropName=mysql_result($searchRow,0,1);   
			$lang=mysql_result($searchRow,0,2);
            $seasonID=mysql_result($searchRow,0,3);
    }}
    else{
        $displayTitle=false;
        $error=$errorList;
    }
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} elseif (isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
    $displayTitle=false;
	$displayUpdate=false;
    $menuTableName= $_SESSION['menuTableName'];
    $menuName=$_SESSION['menuName'];
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
                  <?php include'sideMenu.php';?> 
                  <?php if($displayUpdate==true){
                    echo "<li>";
           echo "<a href='../Controller/RequestController.php?update&redID=$seasonID'>Update</a>";
		   echo "</li>";
       			} ?>
                </ul>
                </div>
                <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;"><?php echo $menuName.'s'; ?></div>
                        <?php
                        if (isset($error)) {
                           echo "<div id ='errorMsg'>Oops!!! Please select data for all the fields</div>";
                            
                        }
                        unset($error);
                        ?>
                  <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="Season.php">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                            <td width="25%">Crop Name</td>
                                            <td width="75%"><select name="crop" id="crop"  style="width:200px;">
                                            <option value="-1">Select a Crop</option>
                                              <?php  
			$cropList=entity::fetchEntityList('crops');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                                              <option value="<?php echo $fertid; ?>"> <?php echo strtoupper($fertName); ?></option>
                                              <?php  
			}
			?>
                                          </select></td>

                                  </tr>
                                  <tr>
                                              <td>Package of Practise</td><td>
                                                    <select name="PackagePractise" id="PackagePractise"   style="width:200px;">
                                                        <option value="-1">Select a Package Practise </option>
                                                        <?php
                                                            $result=entity::fetchEntityList($menuTableName);
                                                            $col= mysql_num_fields($result);
                                                            for ($index = 4; $index < $col; $index++) {
                                                                $fieldname=mysql_fieldname($result, $index);
                                                                $id=$fieldname;
                                                                $data=$fieldname;
                                                                
                                                            ?>
                                                        <option value="<?php echo $id; ?>"> <?php echo ucfirst($data); ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                    </tr>
                                    <tr>
                                              <td>Access Channel</td><td>
                                                    <select name="accessChannel" id="accessChannel"   style="width:200px;">
                                                        <option value="Web">Web</option>
                                                        <option value="Mobile">Mobile</option>

                                                    </select>
                                                </td>
                                    </tr>
                                                <tr>
                                                    <td> Language</td>
                                                    <td><select name="langID" id="langID"  style="width:200px;">
                                                    <option value="-1">Select a Language</option>
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
                                                    <tr><td colspan="2" align="center">  <input type="submit" value="View" name="View" id="View" /></td>
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
													    <td width="9%">CROP NAME</td>
														  <td width="8%">Language</td>
												      <td width="70%">PACKAGE DETAILS</td></tr>
                                                      <?php if ($row>0){
														  ?>
                                                      <tr  id="entityRowEven"><td valign="top"><?php echo strtoupper($PackagePractise); ?></td>
                                                          <td valign="top"><?php echo strtoupper($cropName); ?></td>
                                                          <td valign="top"><?php echo strtoupper($lang); ?></td>
                                                      <td valign="top"><?php
														$list=splitContent($searchResult);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td></tr>
                                                      <?php
														  }
														  else{
														  ?>
                                                      <tr bgcolor="#96CA1D">
                                                        <td colspan="9" align="center">No Record Found</td>
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
