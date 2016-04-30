<?php
include('Controller/entity.php');
include('Controller/SanitizeData.php');
session_unset();
session_destroy();

session_start();
if (isset($_POST['login'])) {
    entity::DbConnect();
    $username = clean($_POST['username']);
    $password = clean($_POST['password']);
    if (empty($username)) {
        $usernameErrMsg = "Username can not be blank";
    }
    if (empty($password)) {
        $passwordErrMsg = "Password can not be blank";
    }
    if (!empty($username) && !empty($password)) {
        $userlist = entity::login($username, $password);
        $userCount = mysql_num_rows($userlist);

        if ($userCount > 0) {
            $username = mysql_result($userlist, 0, 1);
            $_SESSION['UserPhone'] = mysql_result($userlist, 0, 8);
            $_SESSION['Roles'] = mysql_result($userlist, 0, 7);
            $_SESSION['UserType'] = mysql_result($userlist, 0, 6);
            $_SESSION['UserID'] = mysql_result($userlist, 0, 0);
            $_SESSION['stateId'] = mysql_result($userlist, 0, 2);
            $_SESSION['username'] = $username;
            header("Location:./View/index.php");
        } else {
            $errorMsg = "Incorrect Username or password";
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Fadama Information Knowledge &amp; Services</title>

        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
           #Indexcontent {   
	float:left;
	width:100%;
	background: url(images/HomeBanner.jpg) no-repeat center center fixed;	
	-o-background-size: 100% 100%;
	-moz-background-size: 100% 100% ;
	-webkit-background-size: 100% 100% ;
	background-size: 100% 100% ;
	padding:0px;
	margin:0px;     
	
}

        </style></head>

    <body>
        <div id="Indexcontent">
            <div id="Indexlogin">
                <div class="loginTableHeader">Please Login Here</div>
                <form id="form1" name="form1" method="post" action="index.php"> 
                    <div>
                        <table width="100%" cellpadding="5">
                            <tr class="loginTableRows">
                                <td height="40">Username  <input name="username" type="text" id="username" size="20"  class="input">
                                        <div id="error">
<?php
if (!empty($usernameErrMsg)) {
    echo $usernameErrMsg;
}
?>
                                        </div>
                                </td></tr>
                            <tr class="loginTableRows"><td height="40">Password
                                    <input name="password" type="password" id="password" size="20" class="input">

                                        <div id="error">
<?php
if (!empty($passwordErrMsg)) {
   echo "<div class='alert alert-info '> Incorrect Username or password.</div> "; 
}
?>
                                            <?php
                                            if (!empty($errorMsg)) {
                                                echo $errorMsg;
                                            }
                                            ?>
                                        </div>
                                </td></tr>
                        </table>
                        <div class="loginFooter"><input type="submit" name="login" id="login" value="Login" class="loginButton" /></div>
                    </div>

                </form>
            </div>
             
        </div> <!--Content div ends here-->
     
     <div id="footer">
   <?php include'./View/footer.php';?>
  </div>
    </body>
</html>
