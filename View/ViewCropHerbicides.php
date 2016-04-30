<?php

include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
//session_start();
if(isset($_GET['childTable']) && isset($_GET['recID']) && isset($_GET['parentTable']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$childTable=$_GET['childTable'];
$recID=$_GET['recID'];
$_SESSION['recID']=$recID;
$parentTable=$_GET['parentTable'];


$table=entity::getTableMapping($childTable,$parentTable);
$_SESSION['menuTableName']=$table;
$recList= entity::fetchcropHerbicidesRec($table,$recID);
$recRow=mysql_num_rows($recList);
if ($recRow>0) {
    
    $cropID=mysql_result($recList,0,0);
    $cropName=mysql_result($recList,0,1);
    $diseaseName=mysql_result($recList,0,2);
    $symptom=mysql_result($recList,0,3);
    $control=mysql_result($recList,0,4);
   }
}
else{
	header('location:../index.php');
}

if(isset($_GET['actionSuccessfull']))
{
$childTable=$_SESSION['tableName'];
$list=  entity::fetchList();
}
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
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
      <div id="viewHeader"><a href="ViewList.php"> <?php echo ucfirst($parentTable)?> </a><img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" />
      <a href="<?php  echo "ViewRecord.php?ViewRecord=$cropID";?>"> <?php echo ucfirst($cropName) ; ?></a>
         <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" /> <?php echo ucfirst($childTable) ; ?></div>
      <table width="100%" cellpadding="5" class="recordTable">
        <tr id="entityRowEven">
          <td width="235">Crop</td>
          <td width="470"><?php echo ucfirst($cropName) ; ?></td>
          </tr>
        
        <tr id="entityRowOdd">
          <td>Disease</td>
          <td><?php echo ucfirst($diseaseName) ; ?></td>
        </tr>
        <tr id="entityRowEven">
          <td>Symptom</td>
          <td><?php
                $list=splitContent($symptom);
                foreach ($list as $value) {
                echo  htmlspecialchars_decode($value).'<br>';
                                        }
                ?>
          </td>
        </tr>
        <tr id="entityRowOdd">
          <td>Control </td>
          <td>   <?php
                $list=splitContent($control);
                foreach ($list as $value) {
                echo  htmlspecialchars_decode($value).'<br>';
                                        }
                ?></td>
          </tr>
        
       
      </table>
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
