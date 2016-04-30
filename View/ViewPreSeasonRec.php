<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if(isset($_GET['ViewRecord']) && $_SESSION['menuName']  && isset($_SESSION['username']))
{	
$username=$_SESSION['username'];

$menuTableName= $_SESSION['menuTableName'];
$menuName=$_SESSION['menuName'];
$recID=$_GET['ViewRecord'];

//$menuTableName=entity::previousTable($menuTableName);

$Recordlist=  entity::fetchRecord($menuTableName,$recID);
$recordRow=mysql_num_rows($Recordlist);
if($recordRow>0)
{
	$cropID=mysql_result($Recordlist,0,3);
	$cropList= entity::fetchRecord('crops',$cropID);
	$cropName=mysql_result($cropList,0,1);
	$accessChannel=	mysql_result($Recordlist,0,2);
	$langID=mysql_result($Recordlist,0,1);
	$langList= entity::fetchRecord('languages',$langID);
	$lang=mysql_result($langList,0,1);
	
	$siteSelection=mysql_result($Recordlist,0,4);
	$landPreparation=mysql_result($Recordlist,0,5);
	$ploughing=mysql_result($Recordlist,0,6);
	$harrowing=mysql_result($Recordlist,0,7);
	$ridging=mysql_result($Recordlist,0,8);
	$extraInfo=mysql_result($Recordlist,0,9);
	
}
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);

$entityList=entity::fetchRecord($menuTableName,$recID);
$entityName=mysql_result($entityList,0,0);
}
else{
	header('location:index.php');
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
      <div id="viewHeader">
      List <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" /> 
          <?php echo strtoupper($menuName).'S';?></div>
        <div style="color:#044407; font-size:x-large; font-weight:bold; margin:7px auto;">
          Current Record Details
        </div>
      <?php
	  if(isset($_GET['action'])){
		  $action=$_GET['action'];
		  if( $action=='add')
		  $msg='Added';
		  if($action=='update')
		  $msg='Updated';
	  
      echo "<div id='Success'> <img src='../images/s_success.png'/>  Record was Successfully  {$msg} </div>";
      
	  }
	  ?>
      <table width="100%" cellpadding="5"  class="recordTable" >
       
        <tr id="entityRowEven">
          <td width="218">Crop  Name</td>
          <td width="420"><?php	 echo ucfirst($cropName);  	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Access Channel</td>
          <td width="420"><?php	  echo $accessChannel ;  	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Languages</td>
          <td width="420"><?php	  echo $lang ;  	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Site Selection</td>
          <td width="420">
              <?php 
              $list=splitContent($siteSelection);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';
              }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Land Preparation</td>
          <td width="420">
              <?php	 
              $list=splitContent($landPreparation);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Ploughing</td>
          <td width="420">
              <?php	 
              $list=splitContent($ploughing);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';}	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Harrowing</td>
          <td width="420"><?php	  $list=splitContent($harrowing);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  } 	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Ridging</td>
          <td width="420">
              <?php	  $list=splitContent($ridging);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';	}  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Extra Info</td>
          <td width="420">
              <?php	 $list=splitContent($extraInfo);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }	  ?></td>
        </tr>
        
    </table>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php';
		echo "<li>";
           echo "<a href='../Controller/RequestController.php?update&redID=$recID'>Update</a>";
		   echo "</li>";
		    ?>
		
        
        </ul>
      </div>
  </div>
  
  </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
