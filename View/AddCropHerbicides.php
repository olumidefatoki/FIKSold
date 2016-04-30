<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
if(isset($_GET['action'])  && isset($_SESSION['username']))
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
<div id="loginDetail">Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a>&nbsp;&nbsp;&nbsp;</div>
<div id="content">
  <div id="post">
      <div id="view">
      <div id="addRecord">
      Add Crop Herbicides
      </div>
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
        
          <tr id="entityRowEven">
            <td width="141"> Crop Name</td>
            <td width="319"><?php  echo ucfirst($cropName);?>
              <input type="hidden" name="cropID" id="cropID" value="<?php echo $cropID; ?>" /></td>
          </tr>
          
          <tr id="entityRowOdd">
            <td>Herbicides Name</td>
            <td><label for="herbicideID">
              <select name="herbicideID" id="herbicideID" style="width:425px;">
                <?php  
			$cropList=entity::fetchEntityList('herbicides');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $herbid=  mysql_result($cropList, $index, 'ID');
        		$Name=  mysql_result($cropList, $index, 1);
            
			?>
                <option value="<?php echo $herbid; ?>"> <?php echo $Name; ?></option>
                <?php  
			}
			?>
              </select>
            </label></td>
          </tr>
         <tr id="entityRowEven">
            <td width="141">Timing</td>
            <td width="319"><label for="applicationPeriod"></label>
              <textarea name="applicationPeriod" cols="50" rows="3" id="applicationPeriod"></textarea></td>
          </tr>
          <tr id="entityRowOdd">
            <td width="141"> Dosage</td>
            <td width="319"><textarea name="qty" cols="50" rows="5" id="qty"></textarea></td>
          </tr>
          <tr  id="entityRowEven">
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
