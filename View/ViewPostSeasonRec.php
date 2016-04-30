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

$menuTableName=entity::previousTable($menuTableName);

$Recordlist=  entity::fetchRecord($menuTableName,$recID);
$recordRow=mysql_num_rows($Recordlist);
if($recordRow>0)
{
	$cropID=mysql_result($Recordlist,0,3);
	$cropList= entity::fetchRecord('crops',$cropID);
	$cropName=mysql_result($cropList,0,1);
		
	$langID=mysql_result($Recordlist,0,1);
	$langList= entity::fetchRecord('languages',$langID);
	$lang=mysql_result($langList,0,1);
	
	$processing=mysql_result($Recordlist,0,4);
	$delivery=mysql_result($Recordlist,0,5);
	$storage=mysql_result($Recordlist,0,6);
	$farmBusinessPlaning=mysql_result($Recordlist,0,7);
	$farmerFinancing=mysql_result($Recordlist,0,8);
	$rawMaterial=mysql_result($Recordlist,0,9);
        $extraInfo=mysql_result($Recordlist,0,10);
	
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
                  <?php echo strtoupper($menuName).'S';?>
		  <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" />
		  <?php echo $entityName; ?>
          </div>
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
	  ?>
      <div id="Success">Record was Successfully </div>
      <?php
	  }
	  ?>
      <table width="100%" cellpadding="5"  class="recordTable" >
       
        <tr id="entityRowEven">
          <td width="190">Crop  Name</td>
          <td width="512"><?php	 echo  ucfirst($cropName);  	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="190">Language</td>
          <td width="512"><?php	  echo $lang;  	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="190">Processing</td>
          <td width="512"><?php	 
           $list=splitContent($processing);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="190">Delivery</td>
          <td width="512"><?php	  
           $list=splitContent($delivery);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="190">Storage</td>
          <td width="512"><?php	  
           $list=splitContent($storage);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="190">Farm Business Planning</td>
          <td width="512"><?php	  
           $list=splitContent($farmBusinessPlaning);
              foreach ($list as $value) {
                 echo  $value.'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="190">Farmer Financing</td>
          <td width="512"><?php	  
           $list=splitContent($farmerFinancing);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
          <tr id="entityRowOdd">
          <td width="190">Raw Material Specification</td>
          <td width="512"><?php	 
          $list=splitContent($rawMaterial);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  } 	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="190">Extra Info</td>
          <td width="512"><?php	 
          $list=splitContent($extraInfo);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }  	  ?></td>
        </tr>
        
    </table>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php'; ?>
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
