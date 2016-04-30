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
        $accessChannel=  mysql_result($result, 0, 2);
//        $cropId=  mysql_result($result, 0, 3);
//        $cropList= entity::fetchRecord('crops',$cropId);
//        $cropName=mysql_result($cropList,0,1);
        $seedRate=  mysql_result($result, 0, 4);
        $seedTreatment=  mysql_result($result, 0, 5);
        $sowingDate=  mysql_result($result, 0, 6);
        $spacing=  mysql_result($result, 0, 7);
        $fertilizerApp=  mysql_result($result, 0, 8);
        $weedControl=mysql_result($result,0,9);
       
    }

    else if(isset($_GET['action']) && isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
        $menuName=$_SESSION['menuName'];
        $action=trim($_GET['action']);
        $entityName=$_SESSION['menuTableName'];
        

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
      <div id ="FormHeader">
      
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
         <tr  id="entityRowEven">
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
            <td><p>Housing</p></td>
            <td>
              <textarea name="Housing" cols="50" rows="3" id="Housing"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Site_Selection</td>
            <td><label for="gender"></label>
              <textarea name="Site_Selection" cols="50" rows="3" id="Site_Selection"><?php if($action=='update'){echo $seedRate;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td><p>Recommended Breeds</p></td>
            <td>            <span >
              <textarea name="Recommended_Breeds" cols="50" rows="3" id="Recommended_Breeds"><?php if($action=='update'){echo $seedTreatment;} ?>
              </textarea>
            </span></td>
          </tr>
          
          <tr id="entityRowEven">
            <td><p>Feeds Feeding Equipment</p></td>
            <td><textarea name="Feeds_Feeding_Equipment" cols="50" rows="3" id="Feeds_Feeding_Equipment" $description="$description"><?php if($action=='update'){echo $sowingDate;} ?>
            </textarea></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td><p>Pests Diseases Management</p></td>
            <td>
              <textarea name="Pests_Diseases_Management" cols="50" rows="3" id="Pests_Diseases_Management"><?php if($action=='update'){echo $spacing;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td><p>Record Management</p></td>
            <td><textarea name="Record_Management" cols="50" rows="3" id="Record_Management" $description="$description"><?php if($action=='update'){echo $fertilizerApp;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td><p>Processing</p></td>
            <td><textarea name="Processing" cols="50" rows="3" id="Processing" $description="$description"><?php if($action=='update'){echo $weedControl;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td><p>Waste Management Sanitation</p></td>
            <td><textarea name="Waste_Management_Sanitation" cols="50" rows="3" id="Waste_Management_Sanitation" $description="$description"><?php if($action=='update'){echo $weedControl;} ?>
            </textarea></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
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
