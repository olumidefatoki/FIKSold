<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
if (isset($_GET['action']) && isset($_GET['id']) && isset($_SESSION['username'])) {
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $action = trim($_GET['action']);
    $recID = $_GET['id'];
     $_SESSION['menuName']="FCA";
     $_SESSION['menuTableName']="fca";
    $menuName = $_SESSION['menuName'];
    $entityName = $_SESSION['menuTableName'];
    $result = entity::fetchRecord($entityName, $recID);
    $resultRow=  mysql_num_rows($result);
    if ($resultRow>0) {
        $ID=  mysql_result($result, 0, 0);
        $Name=  mysql_result($result, 0, 1);
        $groupLeadName=  mysql_result($result, 0, 2);
        $groupLeadPhone=  mysql_result($result, 0, 3);
    }
    if (isset( $_SESSION['error'])) {
        $errorlist= $_SESSION['error'];
        unset( $_SESSION['error']);        
    }
 else {
        
    }
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} else if (isset($_GET['action']) && isset($_SESSION['username'])) {
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $menuName = $_SESSION['menuName'];
    $action = trim($_GET['action']);
    $entityName = $_SESSION['menuTableName'];
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
    if (isset( $_SESSION['error'])) {
        $errorlist= $_SESSION['error'];
        unset( $_SESSION['error']);        
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
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../script/jquery.min.js"></script>
      

        <link href="../css/main.css" rel="stylesheet" type="text/css" />
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
                        <div id="addRecord">
<?php
if ($action == 'add') {
    echo 'Add New  Fadama Community Association (FCA)';
} else if ($action == 'update') {
    echo 'Update  Fadama Community Association ';
}
?>
                        </div>
<?php
if (isset($errorlist)) {
    echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> Some Fields are missing.</div>";
}
unset($_SESSION['error']);
?>
                        <div style="color:#FFF;">
                            Please fill all fields
                        </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="3" cellspacing="1" class="recordTable">

                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="242">State </td>
                                    <td width="405"><label for="fcaName"></label>
                                        <select name="state" id="state"  style="width:250px;">
                                            <option value="-1" >Select  State</option>
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
                                        </select>
                                            <?php
                                            if (isset($errorlist)) {
                                                foreach ($errorlist as $value) {

                                                    if ($value == 'state') {

                                                        echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                    }
                                                }
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td width="242">LGA</td>
                                    <td width="405"><label for="fcaName"></label>
                                        <select name="lga" id="lga"  style="width:250px;">
                                            <option  value="-1" >Select Lga</option>
                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'lga') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="lgaloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="242"> FCA Name</td>
                                    <td width="405"><label for="fcaName"></label>
                                        <input name="fcaName" type="text" id="fcaName" class="inputControl"   value="<?php if ($action == 'update') {
                                          echo $Name; 
                                        } ?>" />
                                        <input type="hidden" name="fcaID" id="fcaID" value="<?php if ($action == 'update') {
                                           echo $ID;
                                        } ?>" />
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'fcaName') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
        }
    }
}
?>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td>FCA Group Leader Name</td>
                                    <td><label for="fcaName"></label>
                                        <input name="fcaLeaderName" type="text" class="inputControl" id="fcaLeaderName"  value="<?php if ($action == 'update') {
                                           echo $groupLeadName;
                                        } ?>"/>
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'fcaLeaderName') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
        }
    }
}
?>
                                    </td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>FCA Group Leader Phone No</td>
                                    <td>            
                                        <input name="fcaLeaderPhoneNo" type="text" id="fcaLeaderPhoneNo" class="inputControl"  value="<?php if ($action == 'update') {
                                           echo $groupLeadPhone;
                                        } ?>"/>
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'fcaLeaderPhoneNo') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Wrong Phone No</div> ";
        }
    }
}
?>  
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td colspan="2" align="right"><input type="submit"  name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>"  /></td>
                                </tr>
                            </table>

                        </form>
                    </div>
                    <div id="subMenu">
                    <ul>
<?php include'sideMenu.php'; ?>
</ul>
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
