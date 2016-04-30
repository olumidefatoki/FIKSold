<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');

if (isset($_GET['action']) && isset($_GET['id']) && isset($_SESSION['username'])) {
    $userType = $_SESSION['UserType'];
    if (isset($_SESSION['error'])) {
        $errorlist = $_SESSION['error'];
        unset($_SESSION['error']);
    }
    $username = $_SESSION['username'];
    $action = trim($_GET['action']);
    $recID = $_GET['id'];
    $menuName = $_SESSION['menuName'];
    $entityName = $_SESSION['menuTableName'];
    $result = entity::fetchRecord($entityName, $recID);
    $row = mysql_num_rows($result);
    if ($row > 0) {
        $recID = mysql_result($result, 0, 0);
        $firstName = mysql_result($result, 0, 6);
        $lastName = mysql_result($result, 0, 7);

        $farmSize = mysql_result($result, 0, 10);
        $address = mysql_result($result, 0, 11);
        $phoneNo = mysql_result($result, 0, 12);
    } else {
        header('location:../index.php');
    }

    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} else if (isset($_GET['action'])) {
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $menuName = $_SESSION['menuName'];
    $action = trim($_GET['action']);
    $entityName = $_SESSION['menuTableName'];
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

        <link href="../css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../script/jquery.min.js"></script>  <script type="text/javascript" src="../script/customscripts.js"></script>

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
                $("#fug").change(function(){	
                    var id=$(this).val();
                    $("#fugloading").css("display","inline-block");
                    var dataString ='fugId='+id;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#market").html(html);
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
                            <?php
                            if ($action == 'add') {
                                echo 'Add New ' . $menuName;
                            } else if ($action == 'update') {
                                echo 'Update  ' . $menuName . '  ' . $firstName . " " . $lastName;
                            }
                            ?>
                        </div>
                            <?php
                            if (isset($errorlist)) {
                                echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The  Information are required</div>";
                            }
                            unset($_SESSION['error']);
                            if (isset($_GET['respond'])) {
                                echo "<div id ='errorMsg'>  Duplicate Entry. Phone Number already exist</div>";
                            }
                            ?>
                        <div style="color:#FFF;">
                            Please fill all fields
                        </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="3" cellspacing="1" class="recordTable">

                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="263">State </td>
                                    <td width="420"><label for="fName"></label>
                                        <select name="state" id="state" style="width:250px;">
                                            <option value="-1" >Select State</option>
<?php
$state = "";
if ($userType == 'State') {
    $stateId = $_SESSION['stateId'];
    $state = entity::fetchState('states', $stateId);
} elseif ($userType == 'SuperAdmin') {
    $state = entity::fetchEntityList('states');
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
                                    <td width="263">LGA</td>
                                    <td width="420"><label for="fName"></label>
                                        <select name="lga" id="lga" style="width:250px;">
                                            <option value="-1">Select LGA</option>
                                        </select><?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'lga') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                            ?> <div id="lgaloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="263">Farmer Community Association (FCA)</td>
                                    <td width="420"><label for="fName"></label>
                                        <select name="fca" id="fca"  style="width:250px;">
                                            <option value="-1">Select FCA</option>
                                        </select>

<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'fca') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
        }
    }
}
?>
                                        <div id="fcaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td width="263">Farmer User Group (FUG)</td>
                                    <td width="420"><label for="fName"></label>
                                        <select name="fug" id="fug"  style="width:250px;">
                                            <option value="-1">Select FUG</option>
                                        </select>
