<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');

//session_start();
if (isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username'])) {
    $username=$_SESSION['username'];
    $displayTitle=false;
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
	if (isset($_SESSION['error'])){
	$errorlist=$_SESSION['error'];
	unset($_SESSION['error']);
	}
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
       <script type="text/javascript" src="../script/customscripts.js"></script>
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
            <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">MANAGE CROP BROADCAST</div>
                        <?php
                        if (isset($errorlist)) {
                           echo "<div id ='errorMsg'>Oops !!! Please select all field</div>";
                            
                        }
                        unset($error);
                        ?>
                  <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="31%" height="37">Broadcast Type</td>
                                        <td width="69%"><select name="season" id="season"  style="width:200px;" >
                                          <option value="-1" >Select Broadcast Type</option>
                                          <option value="vegatable">VEGETABLE</option>
                                          <option value="others" selected>OTHER CROPS</option>
                                          
                                      </select></td>
                                        
                                  </tr>
                                                    <tr><td colspan="2" align="center">  <input type="submit" value="Next" name="NextCropBroadcast" id="NextCropBroadcast" /></td>
                                                    </tr>
                              </table>
                          </form>
                  </div>
                                                  
                </div>
                                                       
              </div>

                                                        </div>
                                                        <div id="footer">
   <?php include'footer.php';?>
  </div>
                                                        </div>
                                                        </body>
                                                        </html>
