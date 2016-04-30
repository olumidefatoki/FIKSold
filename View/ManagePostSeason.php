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
$result= entity::fetchRecord('post_season',$recID);
$row=mysql_num_rows($result);
if($row>0){
$recID=  mysql_result($result, 0, 0);
$cropID=  mysql_result($result, 0, 3);
$cropList= entity::fetchRecord('crops',$cropID);
$cropName=mysql_result($cropList,0,1);	
$processing=  mysql_result($result, 0, 4);
$delivery=  mysql_result($result, 0, 5);
$storage=  mysql_result($result, 0, 6);
$FBP=  mysql_result($result, 0, 7);
$finance=  mysql_result($result, 0, 8);
$rawMaterial=  mysql_result($result, 0, 9);
$extra_info=  mysql_result($result, 0, 10);
}
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
			  echo 'Update Details for  '.$menuName;
			  } ?>
              
        </div>
      <div style="color:#FFF;">
      Please fill all fields
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="5" cellspacing="1">
          
          <tr id="entityRowEven">
            <td width="168">Crop </td>
            <td width="507"> <?php
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
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="168">Access Channel</td>
            <td width="507"><label for="fName"></label>
              <select name="accessChannel" id="accessChannel">
                <option value="Web">web</option>
                <option value="Mobile">mobile</option>
                
              </select></td>
          </tr>
          <tr id="entityRowEven">
            <td>Processing</td>
            <td><label for="gender"></label>
              <textarea name="processing" cols="55" rows="5" id="processing"><?php if($action=='update'){echo $processing;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Bulking &amp; Delivery</td>
            <td>            <span >
              <textarea name="delivery" cols="55" rows="5" id="delivery"><?php if($action=='update'){echo $delivery;} ?>
              </textarea>
            </span></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Storage</td>
            <td><textarea name="storage" cols="55" rows="5" id="storage" $description="$description"><?php if($action=='update'){echo $storage;} ?>
            </textarea></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>Farm Business Planing</td>
            <td><label for="fName"></label>
              <textarea name="farmBus" cols="55" rows="5" id="farmBus"><?php if($action=='update'){echo $FBP;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>Farmer Financing</td>
            <td><textarea name="finance" cols="55" rows="5" id="finance" $description="$description"><?php if($action=='update'){echo $finance;} ?>
            </textarea></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>Raw Material Specification</td>
            <td><label for="fName"></label>
              <textarea name="rawMaterial" cols="55" rows="5" id="rawMaterial"><?php if($action=='update'){echo $rawMaterial;} ?>
              </textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Extra Info</td>
            <td><textarea name="extraInfo" cols="55" rows="5" id="extraInfo" $description="$description"><?php if($action=='update'){echo $extra_info;} ?>
            </textarea></td>
          </tr>
          <tr id="entityRowEven">
            <td>&nbsp;</td>
            <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>"  /></td>
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
</body>
</html>
