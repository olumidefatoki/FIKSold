<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if(isset($_GET['action']) && isset($_GET['id'])&& isset($_SESSION['username']))
    {	
        $username=$_SESSION['username'];
        $action=trim($_GET['action']);
        $recID=$_GET['id'];
        $menuName=$_SESSION['menuName'];
        $entityName=$_SESSION['menuTableName'];
       
        $menuList=entity::fetchMenu();
        $menuRow=mysql_num_rows($menuList);
    }

    else if(isset($_GET['action']) && isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
        $menuName=$_SESSION['menuName'];
        $action=trim($_GET['action']);
        $entityName=$_SESSION['menuTableName'];
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
        <?php  if($action=='add'){
		echo 'Add New '.$menuName;
		}
		 else if($action=='update'){
			  echo 'Update  '.$menuName;
			  } ?> Details
       </div>
      <div id ="FormHeader">
      Please fill all fields
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" border="0" cellpadding="3"  class="recordTable">
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="205">Access Channel</td>
            <td width="438"><label for="fName"></label>
              <select name="accessChannel" id="accessChannel">
                <option value="Web">Web</option>
                <option value="Mobile">Mobile</option>
                
              </select></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowEven">
            <td> Language</td>
            <td><label for="fName"></label>
              <select name="langID" id="langID">
                <?php  
			$cropList=entity::fetchEntityList('languages');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                <option value="<?php echo $fertid; ?>"> <?php echo $fertName; ?></option>
                <?php  
			}
			?>
              </select></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Site Selection   </td>
            <td>
              <textarea name="SiteSelection" cols="50" rows="3" id="SiteSelection"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Farm    Management</td>
            <td><label for="gender"></label>
              <textarea name="FarmManagement" cols="50" rows="3" id="FarmManagement"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Water Supply Quality/Availability</td>
            <td>            <span >
              <textarea name="WaterSupplyQuality" cols="50" rows="3" id="WaterSupplyQuality"><?php if($action=='update'){echo $seedTreatment;} ?>
              </textarea>
            </span></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Fish Feeds Quality</td>
            <td><textarea name="FishFeeds" cols="50" rows="3" id="FishFeeds" $description="$description"><?php if($action=='update'){echo $sowingDate;} ?>
            </textarea></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>Pond Management</td>
            <td>
              <textarea name="PondManagement" cols="50" rows="3" id="PondManagement"><?php if($action=='update'){echo $spacing;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Fish Stock</td>
            <td><textarea name="FishStock" cols="50" rows="3" id="FishStock" $description="$description"><?php if($action=='update'){echo $fertilizerApp;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Processing</td>
            <td><textarea name="Processing" cols="50" rows="3" id="Processing" $description="$description"><?php if($action=='update'){echo $weedControl;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Harvest</td>
            <td><textarea name="Harvest" cols="50" rows="3" id="Harvest" $description="$description"><?php if($action=='update'){echo $weedControl;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Fish Disease</td>
            <td><textarea name="FishDisease" cols="50" rows="3" id="FishDisease" $description="$description"><?php if($action=='update'){echo $chemicalControl;} ?>
            </textarea></td>
          </tr><tr id="entityRowOdd">
            <td>Treatment </td>
            <td><textarea name="Treatment" cols="50" rows="3" id="Treatment" $description="$description"><?php if($action=='update'){echo $harvesting;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Business Plan</td>
            <td><textarea name="BusinessPlan" cols="50" rows="3" id="BusinessPlan" $description="$description"><?php if($action=='update'){echo $striga;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Extra Info </td>
            <td><textarea name="extraInfo" cols="50" rows="3" id="extraInfo" $description="$description"><?php if($action=='update'){echo $extra_Info;} ?>
            </textarea></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowEven">
            <td>&nbsp;</td>
            <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>" /></td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php'; ?>
        </ul>
      </div>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  
  </div>
  
  <?php
  mysql_close();
  ?>
  <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
