<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $action = 'add';
    $_SESSION['menuTableName'] = "users";
    $_SESSION['menuName'] = "Users";
    $menuName = $_SESSION['menuName'];
    $entityName = $_SESSION['menuTableName'];
    $userType = $_SESSION['UserType'];
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
    if (isset($_SESSION['error'])) {
        $errorlist = $_SESSION['error'];
        unset($_SESSION['error']);
    }
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
                        <div id="addRecord">

                        </div>
<?php
if (isset($errorlist)) {
    echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The   following Information are required</div>";
    unset($_SESSION['error']);
}
if (isset($_GET['respond'])) {
	 echo "<div id ='errorMsg'>  Duplicate Entry. Phone Number already exist</div>";
          
        }
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'Success') {
        echo "<div id='Success'><img src='../images/s_success.png'/>  Login Account  Created. Password has been sent to user phone No</div>";
    }
}
?>
                        <div style="color:#FFF;">
                            Please fill all fields
                        </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
                                <tr  id="entityRowEven">
                                    <td width="38%">Name</td>
                                    <td width="62%"><label for="username"></label>
                                        <input name="username" type="text" id="username" size="40" class="inputControl"/>
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'username') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Invalid Phone No</div> ";
        }
    }
}
?>
                                    </td>
                                </tr>
                                <tr  id="entityRowOdd">
                                    <td width="38%">Phone No</td>
                                    <td width="62%"><label for="username"></label>
                                        <input name="phoneNo" type="text" id="phoneNo" size="40" class="inputControl"/>
                                        <input type="hidden" name="id" id="id" value="<?php if ($action == 'update') {
                                            echo $recID;
                                        } ?>" />
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'phoneNo') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Invalid Phone No</div> ";
        }
    }
}
?>
                                    </td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>User Type</td>
                                    <td><select name="userType" id="userType" style="width:250px;">
                                            <option value="-1">Select User Type</option>
                                        <?php
                                        $userTypeList = array();


                                        if ($userType == 'State') {

                                            $userTypeList = entity::StateUserList();
                                        } else if ($userType == 'SuperAdmin') {
                                            $userTypeList = entity::FadamaUserList();
                                        }

                                        foreach ($userTypeList as $value) {
                                            ?>
                                                <option value="<?php echo $value; ?>"> <?php echo $value; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                            <?php
                                            if (isset($errorlist)) {
                                                foreach ($errorlist as $value) {

                                                    if ($value == 'userType') {

                                                        echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                    }
                                                }
                                            }
                                            ?>
                                    </td>
                                </tr> 
                                <tr id="entityRowOdd"><td width="38%">       State : </td>
                                    <td width="62%"><select name="state" id="state" style="width:250px;">
                                      <option value="-1" >Select State</option>
                                      <?php
$state = "";
if ($userType == 'State') {
    $stateId = $_SESSION['stateId'];
    $state = entity::fetchState('states', $stateId);
} elseif ($userType == 'SuperAdmin') {
    $state= entity::fetchEntityList('states');
}
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
                                </tr>
                                <tr id="entityRowEven">
                                    <td> LGA : </td>
                                    <td><select name="lga" id="lga" style="width:250px;">
                                      <option value="-1">Select LGA</option>
                                  </select>                                      <div id="lgaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr id="entityRowOdd"><td>  Farmer Community Association (FCA) : </td><td><select name="fca" id="fca"  style="width:250px;">
                                  <option value="-1">Select FCA</option>
                                </select>                                  <div id="fcaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr id="entityRowEven"><td> Farmer User Group (FUG) : </td>
                                    <td><select name="fug" id="fug"  style="width:250px;">
                                      <option value="-1">Select FUG</option>
                                  </select>                                      <div id="fugloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>
                                </tr>

                                <tr id="entityRowOdd">
                                    <td colspan="2" align="right"><input name="createUsers" type="submit" id="createUsers"  value="Create"/></td>
                                </tr>
                            </table>

                        </form>
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
