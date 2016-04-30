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
	
	
	$langID=mysql_result($list,0,1);
	$langRow=entity::fetchRecord('languages',$langID);
	$lang=mysql_result($langRow,0,1);
	
	$stateID=mysql_result($list,0,2);
	$stateRow=  entity::fetchState('states', $stateID);
        $state=mysql_result($stateRow,0,2);
	$lgaID=mysql_result($list,0,3);
        $lgaRow=  entity::fetchLGARecord('lga', $lgaID);
        $lga=mysql_result($lgaRow,0,2);
        $fcaId=mysql_result($list,0,4);
	$fcaRow=entity::fetchRecord('fca', $fcaId);
        $fca=mysql_result($fcaRow,0,1);
        $fugId=mysql_result($list,0,5);
	$fugRow=entity::fetchRecord('fug', $fugId);
        $fug=mysql_result($fugRow,0,1);
        
	$firstName=mysql_result($list,0,6);
	$lastName=mysql_result($list,0,7);
	$status=mysql_result($list,0,8);
	$sex=mysql_result($list,0,9);
	$farmSize=mysql_result($list,0,10);
	$address=mysql_result($list,0,11);
	$phoneNo=mysql_result($list,0,12);
	
	//$crops=mysql_result($list,0,10);
	$phoneType=mysql_result($list,0,13);
	$marketID=mysql_result($list,0,14);
	$marketRow=entity::fetchRecord('markets',$marketID);
	$marketName=mysql_result($marketRow,0,1);
        $animal="";
	 $animalresult=entity::FetchfarmerAnimal($recID);
         $animalRowCount=  mysql_num_rows($animalresult);
         if ($animalRowCount>0) {
            $animal=  mysql_result($animalresult, 0, 0) ;
         }
        $cropList=entity::FetchCrop($recID);
        $cropRow=  mysql_num_rows($cropList);
        $cropName='';
		$cropName1;
                $cropName2;
                $cropName3;
			if( $cropRow>0){
        for($i=0;$i<$cropRow;$i++)
		{
		$cropId=mysql_result($cropList,$i,0);
                $cropNamelist=entity::fetchRecord('crops',$cropId);
                
                if ($i==0) {
                    $j=$i+1;
                $cropName1=mysql_result($cropNamelist,0,1);
                }
                if ($i==1) {
                    $j=$i+1;
                $cropName2=mysql_result($cropNamelist,0,1);
                }
                if ($i==2) {
                    $j=$i+1;
                $cropName3=mysql_result($cropNamelist,0,1);
                }
        	}
		}
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
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
      <div id="view">
       <div id="viewHeader">
      List <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" /> 
                  <?php echo strtoupper($menuName).'S';?>
		  <img src="../images/list_bullet.gif" width="4" height="5" /><img src="../images/list_bullet.gif" width="4" height="5" />
		  <?php echo $entityName; ?>
        </div>
        <div style="color:#044407; font-size:x-large; font-weight:bold; margin:7px auto;">
          Current Record Details
        </div>
      <?php
	  if (isset($_GET['action'])) {
                                $action = $_GET['action'];
                                if ($action == 'add')
                                    $msg = 'Added';
                                if ($action == 'update')
                                    $msg = 'Updated';

                                echo "<div id='Success'><img src='../images/s_success.png'/>  Record was Successfully {$msg}</div>";
                            }
	  ?>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="3" cellspacing="1" class="recordTable">
        
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="117"> First Name</td>
            <td width="279"><label for="fName"><?php echo $firstName;

?></label></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Last Name</td>
            <td><?php echo $lastName;

?></td>
          </tr>
          
          <tr id="entityRowOdd">
            <td>Marital Status</td>
            <td><label for="gender"><?php echo $sex;?></label></td>
          </tr>
          <tr id="entityRowEven">
            <td>Gender</td>
            <td><label for="gender"><?php echo $status;?></label></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Address</td>
            <td>
			<?php echo $address;



?></td>
          </tr>
          <tr id="entityRowEven">
            <td>Farm Size</td>
            <td><?php echo $farmSize;


?></td>
          </tr>
          
          
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td> Phone No</td>
            <td><label for="fName"><?php echo $phoneNo;?></label></td>
          </tr>
        
    <tr id="entityRowEven">
            <td>Language </td>
            <td><?php echo $lang;?></td>
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
            <td> Crop1</td>
            <td><?php 
              if (isset($cropName1)) {
             echo ucfirst($cropName1);
                }
			?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowEven">
            <td> Crop2</td>
            <td><?php 
            if (isset($cropName2)) {
             echo ucfirst($cropName2);
                }?>
            </td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td> Crop3</td>
            <td><?php  if (isset($cropName3)) {
             echo ucfirst($cropName3);
                }?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td> Animal Husbandry</td>
            <td><?php  echo $animal; ?></td>
          </tr>
          <tr id="entityRowEven">
            <td>Type Of Phone</td>
            <td><?php echo $phoneType;?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Market</td>
            <td><?php echo $marketName;?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td colspan="2">&nbsp;</td>
            </tr>
        </table>

</form>
      </div>
      <div id="subMenu" >
        <div id="subMenu2">
          <ul>
            <li> <a class="sideMenuButton" href="<?php echo"../Controller/RequestController.php?add" ;?> ">Add</a> </li>
             <li> <a class="sideMenuButton" href="<?php echo"../Controller/RequestController.php?update&redID=$recID" ;?> ">Update</a> </li>
          </ul>
          </table>
        </div>
      </div>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  
  </div>
  
  <?php
  mysql_close();
  ?>
   <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
