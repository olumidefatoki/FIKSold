<?php
include('../Controller/utils.php');
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if (isset($_GET['ViewRecord'])) {
	    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];

    $Recordlist = entity::fetchRecord('onion', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $ClimateSoil = mysql_result($Recordlist, 0, 3);
        $SeedRate = mysql_result($Recordlist, 0, 4);        
        $Varieties = mysql_result($Recordlist, 0, 5);
        $Spacing = mysql_result($Recordlist, 0, 6);
        $NutrientMag = mysql_result($Recordlist, 0, 7);
        $PestMag= mysql_result($Recordlist, 0, 8);
        $DiseaseMag = mysql_result($Recordlist, 0, 9);
        $Yield = mysql_result($Recordlist, 0, 10);
           
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
      <div id="addRecord">Onion Information  Details
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
            <tr  id="entityRowEven">
              <td width="205">Access Channel</td>
              <td width="438"><label for="fName"><?php echo ucfirst($accessChannel); ?></label></td>
            </tr>
            <tr  id="entityRowOdd">
              <td> Language</td>
              <td><?php echo htmlspecialchars_decode($lang); ?></td>
            </tr>
            <tr id="entityRowEven">
              <td>Climate Soil</td>
              <td><?php
                        $list = splitContent($ClimateSoil);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Season and Seed Rate</p></td>
              <td><?php
                        $list = splitContent($SeedRate);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Varieties</p></td>
              <td><?php
                        $list = splitContent($Varieties);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td><p>Spacing</p></td>
              <td><?php
                        $list = splitContent($Spacing);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Nutrient Management</p></td>
              <td><?php
                        $list = splitContent($NutrientMag);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Pest Management</p></td>
              <td><?php
                        $list = splitContent($PestMag);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Disease Management</p></td>
              <td><?php
                        $list = splitContent($DiseaseMag);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Harvest and Yield</p></td>
              <td><?php
                        $list = splitContent($Yield);
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
