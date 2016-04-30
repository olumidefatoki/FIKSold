<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_POST['SearchFarmer'])) {
    $userType = $_SESSION['UserType'];
    $displayTitle = true;
    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    $errorList = checkState($_POST);

    if (count($errorList) < 1) {
        if (isset($_POST['fug']) && $_POST['fug'] != '-1') {
            $fugId = $_POST['fug'];
            $Farmerlist = populatefugFarmer($fugId, $startpoint, $limit);
            $farmerCount = mysql_num_rows($Farmerlist);
        } else if (isset($_POST['fca']) && $_POST['fca'] != '-1') {
            $fca = $_POST['fca'];
            $Farmerlist = populatefcaFarmer($fca, $startpoint, $limit);
            $farmerCount = mysql_num_rows($Farmerlist);
        } else if (isset($_POST['lga']) && $_POST['lga'] != '-1') {
            $lga = $_POST['lga'];
            $Farmerlist = populateLgaFarmer($lga, $startpoint, $limit);
            $farmerCount = mysql_num_rows($Farmerlist);
        } else if (isset($_POST['state']) && $_POST['state'] != '-1') {
            $state = $_POST['state'];
            $Farmerlist = populateStateFarmer($state, $startpoint, $limit);
            $farmerCount = mysql_num_rows($Farmerlist);
        }
    } else {
        $Farmerlist = populateStateFarmer('0', $startpoint, $limit);
        $farmerCount = mysql_num_rows($Farmerlist);
        $error = $errorList;
    }
    $query = $_SESSION['query'];
    //fecth a list of all the menus
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} elseif (isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username'])) {
    $displayTitle = false;
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];
    //fectch all the record for a table
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {

        $stateRow = "";
        if ($userType == 'State') {
            $stateId = $_SESSION['stateId'];
            $Farmerlist = entity::fetchAllStateFarmerList($menuTableName, $startpoint, $limit, $stateId);
        } elseif ($userType == 'SuperAdmin') {
            $Farmerlist = entity::fetchFarmerList($menuTableName, $startpoint, $limit);
        }



        $farmerCount = mysql_num_rows($Farmerlist);
    } else {
        $query = $_SESSION['query'];
        $Farmerlist = entity::limitquery($query, $startpoint, $limit);
        $farmerCount = mysql_num_rows($Farmerlist);
    }
    $query = $_SESSION['query'];
    //fecth a list of all the menus
    

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
        <script type="text/javascript" src="../script/jquery.min.js"></script>

        <link href="../css/main.css" rel="stylesheet" type="text/css" />
        <link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />

        <script type="text/javascript">
            $(document).ready(function(){	
                $("#state").change(function(){	
                    var id=$(this).val();

                    if (id==-1) {
                        alert('Please select a  State ') ;  
                        return;  
                    }
                    $("#lgaloading").css("display","inline-block");
                    var dataString ='stateId='+id;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#lga").html(html);
                            $("#lgaloading").css("display","none");
                            $("#fca").html("<option value='-1'>Select FCA</option>");
                            $("#fug").html("<option value='-1'>Select FUG</option>");
                        } 
                    });
 
                });

                $("#lga").change(function(){	
                    var id=$(this).val();
                    $("#fcaloading").css("display","inline-block");
                    var dataString ='farmerlgaid='+id;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#fca").html(html);
                            $("#fcaloading").css("display","none");} 
                    });   
                });

                $("#fca").change(function(){	
                    var id=$(this).val();
                    $("#fugloading").css("display","inline-block");
                    var dataString ='fcaId='+id;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#fug").html(html);
                            $("#fugloading").css("display","none");} 
                    });   
                });

            })</script>
    </head>

    <body>
        <div id="wrapper">
            <div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
            <div id="header"><?php include 'sliding.php'; ?></div>
            <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
                <div id="post">
                    <div id="view">
                        <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;"><?php echo $menuName . 's'; ?>

                        </div>
                        <?php
                        if (isset($error)) {
                            echo "<div id ='errorMsg'>  Please   select a State </div>";
                        }
                        unset($error);
                        ?>
                        <div id="SearchHolder">
                            <form id="form1" name="form1" method="post" action="ViewFarmers.php">
                                <table width="100%" cellpadding="5">
                                    <tr><td width="38%">       State : </td>
                                        <td width="62%">
                                            <select name="state" id="state" style="width:250px;">
                                                <option value="-1" >Select  State</option>
                                                <?php
                                                $state = "";
                                                if ($userType == 'State') {
                                                    $stateId = $_SESSION['stateId'];
                                                    $state = entity::fetchState('states', $stateId);
                                                } elseif ($userType == 'SuperAdmin') {
                                                    $state = entity::fetchEntityList('states');
                                                }
                                                $stateRows = mysql_num_rows($state);
                                                for ($i = 0; $i < $stateRows; $i++) {
                                                    $stateID = mysql_result($state, $i, 'stateID');
                                                    $stateName = mysql_result($state, $i, 'stateName');
                                                    ?>
                                                    <option value="<?php echo $stateID; ?>"><?php echo $stateName; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td> LGA :</td>
                                        <td>
                                            <select name="lga" id="lga"   style="width:250px;">
                                                <option value="-1" >Select LGA</option>

                                            </select>
                                            <div id="lgaloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>
                                    </tr>
                                    <tr><td>  Farmer Community Association (FCA) : </td><td>
                                            <select name="fca" id="fca"  style="width:250px;">
                                                <option value="-1" >Select FCA</option>

                                            </select>
                                            <div id="fcaloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>
                                    </tr>
                                    <tr><td> Farmer User Group (FUG) : </td>
                                        <td>
                                            <select name="fug" id="fug"  style="width:250px;">
                                                <option value="-1" >Select FUG</option>

                                            </select>
                                            <div id="fugloading"> <img src="../images/ajax-loader3.gif" alt=""/> Loading </div></td>
                                    </tr>
                                    <tr><td colspan="2" align="center">  <input type="submit" value="Search" name="SearchFarmer" /></td></tr>

                                </table>
                            </form>
                        </div>
                        <?php if ($displayTitle == true) { ?>
                            <div id="searchParam"> Search Result for Farmer </div>
                        <?php } ?>
                        <table width="100%" cellpadding="3" class="recordTable" >
                            <tr bgcolor="#96C000" id="entityHeader">
                                <td width="6%" >S/N</td>
                                <td width="31%"> Name</td>
                                <td width="22%" > Phone Number</td>
                                <td width="24%" > Address</td>
                                <td width="17%">Action</td>
                            </tr>
                            <?php
                            $i = 0;
                            if ($farmerCount > 0) {
                                for ($index = 0; $index < $farmerCount; $index++) {
                                    $farmerId = mysql_result($Farmerlist, $index, 0);
                                    $firstName = mysql_result($Farmerlist, $index, 1);
                                    $lastName = mysql_result($Farmerlist, $index, 2);
                                    $phoneNo = mysql_result($Farmerlist, $index, 3);
                                    $address = mysql_result($Farmerlist, $index, 4);
                                    $sn = $startpoint + 1;
                                    $startpoint++;
                                    if ($i % 2 == 0) {
                                        $bg = "entityRowOdd";
                                    } else {
                                        $bg = "entityRowEven";
                                    }
                                    $i++;
                                    ?>
                                    <tr id="<?php echo $bg; ?>">
                                        <td><?php echo $sn; ?></td>

                                        <td><?php echo ucwords($firstName . ' ' . $lastName); ?></td>
                                        <td><?php echo $phoneNo; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><a href="<?php echo "../Controller/RequestController.php?ViewRecord=$farmerId" ?>"> View </a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr bgcolor="#96CA1D">
                                    <td colspan="5" align="center">No Record Found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <div id="pagination">
                            <?php
                            echo pagination($query, $limit, $page, "ViewFarmers.php?");
                            ?>
                        </div>
                    </div>
                    <div id="subMenu">
                    <ul>
                        <?php
                        $UserType = $_SESSION['UserType'];
                        $roles = $_SESSION['Roles'];
                        $rolesList = explode(",", $roles);
                        foreach ($rolesList as $value) {
                            if ($value == 2) {
                                include'sideMenu.php';
                            }
                        }
                        if ($UserType == 'State') {
                            include'sideMenu.php';
                        }
                        ?>
                        </ul>
                    </div>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>

            </div>
            <div id="footer">
                <?php include'footer.php'; ?>
            </div>
        </div>
    </body>
</html>
