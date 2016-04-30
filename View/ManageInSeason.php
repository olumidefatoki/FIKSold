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
        $result= entity::fetchRecord($entityName,$recID);
        $row=mysql_num_rows($result);
        $recID=  mysql_result($result, 0, 0);
         $langID=  mysql_result($result, 0, 1);
         $langRow=entity::fetchRecord('languages',$langID);
        $lang= mysql_result($langRow, 0, 1);
        $accessChannel=  mysql_result($result, 0, 2);
        $cropId=  mysql_result($result, 0, 3);
        $cropList= entity::fetchRecord('crops',$cropId);
        $cropName=mysql_result($cropList,0,1);
        $seedRate=  mysql_result($result, 0, 4);
        $seedTreatment=  mysql_result($result, 0, 5);
        $sowingDate=  mysql_result($result, 0, 6);
        $spacing=  mysql_result($result, 0, 7);
        $fertilizerApp=  mysql_result($result, 0, 8);
        $weedControl=mysql_result($result,0,9);
        $chemicalControl=mysql_result($result,0,10);
	$harvesting=mysql_result($result,0,11);
	$extra_Info=mysql_result($result,0,15);
	$striga=mysql_result($result,0,12);
	$disease=mysql_result($result,0,13);
	$IPM=mysql_result($result,0,14);
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
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="../script/jquery.min.js"></script>

<body>
<div id="wrapper">
 <div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
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
			  echo 'Update  '.$menuName.'  '.ucwords($cropName);
			  } ?> Details
       </div>
      <div id ="FormHeader">
      Please fill all fields
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" border="0" cellpadding="3"  class="recordTable">
        
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="205">Crop </td>
            <td width="438"><?php
                        if ($action == 'update') {
                            echo strtoupper($cropName); 
                            ?>      
                                            <input type="hidden" name="id" id="id" value="<?php echo $recID; ?>">
                                <?php
                            } else {
                                ?> 
                                                <select name="cropID" id="cropID">
                                            <?php
                                            $cropList = entity::fetchEntityList('crops');
                                            $cropNum = mysql_num_rows($cropList);
                                            for ($index = 0; $index < $cropNum; $index++) {
                                                $cropId = mysql_result($cropList, $index, 'ID');
                                                $cropName = mysql_result($cropList, $index, 1);
                                                ?>
                                                        <option value="<?php echo $cropId; ?>"> <?php echo ucfirst($cropName); ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>  
                                                <?php
                                            }
                                            ?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="205">Access Channel</td>
            <td width="438"><label for="fName"></label>
              <select name="accessChannel" id="accessChannel">
                <option value="Web">Web</option>
                <option value="Mobile">Mobile</option>
                
              </select></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td> Language</td>
            <td><label for="fName"></label>
               <?php 
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
                $fertid=  mysql_result($cropList, $index, 0);
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
          
          <tr id="entityRowEven">
            <td>Seed Rate</td>
            <td><label for="gender"></label>
              <textarea name="seedRate" cols="60" rows="5" id="seedRate"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Seed Treatment</td>
            <td>            <span >
              <textarea name="seedTreatment" cols="60" rows="5" id="seedTreatment"><?php if($action=='update'){echo $seedTreatment;} ?>
              </textarea>
            </span></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Sowing Date</td>
            <td><textarea name="sowingDate" cols="60" rows="5" id="sowingDate" $description="$description"><?php if($action=='update'){echo $sowingDate;} ?>
            </textarea></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>Spacing</td>
            <td>
              <textarea name="spacing" cols="60" rows="5" id="spacing"><?php if($action=='update'){echo $spacing;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Fertilizer Application</td>
            <td><textarea name="fertilizerApp" cols="60" rows="5" id="fertilizerApp" $description="$description"><?php if($action=='update'){echo $fertilizerApp;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Weed Control </td>
            <td><textarea name="weedControl" cols="60" rows="5" id="weedControl" $description="$description"><?php if($action=='update'){echo $weedControl;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Chemical Control </td>
            <td><textarea name="chemicalControl" cols="60" rows="5" id="chemicalControl" $description="$description"><?php if($action=='update'){echo $chemicalControl;} ?>
            </textarea></td>
          </tr><tr id="entityRowOdd">
            <td>Harvesting </td>
            <td><textarea name="harvesting" cols="60" rows="5" id="harvesting" $description="$description"><?php if($action=='update'){echo $harvesting;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Striga</td>
            <td><textarea name="striga" cols="60" rows="5" id="striga" $description="$description"><?php if($action=='update'){echo $striga;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Diseases </td>
            <td><textarea name="diseases" cols="60" rows="5" id="diseases" $description="$description"><?php if($action=='update'){echo $disease;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Integtreated Pest Management</td>
            <td><textarea name="IPM" cols="60" rows="5" id="IPM" $description="$description"><?php if($action=='update'){echo $IPM;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Storage</td>
            <td><textarea name="storage" cols="60" rows="5" id="storage" $description="$description"><?php if($action=='update'){echo $extra_Info;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Extra Info </td>
            <td><textarea name="extraInfo" cols="60" rows="5" id="extraInfo" $description="$description"><?php if($action=='update'){echo $extra_Info;} ?>
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
  
  
   <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
