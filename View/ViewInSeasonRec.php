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
	
	$langID=mysql_result($Recordlist,0,1);
        echo $langID;
	$langList= entity::fetchRecord('languages',$langID);
	$lang=mysql_result($langList,0,1);
	
	$seedRate=mysql_result($Recordlist,0,4);
	$seedTreatment=mysql_result($Recordlist,0,5);
	$sowingDate=mysql_result($Recordlist,0,6);
	$spacing=mysql_result($Recordlist,0,7);
	$fertilizerApplication=mysql_result($Recordlist,0,8);
	$weedControl=mysql_result($Recordlist,0,9);
	$chemicalControl=mysql_result($Recordlist,0,10);
	$harvesting=mysql_result($Recordlist,0,11);
	$extra_Info=mysql_result($Recordlist,0,15);
	$striga=mysql_result($Recordlist,0,12);
	$disease=mysql_result($Recordlist,0,13);
	$IPM=mysql_result($Recordlist,0,14);
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
      <div id="Success">Record was Successfully <?php if($action=='add') echo "Inserted";  if($action=='update') echo "Updated"; ?></div>
      <?php
	  }
	  ?>
      <table width="100%"  class="recordTable" cellpadding="5" >
       <tr id="entityRowOdd">
          <td width="218">Crop  Name</td>
          <td width="420"><?php	 echo ucfirst($cropName);  	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Language</td>
          <td width="420"><?php	 echo  htmlspecialchars_decode($lang); 	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Seed Rate</td>
          <td width="420"><?php	
          $list=splitContent($seedRate);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  } 	  ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Seed Treatment</td>
          <td width="420"><?php	  
          $list=splitContent($seedTreatment);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Sowing Dates</td>
          <td width="420"><?php	  
            $list=splitContent($sowingDate);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Spacing</td>
          <td width="420"><?php	   
          $list=splitContent($spacing);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Fertilizer Application</td>
          <td width="420"><?php	  
          $list=splitContent($fertilizerApplication);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Weed Control</td>
          <td width="420"><?php	  
          $list=splitContent($weedControl);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
            ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Chemical Control</td>
          <td width="420"><?php	 

          $list=splitContent($chemicalControl);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Harvesting</td>
          <td width="420"><?php	 
          $list=splitContent($harvesting);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Striga</td>
          <td width="420"><?php	  
          $list=splitContent($striga);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Diseases</td>
          <td width="420"><?php	 
          $list=splitContent($disease);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  }
          ?></td>
        </tr>
        <tr id="entityRowEven">
          <td width="218">Integtreated Pest Management<br /></td>
          <td width="420"><?php	 
          $list=splitContent($IPM);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  } 	  ?></td>
        </tr>
        <tr id="entityRowOdd">
          <td width="218">Extra-Info</td>
          <td width="420"><?php	  $list=splitContent($extra_Info);
              foreach ($list as $value) {
                 echo  htmlspecialchars_decode($value).'<br>';  } 	  ?></td>
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
