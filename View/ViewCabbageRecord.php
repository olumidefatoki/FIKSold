<?php
include('../Controller/utils.php');
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if (isset($_GET['ViewRecord'])) {
	    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];
    $Recordlist = entity::fetchRecord('cabbages', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $SiteSelection = mysql_result($Recordlist, 0, 3);
        $Climate = mysql_result($Recordlist, 0, 4);
        $Cultivation = mysql_result($Recordlist, 0, 5);
        $Seedling = mysql_result($Recordlist, 0, 6);
        $Spacing = mysql_result($Recordlist, 0, 7);
        $Fertilizer = mysql_result($Recordlist, 0, 8);
        $WeedControl= mysql_result($Recordlist, 0, 9);
        $Disease = mysql_result($Recordlist, 0, 10);
        $Harvesting= mysql_result($Recordlist, 0, 11);
        $Yield = mysql_result($Recordlist, 0, 12);
           
    }
    else {
    header('location:../index.php');
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
      <div id="addRecord">Cabbage Information  Details
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
              <td width="438"><label for="fName"><?php echo ucfirst($accessChannel); ?></label></td>
            </tr>
            <tr  id="entityRowEven">
              <td> Language</td>
              <td><?php echo htmlspecialchars_decode($lang); ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td>Site Selection</td>
              <td><label for="gender">
                <?php
                        $list = splitContent($SiteSelection);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?>
              </label></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Climate</p></td>
              <td><?php
                        $list = splitContent($Climate);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Cultivation</p></td>
              <td><?php
                        $list = splitContent($Cultivation);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr  id="entityRowEven">
              <td><p>Raising Of Seedling</p></td>
              <td><?php
                        $list = splitContent($Seedling);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Trasplanting and Spacing</p></td>
              <td><?php
                        $list = splitContent($Spacing);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Manures and Fertilizer</p></td>
              <td><?php
                        $list = splitContent($Fertilizer);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Weed Control and Interculture</p></td>
              <td><?php
                        $list = splitContent($WeedControl);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Disease</p></td>
              <td><?php
                        $list = splitContent($Disease);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Harvesting</p></td>
              <td><?php
                        $list = splitContent($Harvesting);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Storage and Yield</p></td>
              <td><?php
                        $list = splitContent($Yield);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr  id="entityRowOdd">
              <td height="45">&nbsp;</td>
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
