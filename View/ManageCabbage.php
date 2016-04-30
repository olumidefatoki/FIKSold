<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if(isset($_GET['action']) && isset($_GET['id']))
    {	
        $username=$_SESSION['username'];
        $action=trim($_GET['action']);
        $recID=$_GET['id'];
        $menuName=$_SESSION['menuName'];
        $entityName=$_SESSION['menuTableName'];
        $result= entity::fetchRecord('cabbages',$recID);
        $row=mysql_num_rows($result);
        if ($row>0) {   
         $langID=  mysql_result($result, 0, 1);
         $langRow=entity::fetchRecord('crops',$langID);
        $lang= mysql_result($langRow, 0, 1);
        $accessChannel=  mysql_result($result, 0, 2);
        $SiteSelection=  mysql_result($result, 0, 3);
        $HousingEquipment= mysql_result($result, 0, 4);
        $BreedsBreeding=mysql_result($result, 0, 5);
        $PigManagement=  mysql_result($result, 0, 6);
        $FeedsFeeding=  mysql_result($result, 0, 7);
        $HealthManagement=  mysql_result($result, 0, 8);
        $Processing=  mysql_result($result, 0, 9);
        $Marketing=  mysql_result($result, 0, 10);
         }
         else{
             header("Location:../index.php");
         }
       
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
        <?php 
		if ($action == 'add') {
    echo "Add New  ".ucwords($menuName)." Details";
     } 
		 else if($action=='update'){
			  echo 'Update  '.$menuName;
			  }?>
      </div>
                          
        <?php
         
                          if (isset($_GET['respond'])) { 
           echo "<div id='errorMsg'>";
           echo 'Duplicate Entry. Record already exist <br>'; 
           echo "</div>";
        } ?>   
      <div id ="FormHeader"> Please fill all fields </div>
      <div id ="FormHeader">
        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
          <table width="100%" border="0" cellpadding="3"  class="recordTable">
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td width="205">Access Channel</td>
              <td width="438"><label for="fName"></label>
                <?php 
                   if ($action=='update') {
                    echo strtoupper($accessChannel);   
                   }
                   else{
                   ?>
                <select name="accessChannel" id="accessChannel">
                  <option value="Web">Web</option>
                  <option value="Mobile">Mobile</option>
                </select>
                <?php
                   }
                   ?></td>
            </tr>
            <tr  id="entityRowEven">
              <td> Language</td>
              <td><?php 
                   if ($action=='update') {
                    echo strtoupper($lang);   
                   }
                   else{
                   ?>
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
                </select>
                <?php
                   }
                   ?>
                <input name="recID" type="hidden" id="ID" value="<?php if($action=='update'){echo $recID;} ?>"/></td>
            </tr>
            <tr id="entityRowOdd">
              <td>Site Selection</td>
              <td><label for="gender"></label>
                <textarea name="siteSelection" cols="60" rows="5" id="siteSelection"><?php if($action=='update'){echo $soilPreparation;} ?>
              </textarea></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Climate</p></td>
              <td><span >
                <textarea name="climate" cols="60" rows="5" id="climate"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea>
              </span></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Cultivation</p></td>
              <td><textarea name="cultivation" cols="60" rows="5" id="cultivation" ><?php if($action=='update'){echo $sowingMethod;} ?>
            </textarea></td>
            </tr>
            <tr  id="entityRowEven">
              <td><p>Raising Of Seedling</p></td>
              <td><textarea name="seedling" cols="60" rows="5" id="seedling"><?php if($action=='update'){echo $fertilizer;} ?>
              </textarea></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Trasplanting and Spacing</p></td>
              <td><textarea name="spacing" cols="60" rows="5" id="spacing" ><?php if($action=='update'){echo $interculture;} ?>
            </textarea></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Manures and Fertilizer</p></td>
              <td><textarea name="fertilizer" cols="60" rows="5" id="fertilizer" ><?php if($action=='update'){echo $plantProtection;} ?>
            </textarea></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Weed Control and Interculture</p></td>
              <td><textarea name="weedControl" cols="60" rows="5" id="weedControl"><?php if($action=='update'){echo $harvest;} ?>
              </textarea></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Disease</p></td>
              <td><textarea name="disease" cols="60" rows="5" id="disease" ><?php if($action=='update'){echo $plantProtection;} ?>
            </textarea></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Harvesting</p></td>
              <td><textarea name="harvest" cols="60" rows="5" id="harvest"><?php if($action=='update'){echo $harvest;} ?>
              </textarea></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Storage and Yield</p></td>
              <td><textarea name="yield" cols="60" rows="5" id="yield" ><?php if($action=='update'){echo $plantProtection;} ?>
            </textarea></td>
            </tr>
            <tr  id="entityRowOdd">
              <td>&nbsp;</td>
              <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>" /></td>
            </tr>
          </table>
        </form>
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
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
<div id="footer">
  <?php include'footer.php';?>
</div>
</div>
</body>
</html>
