<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
if(isset($_GET['ViewRecord'])  && isset($_SESSION['username']))
{	
$username=$_SESSION['username'];

$recID=$_GET['ViewRecord'];

$_SESSION['userRec']=$recID;

$list=  entity::fetchUser($recID);
$row=mysql_num_rows($list);
if($row>0)
{
	
	
	 $state="";
         $lga="";$fca="";$fug="";	
	$stateID=mysql_result($list,0,2);
	$stateRow=  entity::fetchState('states', $stateID);
        $stateRowCount=  mysql_num_rows($stateRow);
        if ($stateRowCount>0) {
             $state=mysql_result($stateRow,0,2);
        }       
	$lgaID=mysql_result($list,0,3);
        $lgaRow=  entity::fetchLGARecord('lga', $lgaID);
         $lgaRowCount=  mysql_num_rows($lgaRow);
        if ($lgaRowCount>0) {
             $lga=mysql_result($lgaRow,0,2);
        }        
        $fcaId=mysql_result($list,0,4);
	$fcaRow=entity::fetchRecord('fca', $fcaId);
        $fcaRowCount=  mysql_num_rows($fcaRow);
        if ($fcaRowCount>0) {
            $fca=mysql_result($fcaRow,0,1);
        }
       
        $fugId=mysql_result($list,0,5);
	$fugRow=entity::fetchRecord('fug', $fugId);
         $fugRowCount=  mysql_num_rows($fugRow);
        if ($fugRowCount>0) {
             $fug=mysql_result($fugRow,0,1);
        }
       
        
	$Name=mysql_result($list,0,1);
	$userType=mysql_result($list,0,6);
    $userName=mysql_result($list,0,7);		
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
<<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
      <div id="view">
        <div style="color:#044407; font-size:x-large; font-weight:bold; margin:7px auto;">
          Current Users Record Details
        </div>
        <div style="color:#FFF; font-size:x-large; font-weight:bold; margin:7px auto; text-align:center">
          Password has been reset.
        </div>
        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
  <table width="100%" cellpadding="3" cellspacing="1" class="recordTable">
        
          <tr bgcolor="#96CA1D">
            <td>Name</td>
            <td><?php echo $Name;?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="117">User Name</td>
            <td width="279"><?php echo $userName;?></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>UserType</td>
            <td><?php echo $userType;?></td>
          </tr>
          
          
         
          <tr id="entityRowOdd">
            <td>State</td>
            <td><?php echo $state;?></td>
          </tr>
          <tr id="entityRowEven">
            <td>LGA</td>
            <td><?php echo $lga;?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>FCA</td>
            <td><?php echo $fca;?></td>
          </tr>
          <tr id="entityRowEven">
            <td>FUG</td>
            <td><?php echo $fug;?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
           
          </tr>
          
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td colspan="2">&nbsp;</td>
            </tr>
        </table>

</form>
      </div>
  </div>
  
  </div>
  
 
  <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
