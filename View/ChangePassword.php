<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    if (isset($_SESSION['error'])) {
        $errorlist = $_SESSION['error'];
    }

    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} else if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
//$menuName=$_SESSION['menuName'];
//$action=trim($_GET['action']);
//$entityName=$_SESSION['menuTableName'];
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
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
                        <div id="addRecord">
                            Change Password
                        </div>
<?php
if (isset($errorlist)) {
    echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The   following Information are required</div>";
    unset($_SESSION['error']);
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'Success') {
        echo "<div id='Success'><img src='../images/s_success.png'/>   Password was  successfully changed. Your new password has been sent to your  Phone</div>";
    }
}
if (isset($_GET['respond'])) {
    echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> Incorrect Current Password</div>";
}
?>
                        <div style="color:#FFF;">
                            Please fill all fields
                        </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
                                <tr  id="entityRowEven">
                                    <td width="34%">Current Password</td>
                                    <td width="66%"><label for="CPassword"></label>
                                        <input name="CPassword" type="password" id="CPassword" size="40"/>
                        <?php
                        if (isset($errorlist)) {
                            foreach ($errorlist as $value) {

                                if ($value == 'CPassword') {

                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                }
                            }
                        }
                        ?>
                                    </td>
                                </tr>
                                <tr  id="entityRowOdd">
                                    <td width="34%">Enter New Password</td>
                                    <td width="66%"><label for="CPassword"></label>
                                        <input name="NPassword" type="password" id="NPassword" size="40"/>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'NPassword') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                                if ($value == 'Password Mismatch') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Password Mismatch</div> ";
                                                }
                                            }
                                        }
                                        ?>

                                    </td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Re-enter New Password</td>
                                    <td><input name="NPassword2" type="password" id="NPassword2" size="40"/>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'NPassword2') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td colspan="2" align="right"><input name="changePassword" type="submit" id="changePassword"   value="ChangePassword"/></td>
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
