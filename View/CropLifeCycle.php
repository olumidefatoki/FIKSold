<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');

//session_start();
if (isset($_POST['Search'])) 
    {
    $displayTitle=true;
    $username = $_SESSION['username'];
    $errorList=cropCycleErrorCheck($_POST);
    if (count($errorList)<1) {
        entity::DbConnect();
        $season=clean($_POST['season']);
        $PackagePractise=clean($_POST['PackagePractise']);
        $crop=clean($_POST['crop']);
        $lang=clean($_POST['langID']);
        $searchRow=entity::fetchPractise($season,$PackagePractise,$crop,$lang);
        $row=mysql_num_rows($searchRow);
        if ($row>0) {
            $searchResult=mysql_result($searchRow,0,0);
			$cropName=mysql_result($searchRow,0,1);            
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
       <script type="text/javascript" src="../script/jquery.min.js"></script> 
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){
$("#season").change(function(){	
var id=$(this).val();
$("#Practiseloading").css("display","inline-block");

var dataString ='seasonType='+id;
$.ajax({
type: "GET",
url: "../Controller/RequestController.php",
data: dataString,
cache: false,
success: function(html){	
$("#PackagePractise").html(html);
$("#Practiseloading").css("display","none");
} }); }); });
</script>
</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
              <div id="post">
                <div id="subMenu">
                      <?php 
        $roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==2) {
					?>
         <ul>
            <li> <a class="sideMenuButton" href="<?php echo"SelectSeason.php?add" ;?> ">Manage Package Of Practise</a> </li>
            
         </ul>
              <?php 
                }}
				?>
         


                </div>
                <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">View Package of Practise 

                        </div>
                        <?php
                        if (isset($error)) {
                           echo "<div id ='errorMsg'>Please select * field</div>";
                            
                        }
                        unset($error);
                        ?>
                  <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="CropLifeCycle.php">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="25%" height="37">Crop Lifecycle</td>
                                        <td width="75%"><select name="season" id="season" onchange="composeEntities('season','PackagePractise','seasonType','Practiseloading');" style="width:250px;" >
                                          <option value="-1" >Select a Lifecycle</option>
                                          <option value="pre_season">Pre Season</option>
                                          <option value="post_season">Post Season</option>
                                          <option value="in_season">In Season</option>
                                      </select></td>
                                        
                                  </tr>
                                    <tr>
                                            <td>Package of Practise</td>
                                            <td><select name="PackagePractise" id="PackagePractise" style="width:250px;" >
                                              <option  value="-1">Select  Package of Practise</option>
                                      </select>
                                      <div id="Practiseloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>

                                  </tr>
                                    <tr>
                                              <td>Crop Name</td><td><select name="crop" id="crop"  style="width:250px;">
                                          <option value="-1">Select a Crop</option>
                                                      <?php  
			$cropList=entity::fetchEntityList('crops');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                                                      <option value="<?php echo $fertid; ?>"> <?php echo ucfirst($fertName); ?></option>
                                                      <?php  
			}
			?>
                                                    </select></td>
                                    </tr>
                                                <tr>
                                                    <td> Language</td>
                                                    <td><select name="langID" id="langID"  style="width:250px;">
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
													    <td width="9%">CROP NAME</td>
														  <td width="8%">Crop LifeCycle</td>
												      <td width="70%">PACKAGE DETAILS</td></tr>
                                                      <?php if ($row>0){
														  ?>
                                                      <tr  id="entityRowEven"><td valign="top"><?php echo strtoupper($PackagePractise); ?></td>
                                                          <td valign="top"><?php echo strtoupper($cropName); ?></td>
                                                          <td valign="top"><?php echo strtoupper($season); ?></td>
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
