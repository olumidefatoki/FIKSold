<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if( isset($_GET['ViewRecord']))
    {	
        $username=$_SESSION['username'];
       
        $recID=$_GET['ViewRecord'];
        $menuName=$_SESSION['menuName'];
        $entityName=$_SESSION['menuTableName'];
        $Marketlist = entity::populateAgroBusinessRec($recID);
        $MarketCount = mysql_num_rows($Marketlist);
        if ($MarketCount>0) {   
                $ID = mysql_result($Marketlist, 0, 0);
                $companyName = mysql_result($Marketlist, 0, 1);
                $contact = mysql_result($Marketlist, 0, 2);
                $Address = mysql_result($Marketlist, 0, 3);
                $email = mysql_result($Marketlist, 0, 4);
                $phoneNumber = mysql_result($Marketlist, 0, 5);
                $state = mysql_result($Marketlist, 0, 6);
         }
         else{
        //     header("Location:../index.php");
         }       
    }

    else if(isset($_GET['action']) && isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
        $menuName=$_SESSION['menuName'];
        $action=trim($_GET['action']);
        $entityName=$_SESSION['menuTableName'];
       if (isset($_SESSION['error'])) {
        $errorlist = $_SESSION['error'];
        unset($_SESSION['error']);
    }

    }
    else{
      //      header('location:../index.php');
    }

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fadama Information Knowledge &amp; Services</title>

<link href="../css/main.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="../script/customscripts.js"></script>
      
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
  <div id="header"><div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
    <div id="view">
      <div id="addRecord">
                   
        <?php        
		 if (isset($errorlist)) {
           echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The following Information are required</div>";
           }
                            unset($_SESSION['error']);
           if (isset($_GET['respond'])) { 
           echo "<div id='errorMsg'>";
           echo 'Duplicate Entry. Record already exist <br>'; 
           echo "</div>";
        } ?>
   
      <div id ="FormHeader">
        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
          <table width="100%" border="0" cellpadding="3"  class="recordTable">
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td width="205">Company Name</td>
              <td width="438"><label for="companyName"></label> 
              <label for="fName"><?php echo $companyName; ?></label></td>
            </tr>
            <tr  id="entityRowEven">
              <td> Contact Name</td>
              <td><?php echo $contact; ?></td>
            </tr>            
            <tr id="entityRowEven">
              <td>Address</td>
              <td><?php echo $Address; ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Email</p></td>
              <td><?php echo $email; ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Phone Number</p></td>
              <td><?php echo $phoneNumber; ?></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td><p>State</p></td>
              <td><?php echo $state; ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>&nbsp;</p></td>
              <td>&nbsp;</td>
            </tr>
            
          </table>
        </form>
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
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
<div id="footer">
  <?php include'footer.php';?>
</div>
</div>
</body>
</html>
