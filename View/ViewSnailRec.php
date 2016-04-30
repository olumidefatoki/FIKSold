<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if (isset($_GET['ViewRecord'])) {
    $username = $_SESSION['username'];

//    $menuTableName = $_SESSION['menuTableName'];
//    $menuName = $_SESSION['menuName'];
    $recID = $_GET['ViewRecord'];

    $Recordlist = entity::fetchRecord('snail', $recID);
    $recordRow = mysql_num_rows($Recordlist);
    if ($recordRow > 0) {
        
                
        $langID = mysql_result($Recordlist, 0, 1);
        $langList = entity::fetchRecord('languages', $langID);
        $lang = mysql_result($langList, 0, 1);
        $accessChannel= mysql_result($Recordlist, 0, 2);
        $SiteSelection = mysql_result($Recordlist, 0, 3);
        $RecommendedSpecies = mysql_result($Recordlist, 0, 4);
        $SnaileryConstruction = mysql_result($Recordlist, 0, 5);
        $FoodFeeding = mysql_result($Recordlist, 0, 6);
        $PredatorsParasitesDiseases = mysql_result($Recordlist, 0, 7);
        $BreedingManagement = mysql_result($Recordlist, 0, 8);
        $HarvestingStorage = mysql_result($Recordlist, 0, 9);
        $Market = mysql_result($Recordlist, 0, 10);
        $ExtraInfo = mysql_result($Recordlist, 0, 11);        
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

                            Snail Information  Details
                       
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
                                <td width="218">Site  Selection </td>
                                <td width="420"><?php
                        $list = splitContent($SiteSelection);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Recommended Species</td>
                                <td width="420"><?php
                        $list = splitContent($RecommendedSpecies);
                        foreach ($list as $value) {
                            echo htmlspecialchars_decode($value) . '<br>';
                        }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Snailery Construction</td>
                                <td width="420"><?php
                                    $list = splitContent($SnaileryConstruction);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Food Feeding </td>
                                <td width="420"><?php
                                    $list = splitContent($FoodFeeding );
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Predators & Parasites & Diseases</td>
                                <td width="420"><?php
                                    $list = splitContent($PredatorsParasitesDiseases);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Breeding  Management</td>
                                <td width="420"><?php
                                    $list = splitContent($BreedingManagement);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Harvesting & Storage</td>
                                <td width="420"><?php
                                    $list = splitContent($HarvestingStorage);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td width="218">Market </td>
                                <td width="420"><?php
                                    $list = splitContent($Market);
                                    foreach ($list as $value) {
                                        echo htmlspecialchars_decode($value) . '<br>';
                                    }
                            ?></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td width="218">Extra Info</td>
                                <td width="420"><?php
                                    $list = splitContent($ExtraInfo);
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
