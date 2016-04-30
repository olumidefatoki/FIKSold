<?php

include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
//session_start();

if(isset($_SESSION['menuName']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$_SESSION['menuTableName']='in_season';
$_SESSION['menuName']='in_season';
$menuTableName= $_SESSION['menuTableName'];
$menuName=$_SESSION['menuName'];
//fectch all the record in an entitty table
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10;
   $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {
      $list=  entity::fetchAllInseason($startpoint,$limit);
      $listRow=mysql_num_rows($list);
    
    }
     else {
        $query = $_SESSION['query'];
        $list=  entity::limitquery($query, $startpoint, $limit);
        $listRow=mysql_num_rows($list);
        }
//fecth a list of all the menus
$query = $_SESSION['query'];
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
        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;"><?php echo $menuName.'s'; ?>
          <br />
         <font size="+1" color="#000"> Search</font><br />
         <form id="form1" name="form1" method="post" action="ViewInSeasons.php">
           <input name="recordName" type="text" id="recordName" size="30" />
           <input type="submit" name="search" id="search" value="Search" />
           
         </form>
         <label for="textfield"></label>
        
        </div>
<table width="100%" cellpadding="5" cellspacing="1" class="recordTable" >
        
          <tr bgcolor="#96C000">
            <td width="7%" bgcolor="#96C000">S/N</td>
            <td width="37%">
	      Crop			Name</td>
            <td width="36%">Language</td>
             <td width="36%"> Access Channel</td>
            <td width="20%">Action</td>
          </tr>
          <?php
		  $j=1;
		  if($listRow>0 ){
		 for($i=0;$i<$listRow;$i++)
    {

			$id=  mysql_result($list, $i, 0);
        	        $lang=mysql_result($list, $i, 2);
		        $cropName=mysql_result($list, $i, 1);
		        $accessChannel=mysql_result($list, $i, 3);
			
    		if($i%2==0)
		  {
			  $bg="entityRowOdd";
		  }
		  else{
			  $bg="entityRowEven";
		  } 
          $j=$i+1;
		  ?>
          <tr id="<?php echo $bg; ?>">
            <td><?php echo $id; ?></td>
            <td id="<?php echo $bg; ?>"><?php echo ucfirst($cropName);  ?></td>
            <td id="<?php echo $bg; ?>"><?php echo $lang;  ?></td>
            <td id="<?php echo $bg; ?>"><?php echo $accessChannel; ?></td>
            <td id="<?php echo $bg; ?>"><a href="<?php echo "../View/ViewInSeasonRec.php?ViewRecord=$id" ?>"> View </a></td>
          </tr>
          <?php
		  }
		  }
		  else{
		  ?>
          <tr bgcolor="#96CA1D">
            <td colspan="5" align="center">No Record Found</td>
          </tr>
          <?php
		  }
		  ?>
        </table>
          <div id="pagination">
          <?php
	echo pagination($query, $limit, $page, "ViewInSeasons.php?");
?></div>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php'; ?>
        </ul>
      </div>
  </div>
  
  </div>
<div id="footer">
  <p>Copyright &copy; 2012 cellulant life is mobile</p>
</div>
</div>
</body>
</html>
