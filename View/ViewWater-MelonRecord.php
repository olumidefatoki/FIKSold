<?php
include('../Controller/utils.php');
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
    if (isset($_GET['ViewRecord'])) {
	    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];

    $Recordlist = entity::fetchRecord('watermelon', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $LandPreparation = mysql_result($Recordlist, 0, 3);
        $Manuring = mysql_result($Recordlist, 0, 4);
        $Aftercultivation = mysql_result($Recordlist, 0, 5);
        $DiseasePest = mysql_result($Recordlist, 0, 6);
        $SeedRate= mysql_result($Recordlist, 0, 7);
        
           
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
      <div id="addRecord">Water-Melon Information  Details
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
              <td width="438"><?php echo ucfirst($accessChannel); ?></td>
            </tr>
            <tr  id="entityRowOdd">
              <td> Language</td>
              <td><?php echo ucfirst($lang); ?></td>
            </tr>
            <tr id="entityRowEven">
              <td>Land Preparation</td>
              <td><?php
                        $list = splitContent($LandPreparation);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowOdd">
              <td><p>Manuring</p></td>
              <td><?php
                        $list = splitContent($Manuring);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Aftercultivation</p></td>
              <td><?php
                        $list = splitContent($Aftercultivation);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr bgcolor="#96CA1D" id="entityRowOdd">
              <td><p>Disease Pest</p></td>
              <td><?php
                        $list = splitContent($DiseasePest);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
            </tr>
            <tr id="entityRowEven">
              <td><p>Seed Rate Spacing</p></td>
              <td><?php
                        $list = splitContent($SeedRate);
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
