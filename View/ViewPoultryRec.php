<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if (isset($_GET['ViewRecord'])) {
    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];

    $Recordlist = entity::fetchRecord('poultry', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $Site_Selection = mysql_result($Recordlist, 0, 4);
        $Housing = mysql_result($Recordlist, 0, 3);
        $Recommended_Breeds = mysql_result($Recordlist, 0, 5);
        $Feeds_Feeding_Equipment = mysql_result($Recordlist, 0, 6);
        $Pests_Diseases_Management = mysql_result($Recordlist, 0, 7);
        $Record_Management = mysql_result($Recordlist, 0, 8);
        $Waste_Management_Sanitation = mysql_result($Recordlist, 0, 10);
        $Processing  = mysql_result($Recordlist, 0, 9);
           
    }
    else {
    header('location:index.php');
    exit();
    }
    
//    $menuList = entity::fetchMenu();
//    $menuRow = mysql_num_rows($menuList);
//    $entityList = entity::fetchRecord($menuTableName, $recID);
//    $entityName = mysql_result($entityList, 0, 0);
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
                        <div id="viewHeader">
                            Poultry Information  Details                       
                            <?php
                            if (isset($_GET['action'])) {
                                $action = $_GET['action'];
                                if ($action == 'add')
                                    $msg = 'Added';
                                if ($action == 'update')
                                    $msg = 'Updated';

                                echo "<div id='Success'><img src='../images/s_success.png'/>  Record was Successfully {$msg}</div>";
                            }
                            ?> </div>
                        <table width="100%"  class="recordTable" cellpadding="5" >
                            <tr id="entityRowOdd">
                                <td width="218">Access Channel</td>
                                <td width="420"><?php echo ucfirst($accessChannel); ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Language</td>
                                <td width="420"><?php echo htmlspecialchars_decode($lang); ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Housing </td>
                                <td width="420"><?php
                        $list = splitContent($Housing);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Recommended Breeds</td>
                                <td width="420"><?php
                        $list = splitContent($Recommended_Breeds);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Feeds_Feeding_Equipment</td>
                                <td width="420"><?php
                                    $list = splitContent($Feeds_Feeding_Equipment);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Pests & Diseases & Management </td>
                                <td width="420"><?php
                                    $list = splitContent($Pests_Diseases_Management );
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Record Management</td>
                                <td width="420"><?php
                                    $list = splitContent($Record_Management);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Waste Management Sanitation</td>
                                <td width="420"><?php
                                    $list = splitContent($Waste_Management_Sanitation);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Processing</td>
                                <td width="420"><?php
                                    $list = splitContent($Processing);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>          
                          
                        </table>
                    </div>
                    <div id="subMenu">
                    <ul>
<?php include'sideMenu.php'; ?>
</ul>
                    </div>
                </div>

            </div>
            <div id="footer">
<?php include'footer.php'; ?>
            </div>
        </div>
    </body>
</html>
