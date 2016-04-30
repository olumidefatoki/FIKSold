<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if(isset($_GET['action']) && isset($_GET['id']))
    {	
        $username=$_SESSION['username'];
        $action=trim($_GET['action']);
        $recID=$_GET['id'];
        $menuName=$_SESSION['menuName'];
        $entityName=$_SESSION['menuTableName'];
        $result= entity::fetchRecord($entityName,$recID);
        $row=mysql_num_rows($result);
        if ($row>0) {   
         $langID=  mysql_result($result, 0, 1);
         $langRow=entity::fetchRecord('crops',$langID);
        $lang= mysql_result($langRow, 0, 1);
        $accessChannel=  mysql_result($result, 0, 2);
        $SiteSelection=  mysql_result($result, 0, 3);
        $HousingEquipment= mysql_result($result, 0, 4);
        $BreedsBreeding=mysql_result($result, 0, 5);
        $PigManagement=  mysql_result($result, 0, 6);
        $FeedsFeeding=  mysql_result($result, 0, 7);
        $HealthManagement=  mysql_result($result, 0, 8);
        $Processing=  mysql_result($result, 0, 9);
        $Marketing=  mysql_result($result, 0, 10);
         }
         else{
             header("Location:../index.php");
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
            header('location:../index.php');
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
		if ($action == 'add') {
    echo "Add New  {$menuName} Details";
     } 
		 else if($action=='update'){
			  echo 'Update  '.$menuName;
			  }?>
      </div>
                          
        <?php        
		 if (isset($errorlist)) {
           echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The following Information are required</div>";
           }
                            unset($_SESSION['error']);
           if (isset($_GET['respond'])) { 
           echo "<div id='errorMsg'>";
           echo 'Duplicate Entry. Record already exist <br>'; 
           echo "</div>";
        } 
		?>
   
      <div id ="FormHeader"> Please fill all fields </div>
      <div id ="FormHeader">
        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
          <table width="100%" border="0" cellpadding="3"  class="recordTable">
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td width="205">Company Name</td>
              <td width="438"><label for="companyName"></label>
                <input name="companyName" type="text" id="companyName" size="40">                <label for="fName"></label></td>
            </tr>
            <tr  id="entityRowEven">
              <td> Contact Name</td>
              <td><input name="contactName" type="text" id="contactName" size="40"></td>
            </tr>            
            <tr id="entityRowEven">
              <td>Address</td>
              <td><label for="gender">
                <textarea name="address" cols="40" rows="3" id="address"></textarea>
              </label></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Email</p></td>
              <td><input name="email" type="text" id="email" size="40"></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Phone Number</p></td>
              <td><input name="phoneNumber" type="text" id="phoneNumber" size="40"></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td><p>State</p></td>
              <td><select name="state" id="state"  style="width:250px;">
                <option value="-1" >Select State</option>
                <?php
    $state = entity::fetchEntityList('states');
    $stateRows = mysql_num_rows($state);
    for ($i = 0; $i < $stateRows; $i++) {
        $stateID = mysql_result($state, $i, 'stateID');
        $stateName = mysql_result($state, $i, 'stateName');
        ?>
                <option value="<?php echo $stateName; ?>"><?php echo $stateName; ?></option>
                <?php
                                                    }
                                                    ?>
              </select></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>&nbsp;</p></td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td>&nbsp;</td>
              <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>" /></td>
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
