<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
include('../Controller/utils.php');
//session_start();
 if(isset($_SESSION['menuName']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$_SESSION['menuTableName']='broadcast';
$_SESSION['menuName']='Broadcast';
$menuTableName= $_SESSION['menuTableName'];
$menuName=$_SESSION['menuName'];

$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
   $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['genricQuery'])) {        
   $list=  entity::fetchbroadcast('broadcast',$startpoint, $limit);
   $listRow=mysql_num_rows($list);
	}
	else{
        $query=$_SESSION['genricQuery'];
		$list= entity::limitquery($query, $startpoint, $limit);
        $listRow=mysql_num_rows($list);
	}
$query=$_SESSION['genricQuery'];
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
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" /></head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
    <div id="subMenu">
     <ul>
        <li>
           <a  href="<?php echo"../Controller/RequestController.php?add" ;?> ">Schedule New</a>
         </li>         
</ul>
    </div>
      <div id="view">
        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">Broadcasted Messages<br />
         <font size="+1" color="#000"> Search</font><br />
         <form id="form1" name="form1" method="post" action="ViewSeasons.php">
           <input name="recordName" type="text" id="recordName" size="30" />
           <input type="submit" name="search" id="search" value="Search" />           
         </form>
         <label for="textfield"></label>
        
        </div>
<table width="100%" cellpadding="5" cellspacing="1" class="recordTable" >
        
          <tr bgcolor="#96C000" id="entityHeader">
            <td width="4%">S/N</td>
            <td width="21%">TargetFarmer</td>
            <td width="21%">TargetName</td>
            <td width="24%"> Description</td>
            <td width="17%">Package of Practise</td>
             <td width="19%">Schedule Date</td>
            <td width="15%">Action</td>
          </tr>
          <?php
		  $sn=1;
		  if($listRow>0 ){
		 for($i=0;$i<$listRow;$i++)
         {     
			            $id=  mysql_result($list, $i, 0);
                        $TargetFarmer=mysql_result($list, $i, 1);
                        $TargetFarmer=entity::decode($TargetFarmer);
                        $TargetName=mysql_result($list, $i, 2);
                        $TargetName=entity::fechtargetName($TargetFarmer,$TargetName);
                        $description=mysql_result($list, $i, 3);
			            $msgTitle=mysql_result($list,$i,6);
                        $broadcastDate=mysql_result($list,$i,9);
		
    		if($i%2==0)
		  {
			  $bg="entityRowOdd";
		  }
		  else{
			  $bg="entityRowEven";
		  } 
                  $startpoint++; 
          $sn=$startpoint;
         
		  ?>
          <tr id="<?php echo $bg; ?>">
            <td><?php echo  $sn;?></td>
            <td><?php  echo $TargetFarmer;  ?></td>
             <td><?php   echo $TargetName; ?></td>
            <td><?php  echo $description; ?></td>
            <td> <?php echo $msgTitle; ?></td>
            <td><?php  echo $broadcastDate; ?></td>
            <td><a href="<?php echo "../Controller/RequestController.php?ViewRecord=$id" ?>"> View </a></td>
          </tr>
          <?php
		  }
		  }
		  else{
		  ?>
          <tr bgcolor="#96CA1D">
            <td colspan="7" align="center">No Record Found</td>
          </tr>
          <?php
		  }
		  ?>
        </table>
          <div id="pagination">
          <?php
	echo pagination($query,$limit,$page,"ViewBroadcast.php?");
?>
</div>
 </div>    
  </div>  
   </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
