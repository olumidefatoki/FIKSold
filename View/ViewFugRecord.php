<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
if(isset($_GET['ViewRecord']) && $_SESSION['menuName']  && isset($_SESSION['username']))
{	
$username=$_SESSION['username'];
$menuTableName= $_SESSION['menuTableName'];
$menuName=$_SESSION['menuName'];
$recID=$_GET['ViewRecord'];
$menuTableName=entity::previousTable($menuTableName);
$list=  entity::fetchRecord($menuTableName, $recID);
$row=mysql_num_rows($list);
if($row>0)
{	
	$ID=mysql_result($list,0,0);
	$fugName=mysql_result($list,0,1);
	$groupLeadName=mysql_result($list,0,2);
	$groupLeadPhone=mysql_result($list,0,3);
        $fcaID=mysql_result($list,0,4);
        
        $fcaRow=  entity::fetchRecord('fca', $fcaID);
        $fcaName=mysql_result($fcaRow,0,1);
        $stateId=mysql_result($fcaRow,0,4);
         $lgaId=mysql_result($fcaRow,0,5);
        
	$stateRow=  entity::fetchState('states', $stateId);
        $state=mysql_result($stateRow,0,2);
	$lgaID=mysql_result($list,0,5);
        $lgaRow=  entity::fetchLGARecord('lga', $lgaId);
        $lga=mysql_result($lgaRow,0,2);
        
}
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);

$entityList=entity::fetchRecord($menuTableName,$recID);
$entityName=mysql_result($entityList,0,0);
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
  <div id="header"><?php include 'sliding.php'; ?>

  </div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
      <div id="view">
       <div id="viewHeader">
      List <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" /> 
                  <?php echo strtoupper($menuName);?>
		  <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" />
		  <?php echo $entityName; ?>
        </div>
        <div style="color:#044407; font-size:x-large; font-weight:bold; margin:7px auto;">
          Current Record Details
        </div>
      <?php
	  if(isset($_GET['action'])){
		  $action=$_GET['action'];
		  if( $action=='add')
		  $msg='Added';
		  if($action=='update')
		  $msg='Updated';
	  ?>
      <div id="Success"><img src='../images/s_success.png'/> Record was Successfully <?php echo $msg;  ?> </div>
      <?php
	  }
	  ?>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding ="5" class="recordTable">
          
          <tr id="entityRowEven">
            <td width="330">State</td>
            <td width="302"><?php echo $state;

?></td>
          </tr>
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>LGA</td>
            <td><label for="fName"><?php echo $lga;


?></label></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Fadama Community Association (FCA) Name</td>
            <td><label for="gender"><?php echo $fcaName;



?></label></td>
          </tr>
          <tr id="entityRowEven">
            <td>Fadama Users Group (FUG) Name</td>
            <td><?php echo $fugName;?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>FUG Chairman Name</td>
            <td><?php echo $groupLeadName ;


?></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>FUG Chairman Phone No</td>
            <td><?php echo $groupLeadPhone;



?></td>
          </tr>
          
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
      <?php 
        $roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==3) {
        include'sideMenu.php';
        ?> 
          
        <li>
           <a href="<?php echo"ManageFug.php?action=update&id=$ID" ;?> ">Update </a>
       </li>
          </ul>
        <?php  }  }?>
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
