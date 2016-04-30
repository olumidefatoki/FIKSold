<?php
include('../Controller/utils.php');
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if (isset($_GET['ViewRecord'])) {
	    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];

    $Recordlist = entity::fetchRecord('piggery', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $Site_Selection = mysql_result($Recordlist, 0, 4);
        $HousingEquipment = mysql_result($Recordlist, 0, 3);
        $BreedsBreeding = mysql_result($Recordlist, 0, 5);
        $PigManagement = mysql_result($Recordlist, 0, 6);
        $FeedsFeeding = mysql_result($Recordlist, 0, 7);
        $HealthManagement = mysql_result($Recordlist, 0, 8);
        $processing= mysql_result($Recordlist, 0, 9);
        $Marketing = mysql_result($Recordlist, 0, 10);
           
    }
    else {
    header('location:index.php');
    exit();
    }
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
      <div id="addRecord">Poultry Information  Details
        <?php
                            if (isset($_GET['action'])) {
                                $action = $_GET['action'];
                                if ($action == 'add')
                                    $msg = 'Added';
                                if ($action == 'update')
                                    $msg = 'Updated';

                                echo "<div id='Success'><img src='../images/s_success.png'/>  Record was Successfully {$msg}</div>";
                            }
                            ?>
      </div>
      <div id ="FormHeader">
        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
          <table width="100%" border="0" cellpadding="3"  class="recordTable">
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td width="205">Access Channel</td>
              <td width="438"><?php echo ucfirst($accessChannel); ?></td>
            </tr>
            <tr  id="entityRowEven">
              <td> Language</td>
              <td><?php echo htmlspecialchars_decode($lang); ?></td>
            </tr>
            
            <tr id="entityRowEven">
              <td>Site Selection</td>
              <td><?php
                        $list = splitContent($Site_Selection);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Housing and Equipment</p></td>
              <td><?php
                        $list = splitContent($HousingEquipment);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Breeds and Breeding</p></td>
              <td><?php
                        $list = splitContent($BreedsBreeding);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td><p>Pig  Management</p></td>
              <td><?php
                        $list = splitContent($PigManagement);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Feeds and Feeding</p></td>
              <td><?php
                        $list = splitContent($FeedsFeeding);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Health Management</p></td>
              <td><?php
                        $list = splitContent($HealthManagement);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Processing</p></td>
              <td><?php
                        $list = splitContent($processing);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Marketing</p></td>
              <td><?php
                        $list = splitContent($Marketing);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td>&nbsp;</td>
              <td align="right">&nbsp;</td>
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
