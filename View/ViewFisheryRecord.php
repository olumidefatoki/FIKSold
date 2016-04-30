<?php
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
    if(isset($_GET['ViewFishRecord'])&& isset($_SESSION['username']))
    {	
        $username=$_SESSION['username'];
        
        $recID=$_GET['ViewFishRecord'];
        $menuName=$_SESSION['menuName'];
        $entityName=$_SESSION['menuTableName'];
        $result= entity::fetchRecord($entityName,$recID);
        $row=mysql_num_rows($result);
            $langID=mysql_result($result,0,1);
            $langList=entity::fetchRecord('languages',$langID);
         $lang=mysql_result($langList,0,1);
            $accessChannel=mysql_result($result,0,2);
            $SiteSelection =mysql_result($result,0,3);      
            $FarmManagement=mysql_result($result,0,4);
            $WaterSupplyQuality=mysql_result($result,0,5);
            $FishFeeds=mysql_result($result,0,6);
            $PondManagement=mysql_result($result,0,7);
            $FishStock=mysql_result($result,0,8);
            $Processing=mysql_result($result,0,9);
            $Harvesting=mysql_result($result,0,10);
            $FishDisease=mysql_result($result,0,11);
            $Treatment =mysql_result($result,0,12);
            $BusinessPlan=mysql_result($result,0,13);
	
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
 <script type="text/javascript" src="../script/customscripts.js"></script>
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <div id="header"><div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
      <div id="view">
       <div id="addRecord">
        <div id='Success'><img src='../images/s_success.png'/> Record was Successfully Added </div>
       </div>
      <div id ="FormHeader"></div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" border="0" cellpadding="3"  class="recordTable">
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="205">Access Channel</td>
            <td width="438"><?php echo $accessChannel; ?></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowEven">
            <td> Language</td>
            <td><?php echo $lang; ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Site Selection   </td>
            <td> <?php
														$list=splitContent($SiteSelection);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowEven">
            <td>Farm    Management</td>
            <td> <?php
														$list=splitContent($FarmManagement);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Water Supply Quality/Availability</td>
            <td>
            <?php
														$list=splitContent($WaterSupplyQuality);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Fish Feeds Quality</td>
            <td>
            <?php
														$list=splitContent($FishFeeds);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?>
            </td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>Pond Management</td>
            <td>
             <?php
														$list=splitContent($PondManagement);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?>
            </td>
          </tr>
          <tr id="entityRowEven">
            <td>Fish Stock</td>
            <td> <?php
														$list=splitContent($FishStock);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Processing</td>
            <td> <?php
														$list=splitContent($Processing);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Harvest</td>
            <td> <?php
														$list=splitContent($Harvesting);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowEven">
            <td>Fish Disease</td>
            <td> <?php
														$list=splitContent($FishDisease);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr><tr id="entityRowOdd">
            <td>Treatment </td>
            <td> <?php
														$list=splitContent($Treatment);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
          <tr id="entityRowEven">
            <td>Business Plan</td>
            <td> <?php
														$list=splitContent($BusinessPlan);
             											 foreach ($list as $value) {
               											  echo  htmlspecialchars_decode($value).'<br>';
															 }
														 ?></td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
           <?php 
        $roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==2) {
        include'sideMenu.php'; 
                }}
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