<?php
if (isset($errorlist)) {
    foreach ($errorlist as $value) {

        if ($value == 'fug') {

            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
        }
    }
}
?>
                                        <div id="fugloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>
                                    </td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Market</td>
                                    <td><select name="market" id="market" onchange="" style="width:250px;">
                                            <option value="-1">Select Market</option>
                                            
                                   </select>
                                            <?php
                                            if (isset($errorlist)) {
                                                foreach ($errorlist as $value) {

                                                    if ($value == 'market') {

                                                        echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                    }
                                                }
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td width="263"> First Name</td>
                                    <td width="420"><label for="fName"></label>
                                        <input name="fName" type="text" id="fName"  class="inputControl" value="<?php
                                        if ($action == 'update') {
                                            echo $firstName;
                                        }
                                            ?>" size="40"/>
                                        <input type="hidden" name="id" id="id" value="<?php
                                        if ($action == 'update') {
                                            echo $recID;
                                        }
                                            ?>" />
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'fName') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Last Name</td>
                                    <td><input name="lName" type="text" id="lName" class="inputControl" value="<?php
                                               if ($action == 'update') {
                                                   echo $lastName;
                                               }
                                        ?>" size="45" /></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td> Marital status</td>
                                    <td><label for="fName"></label>
                                        <select name="status" id="status" style="width:250px;">
                                            <option value="Married">Married</option>
                                            <option value="Single">Single</option>
                                        </select></td>
                                </tr>

                                <tr id="entityRowOdd">
                                    <td>Sex</td>
                                    <td><label for="gender"></label>
                                        <select name="gender" id="gender" style="width:250px;">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td> Phone No</td>
                                    <td><label for="fName"></label>
                                        <input name="phoneNo" type="text" id="phoneNo"  class="inputControl"  value="<?php
                                        if ($action == 'update') {
                                            echo $phoneNo;
                                        }
                                        ?>" /> <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'phoneNo' || $value == 'phoneNo1') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Wrong Phone Number</div> ";
                                                }
                                            }
                                        }
                                        ?></td>
                                </tr><tr id="entityRowOdd">
                                    <td>Address</td>
                                    <td><textarea name="address" class="inputControlTextArea"  id="address" ><?php
                                               if ($action == 'update') {
                                                   echo $address;
                                               }
                                        ?>
                                        </textarea></td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Farm Size</td>
                                    <td>            <span >
                                            <input name="size" type="text" id="size"  value="<?php
                                               if ($action == 'update') {
                                                   echo $farmSize;
                                               }
                                        ?>" class="inputControl"/>
                                        </span></td>
                                </tr><tr id="entityRowOdd">
                                    <td>Type Of Phone</td>
                                    <td><input name="phoneType" type="text" id="phoneType"  value="<?php
                                               if ($action == 'update') {
                                                   echo $phoneNo;
                                               }
                                        ?>" class="inputControl"/></td>
                                </tr>

                                <tr id="entityRowEven">
                                    <td>Language </td>
                                    <td><select name="language" id="language" onchange="" style="width:250px;">
<?php
$state = entity::fetchEntityList('languages');
$stateRows = mysql_num_rows($state);
for ($i = 0; $i < $stateRows; $i++) {
    $ID = mysql_result($state, $i, 'ID');
    $langName = mysql_result($state, $i, 'Name');
    ?>
                                                <option value="<?php echo $ID; ?>"><?php echo $langName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Preferred Crop 1 </td>
                                    <td><select name="crop1" id="crop1" onchange="" style="width:250px;">
                                            <option value="-1" >Select Crop</option>
<?php
$state = entity::fetchEntityList('crops');
$stateRows = mysql_num_rows($state);
for ($i = 0; $i < $stateRows; $i++) {
    $ID = mysql_result($state, $i, 'ID');
    $langName = mysql_result($state, $i, 'Name');
    ?>
                                                <option value="<?php echo $ID; ?>"><?php echo $langName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Preferred Crop 2</td>
                                    <td><select name="crop2" id="crop2" onchange="" style="width:250px;">
                                            <option value="-1" >Select Crop</option>
<?php
$state = entity::fetchEntityList('crops');
$stateRows = mysql_num_rows($state);
for ($i = 0; $i < $stateRows; $i++) {
    $ID = mysql_result($state, $i, 'ID');
    $langName = mysql_result($state, $i, 'Name');
    ?>
                                                <option value="<?php echo $ID; ?>"><?php echo $langName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Preferred Crop 3</td>
                                    <td><select name="crop3" id="crop3" onchange="" style="width:250px;">
                                            <option value="-1" >Select Crop</option>
<?php
$state = entity::fetchEntityList('crops');
$stateRows = mysql_num_rows($state);
for ($i = 0; $i < $stateRows; $i++) {
    $ID = mysql_result($state, $i, 'ID');
    $langName = mysql_result($state, $i, 'Name');
    ?>
                                                <option value="<?php echo $ID; ?>"><?php echo $langName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Animal Husbandry</td>
                                    <td><select name="animal" id="animal" style="width:250px;" >
                                            <option  value="-1">Select  Animal </option>
<?php
$cropList = entity::fetchEntityList('animalhusbandry');
$cropNum = mysql_num_rows($cropList);
for ($index = 0; $index < $cropNum; $index++) {
    $fertid = mysql_result($cropList, $index, 'ID');
    $fertName = mysql_result($cropList, $index, 1);
    ?>
                                                <option value="<?php echo $fertid; ?>"> <?php echo $fertName; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </td>
                                </tr>
                                <tr  id="entityRowOdd">
                                    <td>&nbsp;</td>
                                    <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>"/></td>
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
            <?php include'footer.php'; ?>
            </div>
        </div>
    </body>
</html>
