<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
if(isset($_GET['ViewRecord']) && $_SESSION['menuName']  && isset($_SESSION['username']))
{	
$username=$_SESSION['username'];
$id=$_GET['ViewRecord'];
$pendingMsg=0;$SentMsg=0;$FailedMsg=0;
$Pendingresult=entity::fetchPendingMessage($id);
$pendingRowCount=  mysql_num_rows($Pendingresult);
if ($pendingRowCount>0) {
    $pendingMsg=  mysql_result($Pendingresult, 0, 0);    
}
$Sentresult=entity::fetchSentMessage($id);
$SentRowCount=  mysql_num_rows($Sentresult);
if ($SentRowCount>0) {
    $SentMsg=  mysql_result($Sentresult, 0, 0);    
}

$Failedresult=entity::fetchFailedMessage($id);
$FailedRowCount=  mysql_num_rows($Failedresult);
if ($FailedRowCount>0) {
    $FailedMsg=  mysql_result($Failedresult, 0, 0);    
}
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);


}
else{
	header('location:index.php');
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
      <div id="viewHeader">SUMMARY OF SCHEDULED BROADCAST</div>
       <div style="color:black; font-size:larger;  margin:7px auto; float:left; width:600px;">
       <table width="100%" cellpadding="5" class="recordTable" >
       <tr id="entityRowEven">  <td width="217">Total Scheduled Message </td>
       <td width="231"> <?php $sum= $SentMsg+$pendingMsg+$FailedMsg; echo $sum; ?> </td></tr>
         <tr id="entityRowOdd">  <td>Total Delivered Messages </td>
           <td><?php echo $SentMsg ?> </td></tr>
           <tr id="entityRowEven">  <td>Total Pending Message </td>
             <td><?php echo $pendingMsg; ?></td></tr>
              <tr id="entityRowEven"> <td>Total Failed Message </td>
             <td><?php echo $FailedMsg ?> </td></tr>
       </table>
       </div>
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
