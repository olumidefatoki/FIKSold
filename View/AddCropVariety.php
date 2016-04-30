<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
if(isset($_GET['action']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$action=trim($_GET['action']);
$entityName=$_SESSION['menuTableName'];
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
$cropID=$_SESSION['recID'];
$cropList=entity::fetchRecord('crops',$cropID);
$cropName=mysql_result($cropList,0,'Name');
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
        <div id="addRecord"> Add Crop  Variety </div>
        <?php
      if($action=='success')
{
	
    echo     "<div id='Success'> <img src='../images/s_success.png'/> Record was Successfully </div>";
        
}
?>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="5" cellspacing="1">
        <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="90"> Crop Name</td>
            <td width="351"><?php echo ucfirst($cropName); ?> <input name="cropID" type="hidden" id="cropID" value="<?php echo $cropID; ?>" /></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowEven">
            <td width="90"> Variety Name</td>
            <td width="351"><label for="variety"></label>
              <input name="variety" type="text" id="variety" size="50" /></td>
          </tr>
          
          <tr id="entityRowOdd">
            <td>Original  Name</td>
            <td><input name="original" type="text" id="original" size="50" /></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowEven">
            <td width="90">Characteristics</td>
            <td width="351"><textarea name="characteristics" cols="40" id="characteristics"></textarea></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="90">Yield</td>
            <td width="351"><input type="text" name="yield" id="yield" /></td>
          </tr>
          
          <tr bgcolor="#96CA1D">
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
  
  </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
