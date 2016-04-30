<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_POST['SearchFug'])) {
    $displayTitle=true;
    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];

    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
     $errorList=checkState($_POST);
    if (count($errorList)<1) {
        if (isset($_POST['fca']) && $_POST['fca'] != -1) {
                $fcaId = $_POST['fca'];
                $Fuglist = entity::fetchFcaFug($fcaId,$startpoint, $limit);
                $fugCount = mysql_num_rows($Fuglist);
                }
        else if (isset($_POST['lga']) && $_POST['lga'] != -1) {
                $lgaId = $_POST['lga'];
                $Fuglist = entity::fetchLgaFug($lgaId,$startpoint, $limit);
                $fugCount = mysql_num_rows($Fuglist);      
                } 
        else if (isset($_POST['state']) && $_POST['state'] != -1) {
                $stateId = $_POST['state'];
                $Fuglist = entity::fetchStateFug($stateId,$startpoint, $limit);
                $fugCount = mysql_num_rows($Fuglist);
                } 
    }
    else{
       $fugCount=0; 
        $Fuglist = entity::fetchStateFug("0",$startpoint, $limit);
        $fugCount = mysql_num_rows($Fuglist);
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
        $Fuglist = entity::fetchAllFug($startpoint, $limit);
        $fugCount = mysql_num_rows($Fuglist);
        
    }
    else{
         $query=$_SESSION['query'];
        $Fuglist = entity::limitquery($query, $startpoint, $limit);
        $fugCount = mysql_num_rows($Fuglist);
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
 
});

$("#lga").change(function(){	
var id=$(this).val();
$("#fcaloading").css("display","inline-block");
var dataString ='farmerlgaid='+id;
$.ajax({
type: "GET",
url: "../Controller/RequestController.php",
data: dataString,
cache: false,
success: function(html){	
$("#fca").html(html);
$("#fcaloading").css("display","none");} 
});   
});

$("#fca").change(function(){	
var id=$(this).val();
$("#fugloading").css("display","inline-block");
var dataString ='fcaId='+id;
$.ajax({
type: "GET",
url: "../Controller/RequestController.php",
data: dataString,
cache: false,
success: function(html){	
$("#fug").html(html);
$("#fugloading").css("display","none");} 
});   
});

})</script>
</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
              <div id="post">
              <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">Fadama Users Group (FUG)
<?php
if (isset($error)) {
    echo "<div id ='errorMsg'>  Please   select a State </div>";
   
}
unset($error);
?>
                        </div>
                  
                        <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="ViewFug.php">
                                <table width="100%" cellpadding="5">
                                    <tr><td width="41%">       State : </td>
                                        <td width="59%"><select name="state" id="state"  style="width:300px;">
                                          <option value="-1" >Select  State</option>
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
                                              <option value="-1">Select LGA</option>
                                          </select><div id="lgaloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>
</tr><tr>
  <td>Fadama Community Association (FCA)</td>
                                            <td><select name="fca" id="fca"  style="width:300px;">
                                              <option value="-1">Select FCA</option>
                                            </select><div id="fcaloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>
</tr>
                                            <tr><td colspan="2" align="center">  <input type="submit" value="Search" name="SearchFug" id="SearchFug" /></td>

                                                </table>
</form>
                                                        </div>
                                                        <?php if($displayTitle==true){?>
                                                        <div id=searchParam> Search Result for FUG </div>
                                                         <?php }?>
                                                        <table width="100%" cellpadding="3" class="recordTable" >
                                                          <tr bgcolor="#96C000" id="entityHeader">
                                                                <td width="5%" >S/N</td>
                                                                <td width="25%"> Name</td>
                                                                <td width="28%" > FUG Chairman Name</td>
                                                                <td width="31%" >FUG Chairman Phone No </td>
                                                                <td width="11%">Action</td>
                                                          </tr>
<?php
$i = 0;
if ($fugCount > 0) {
    for ($index = 0; $index < $fugCount; $index++) {
        $fcaId = mysql_result($Fuglist, $index, 0);
        $fcaName = mysql_result($Fuglist, $index, 1);
        $fcaGroupName = mysql_result($Fuglist, $index, 2);
        $fcaGroupPhoneNo = mysql_result($Fuglist, $index, 3);
        
        if ($i % 2 == 0) {
            $bg = "entityRowOdd";
        } else {
            $bg = "entityRowEven";
        }
        $i++;
        $sn=$startpoint+1;
         $startpoint++;	
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
                                                            echo pagination($query, $limit, $page, "ViewFug.php?");
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

                                                        </div>

                                                        </div>
                                                        <div id="footer">
   <?php include'footer.php';?>
  </div>
                                                        </div>
                                                        </body>
                                                        </html>
