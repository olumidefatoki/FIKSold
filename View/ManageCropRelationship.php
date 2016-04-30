<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
if(isset($_GET['childTable']) && isset($_GET['recID']) && isset($_GET['parentTable']) && isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$childTable=$_GET['childTable'];
$recID=$_GET['recID'];
$_SESSION['recID']=$recID;
$parentTable=$_GET['parentTable'];
$list=  entity::fetchRecord($parentTable,$recID);
$row=mysql_num_rows($list);
if($row>0)
{
	$cropName=mysql_result($list,0,'Name');
}

$table=entity::getTableMapping($childTable,$parentTable);
$_SESSION['menuTableName']=$table;
$recList= entity::fetchMapping($table,$recID,$parentTable);
$recRow=mysql_num_rows($recList);
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
      <a href="<?php  echo "ViewRecord.php?ViewRecord=$recID";?>"> <?php echo ucfirst($cropName) ; ?></a>
         <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" /> <?php echo ucfirst($childTable) ; ?></div>
      <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
        <tr bgcolor="#96C000" id="entityHeader">
          <td width="62">S/N</td>
          <td width="514"><?php echo ucwords($cropName) .'   '. ucwords($childTable); ?></td>
          <td width="118">Action</td>
         
        </tr>
        <?php
		  
		  if($recRow>0){
			  
			  $sn=0;
		  for ($index = 0; $index <$recRow ; $index++) {
       
		if($childTable=='varietys'){
			$myRecID=mysql_result($recList,$index,0);
			$myEntityName=mysql_result($recList,$index,1);
		}
		else{
		$myRecID=mysql_result($recList,$index,0);
                $myEnityID=mysql_result($recList,$index,2);
		$mappingList=entity::fetchRecord($childTable,$myEnityID);
       
        $myEntityName=mysql_result($mappingList,0,'Name');
		}
          $sn=$index+1;
		  if($index%2==0)
		  {
			  $bg="entityRowOdd";
		  }
		  else{
			  $bg="entityRowEven";
		  } 
		  
		  ?>
        <tr id="<?php echo $bg; ?>">
          <td><?php echo   $sn; ?></td>
          <td><?php echo strtoupper($myEntityName);  ?></td>
          <td><a href="<?php echo"../Controller/RequestController.php?recID=$myRecID&parentTable=$parentTable&childTable=$childTable";?>">View</a></td>
          
        </tr>
        <?php
		  }
		  }
		  else{
		  ?>
        <tr bgcolor="#96CA1D">
          <td colspan="4" align="center">No Record Found</td>
        </tr>
        <?php
		  }
		  ?>
      </table>
      </div>
      <div id="subMenu"> <ul>
           <?php 
		  
        $roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==2) {
        include'sideMenu.php'; 
                }}
				?>
                </ul>
      </div>
     
  </div>
  
  </div>
< <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
