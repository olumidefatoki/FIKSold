<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if(isset($_GET['ViewRecord']) && $_SESSION['menuName']  && isset($_SESSION['username']))
{	
$username=$_SESSION['username'];
$menuTableName= $_SESSION['menuTableName'];
$menuName=$_SESSION['menuName'];
$recID=$_GET['ViewRecord'];
$menuTableName=entity::previousTable($menuTableName);

$list=  entity::fetchTableRecord($menuTableName, $recID);
$entityRow=entity::fetchRecord($menuTableName, $recID);
$recName=  mysql_result($entityRow, 0,1);
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);

$entityList=entity::fetchRecord($menuTableName,$recID);
$entityName=mysql_result($entityList,0,1);
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
      <div id="viewHeader"><a href="ViewList.php">
                  <?php echo ucfirst($menuName);?></a>
		  <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" />
		  <?php echo ucfirst($entityName); ?>
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
	 
     echo " <div id='Success'><img src='../images/s_success.png'/> Record was Successfully {$msg} </div>";
       
	  }
	  ?>
      <table width="100%" cellpadding="5"  class="recordTable"  >
        <?php
		$k=1;
                for ($index = 1; $index < count($list); $index++)	  {
                     $value=$list[$index];
		 if($k%2==0)
		  {
			  $id="entityRowEven";
		  }
		  else{
			  $id="entityRowOdd";
		  } 
		  $k++;
	  ?>
        <tr id="<?php echo $id; ?>">
          <td width="218"><strong>
            <?php	  echo ucwords($value->colName);	  ?>
          </strong></td>
            <td width="420"><?php 
            $myVal=$value->value;
            $mylist=splitContent($myVal);           
            foreach ($mylist as $val) {
                echo  htmlspecialchars_decode(ucfirst($val)).'<br>';
            }
            //echo htmlspecialchars_decode(ucfirst($myVal));	  ?></td>
        </tr>
         <?php
	  }
	  ?>
    </table>
      </div>
     
      <div id="subMenu">
       <ul>
       <?php 
        $roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==2) {
					?>
      <li>
      <a  class="sideMenuButton" href="<?php echo"../Controller/RequestController.php?add" ;?> ">Add</a>
      </li>
      <li>
      <a  class="sideMenuButton"  href="<?php echo"../Controller/RequestController.php?update&redID=$recID";?> ">Update</a>
      </li>
     <?php }}?>
      
		<?php
               
		if($menuName=='Crops'){
                   $menuName=  strtolower($menuName);
		?>
            <li>
                <a  class="sideMenuButton"  href="<?php echo"ManageCropRelationship.php?recID=$recID&parentTable=$menuName&childTable=diseases";?> ">View <?php echo ucwords($recName);  ?> Diseases</a>
      </li>
      <li>
      <a class="sideMenuButton"   href="<?php echo"ManageCropRelationship.php?recID=$recID&parentTable=$menuName&childTable=fertilizers";?> ">View <?php echo ucwords($recName);  ?> Fertilizers</a>
      </li>
      <li>
      <a  class="sideMenuButton"  href="<?php echo"ManageCropRelationship.php?recID=$recID&parentTable=$menuName&childTable=pests";?> ">View <?php echo ucwords($recName);  ?> Pests</a>
       </li>
      <li>
        <a  class="sideMenuButton"  href="<?php echo"ManageCropRelationship.php?recID=$recID&parentTable=$menuName&childTable=herbicides";?> ">View <?php echo ucwords($recName);  ?> Herbicides</a>
        </li>
      <li>
        <a  class="sideMenuButton"  href="<?php echo"ManageCropRelationship.php?recID=$recID&parentTable=$menuName&childTable=varietys";?> ">View <?php echo ucwords($recName);  ?> Variety</a>
        </li>
      
         
        <?php	
		}
		
		?>   
        </ul>      
      </div>
     
  </div>
  
  </div>
 <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
