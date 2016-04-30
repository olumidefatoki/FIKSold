<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
if(isset($_GET['action']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$action=trim($_GET['action']);
$entityName=$_SESSION['tableName'];
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
$pestID=$_SESSION['recID'];
$pestList=entity::fetchRecord('pest',$pestID);
$cropName=mysql_result($pestList,0,'Name');
}
if(isset($_GET['id']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$recID=$_GET['id'];
$result= entity::fetchRecord($entityName,$recID);
$row=mysql_num_rows($result);
$recID=  mysql_result($result, 0, 0);
$corpName=  mysql_result($result, 0, 1);
$fertilizer=  mysql_result($result, 0, 2);
}

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

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
      <table width="100%" cellspacing="1" id="entityHeader">
        <tr>
          <td width="459">Add Pest Pesticide </td>
        </tr>
      </table>
      <?php
      if($action=='success')
{
	?>
      <div id="Success">Record was Successfully </div>
      <?php
}
?>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="5" cellspacing="1">
        
          <tr bgcolor="#96CA1D">
            <td width="110"> Pest Name</td>
            <td width="350"><?php  echo $cropName;?>
              <input type="hidden" name="pestID" id="pestID" value="<?php echo $pestID; ?>" /></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Pesticide Name</td>
            <td><label for="pesticideID">
              <select name="pesticideID" id="pesticideID">
                <?php  
			$pestList=entity::fetchEntity('pesticides');
			$cropNum=mysql_num_rows($pestList);
			for ($index = 0; $index < $cropNum; $index++) {
                $pesticidesid=  mysql_result($pestList, $index, 'ID');
        		$pesticidesName=  mysql_result($pestList, $index, 1);
            
			?>
                <option value="<?php echo $pesticidesid; ?>"> <?php echo $pesticidesName; ?></option>
                <?php  
			}
			?>
              </select>
            </label></td>
          </tr>
         
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>&nbsp;</td>
            <td><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>"  style="width:60px; text-align:center;"/></td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php'; ?>
        </ul>
      </div>
  </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
