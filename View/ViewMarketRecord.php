<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
if(  isset($_GET['ViewRecord'])&& isset($_SESSION['username']))
{
	
$username=$_SESSION['username'];

$recID=$_GET['ViewRecord'];
$_SESSION['menuName']='Markets';
$_SESSION['menuTableName']='Markets';
$menuName=$_SESSION['menuName'];
$entityName=$_SESSION['menuTableName'];
$result= entity::fetchRecord($entityName,$recID);
$row=mysql_num_rows($result);
$recID=  mysql_result($result, 0, 0);
$marketName=  mysql_result($result, 0, 1);
$marketAddress=  mysql_result($result, 0, 2);
		$stateID=mysql_result($result,0,5);
        $stateRow=  entity::fetchState('states', $stateID);
        $state=mysql_result($stateRow,0,2);
	    $lgaID=mysql_result($result,0,4);
        $lgaRow=  entity::fetchLGARecord('lga', $lgaID);
        $lga=mysql_result($lgaRow,0,2);
        $wardID=mysql_result($result,0,3);
        $wardRow=  entity::fetchWardRecord('wards', $wardID);
        $ward=mysql_result($wardRow,0,3);
$marketday= mysql_result($result, 0, 6);
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
}


else{
	header('location:../index.php');
}


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fadama Information Knowledge &amp; Services</title>

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
      <div id="view">
       <div id="addRecord">
        Market Details  
        </div>
      <div style="color:#FFF;"></div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
        
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="139"> Name</td>
            <td width="257"><?php echo $marketName; ?></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Market Address</td>
            <td><?php echo $marketAddress; ?></td>
          </tr>
         <tr id="entityRowOdd">
            <td>State </td>
            <td><?php echo $state; ?></td>
          </tr>
          <tr id="entityRowEven">
            <td>LGA </td>
            <td><?php echo $lga; ?>
            </td>
          </tr>
          <tr id="entityRowOdd">
            <td>Ward </td>
            <td><?php echo $ward; ?>
            </td>
          </tr>
          <tr id="entityRowEven">
            <td>Market Day </td>
            <td><?php echo $marketday; ?></td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
              <?php
                        $UserType = $_SESSION['UserType'];
                        $roles = $_SESSION['Roles'];
                        $rolesList = explode(",", $roles);
                        foreach ($rolesList as $value) {
                            if ($value == 2) {
                                include'sideMenu.php';
								echo "<li> <a  href='../Controller/RequestController.php?update&redID=$recID'>Update</a> </li>";
								echo "<li><a href='../Controller/RequestController.php?marketID=$recID&viewCropSold'>View Crop Sold</a></li>";
								echo "<li><a href='../Controller/RequestController.php?marketID=$recID&viewLivestockSold'>View Livestock Sold</a></li>";
                            }
                        }
                        if ($UserType == 'State') {
                            include'sideMenu.php';
							echo "<li> <a  href='../Controller/RequestController.php?update&redID=$recID'>Update</a> </li>";
							echo 	"<li><a href='../Controller/RequestController.php?marketID=$recID&viewCropSold'>View Crop Sold</a></li>";
							echo "<li><a href='../Controller/RequestController.php?marketID=$recID&viewLivestockSold'>View Livestock Sold</a></li>";
                        }
                        ?>
                        </ul>
      </div>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  
  </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
