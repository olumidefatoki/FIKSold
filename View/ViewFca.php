<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_POST['SearchFca'])) {
    $displayTitle=true;
    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];

    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    $errorList=checkState($_POST);
    if (count($errorList)<1) {
        if (isset($_POST['lga']) && $_POST['lga'] != -1) {
            $lgaId = $_POST['lga'];
            $Fcalist = entity::fetchlgaFca($menuTableName, $lgaId,$startpoint, $limit);
            $fcaCount = mysql_num_rows($Fcalist);
         }
         else if (isset($_POST['state']) && $_POST['state'] != -1) {
             
	     $stateId = $_POST['state'];
	     $Fcalist = entity::fetchstateFca($menuTableName, $stateId,$startpoint, $limit);
             $fcaCount = mysql_num_rows($Fcalist);
        } 
	
    }
    else{
       
         $Farmerlist =  entity::fetchstateFca($menuTableName, "0",$startpoint, $limit);
        $fcaCount = mysql_num_rows($Farmerlist);
        $error = $errorList;
    }
    
    $query=$_SESSION['query'];
	//fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} elseif (isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username'])) {
    $displayTitle=false;
   

    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];
    //fectch all the record for a table
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {
        $Fcalist = entity::fetchAllFcaList($menuTableName, $startpoint, $limit);
        $fcaCount = mysql_num_rows($Fcalist);
        
    }
    else{
         $query=$_SESSION['query'];
        $Fcalist = entity::limitquery($query, $startpoint, $limit);
        $fcaCount = mysql_num_rows($Fcalist);
    }
       $query=$_SESSION['query'];
       
    
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);

    //to make pagination
} else {
    header('location:../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Fadama Information Knowledge &amp; Services</title>
        <script type="text/javascript" src="../script/jquery.min.js"></script>
         
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(){	
$("#state").change(function(){	
var id=$(this).val();
 $("#lgaloading").css("display","inline-block");
var dataString ='stateId='+id;
$.ajax({
type: "GET",
url: "../Controller/RequestController.php",
data: dataString,
cache: false,
success: function(html){	
$("#lga").html(html);
$("#lgaloading").css("display","none");
} 
});
 
});})</script>
</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
              <div id="post">
              <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">Fadama Community Association (FCA)
<?php
if (isset($error)) {
    echo "<div id ='errorMsg'>  Please   select a State </div>";
}
unset($error);
?>
                        </div>
                  
                        <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="ViewFca.php">
                                <table width="100%" cellpadding="5">
                                    <tr><td width="26%">       State : </td>
                                        <td width="74%"><select name="state" id="state"  style="width:300px;">
                                          <option value="-1">Select  State</option>
                                          <?php
$state = entity::fetchEntityList('states');
$stateRows = mysql_num_rows($state);
for ($i = 0; $i < $stateRows; $i++) {
    $stateID = mysql_result($state, $i, 'stateID');
    $stateName = mysql_result($state, $i, 'stateName');
    ?>
                                          <option value="<?php echo $stateID; ?>"><?php echo $stateName; ?></option>
                                          <?php
                                                }
                                                ?>
                                      </select></td>
                                        <tr>
                                            <td> LGA : </td>
                                            <td><select name="lga" id="lga"   style="width:300px;">
                                              <option value="-1" >Select LGA</option>
                                          </select><div id="lgaloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>

                                            <tr><td colspan="2" align="center">  <input type="submit" value="Search" name="SearchFca" id="SearchFca" /></td>

                                                </table>
</form>
                                                        </div>
                                                        <?php if($displayTitle==true){?>
                                                        <div id=searchParam> Search Result for FCA </div>
                                                         <?php }?>
                                                        <table width="100%" cellpadding="3" class="recordTable" >
                                                          <tr id="entityHeader">
                                                                <td width="6%" >S/N</td>
                                                                <td width="28%"> Name</td>
                                                                <td width="25%" > FCA ChairmanName</td>
                                                                <td width="32%" >FCA Chairman Phone No </td>
                                                                <td width="9%">Action</td>
                                                          </tr>
<?php
$i = 0;
if ($fcaCount > 0) {
    for ($index = 0; $index < $fcaCount; $index++) {
        $fcaId = mysql_result($Fcalist, $index, 0);
        $fcaName = mysql_result($Fcalist, $index, 1);
        $fcaGroupName = mysql_result($Fcalist, $index, 2);
        $fcaGroupPhoneNo = mysql_result($Fcalist, $index, 3);
        $sn = $startpoint + 1;
        $startpoint++;
        if ($i % 2 == 0) {
            $bg = "entityRowOdd";
        } else {
            $bg = "entityRowEven";
        }
        $i++;
        ?>
                                                                  <tr id="<?php echo $bg; ?>">
                                                                        <td><?php echo $sn; ?></td>
                                                                        
                                                                        <td><?php echo ucwords($fcaName); ?></td>
                                                                         <td><?php echo ucwords($fcaGroupName) ; ?></td>
                                                                         <td><?php echo ucwords($fcaGroupPhoneNo); ?></td>
                                                                        <td><a href="<?php echo "../Controller/RequestController.php?ViewRecord=$fcaId" ?>"> View </a></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            } else {
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
                                                            echo pagination($query, $limit, $page, "ViewFca.php?");
                                                            ?>
                                                        </div>
                                                        </div>
                                                        <div id="subMenu">
                                                        <ul>
                                                                <?php 
$UserType=  $_SESSION['UserType'];
$roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
  foreach ($rolesList as $value) {
                if ($value==2) {
        include'sideMenu.php'; 
                }}
				if ($UserType=='State') {
      include'sideMenu.php'; 
}
				?>
                </ul>
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
