<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if(isset($_SESSION['username']))
{
    $username=$_SESSION['username'];
    $_SESSION['menuTableName']='vegatable';
    $menuTableName= $_SESSION['menuTableName'];
    $menuName='vegatable';
   $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
   $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {
    $list=  entity::fetchVegatable($startpoint,$limit);
    $rowList=mysql_num_rows($list);
   }
   else{
        $query=$_SESSION['query'];		
	$list= entity::limitCropQuery($menuTableName,$query, $startpoint, $limit);
        $rowList=mysql_num_rows($list);
	}
        $query=$_SESSION['query'];
        unset($_SESSION['query']);
    unset($_SESSION['genricQuery']);
    
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
          <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;"><?php echo ucwords($menuName); ?><br />
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
		  if($rowList>0){
                      for ($index = 0; $index < $rowList; $index++) {
                          
                    $Id= mysql_result($list, $index, 0);
                    $Name= mysql_result($list, $index, 1);
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
            <td><?php echo ucwords($Name);  ?></td>
            <td><a href="<?php echo "ViewVegetableLifeCycle.php?ViewRecord=$Id" ?>"> View </a></td>
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
