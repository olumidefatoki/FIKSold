<?php

include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');

//session_start();
if(isset($_POST['search']))
{
    $username=$_SESSION['username'];
      $recName=$_POST['recordName'];
    //fectch a record for a  ID in a  table
     $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
      $startpoint = ($page * $limit) - $limit;
    $list=  entity::fetchRec('users',$recName,$startpoint,$limit);
	$query=$_SESSION['genricQuery'];
    //fecth a list of all the menus
    $menuList=entity::fetchMenu();
    $menuRow=mysql_num_rows($menuList);
}
elseif(isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username']))
{
    $username=$_SESSION['username'];
    $menuTableName= $_SESSION['menuTableName'];
    $menuName=$_SESSION['menuName'];
    //fectch all the record for a table
   $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
   $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['genricQuery'])) {
       $userType=$_SESSION['UserType'];
       if ($userType=='State') {
          $stateId= $_SESSION['stateId'];
          $list= entity::StateUser($startpoint,$limit,$stateId);
       }
       else{
        $list=  entity::fetchList($menuTableName,$startpoint,$limit);   
       }
    
	}
	else{
         $query=$_SESSION['genricQuery'];
		
		$list= entity::limitCropQuery($menuTableName,$query, $startpoint, $limit);
	}
        $query=$_SESSION['genricQuery'];
    //fecth a list of all the menus
       
        
        //to make pagination
        
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
        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;"><?php echo "Users"; ?>
          <br />
         <font size="+1" color="#000"> Search</font><br />
         <form id="form1" name="form1" method="post" action="ViewUsers.php">
           <input name="recordName" type="text" id="recordName" size="30" /> 
         
           <input type="submit" name="search" id="search" value="Search" />
          
         </form>
         <label for="textfield"></label>
        
        </div>
<table width="95%" cellpadding="3" class="recordTable" >
        
          <tr   id="entityHeader">
            <td width="8%" >S/N</td>
            <td width="72%"> Name</td>
            <td width="20%">Action</td>
          </tr>
          <?php
		  $i=0;
		  if(count($list)>0){
		  foreach ($list as $entity) {
    		if($i%2==0)
		  {
			  $bg="entityRowOdd";
		  }
		  else{
			  $bg="entityRowEven";
		  } 
          $i++;
	$sn=$startpoint+1;
        $startpoint++;	
          ?>
          <tr id="<?php echo $bg; ?>">
            <td><?php echo $sn; ?></td>
            <td><?php echo ucwords($entity->name);  ?></td>
            <td><a href="<?php echo "../Controller/RequestController.php?ViewRecord=$entity->ID" ?>"> View </a></td>
          </tr>
          <?php
		  }
		  }
		  else{
		  ?>
          <tr bgcolor="#96CA1D">
            <td colspan="3" align="center">No Record Found</td>
          </tr>
          <?php
		  }
		  ?>
        </table>
        <div id="pagination">
          <?php
	echo pagination($query,$limit,$page,"ViewList.php?");
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
