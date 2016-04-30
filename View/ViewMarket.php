<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_POST['Search'])) {

    $username = $_SESSION['username'];

    $errorList = checkState($_POST);
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    if (count($errorList) < 1) {

        if (isset($_POST['lga']) && $_POST['lga'] != '-1') {
            $lga = $_POST['lga'];
            $Marketlist = populatelgaMarket($lga, $startpoint, $limit);
            $MarketCount = mysql_num_rows($Marketlist);
        } else if (isset($_POST['state']) && $_POST['state'] != '-1') {
            $state = $_POST['state'];
            $Marketlist = populateStateMarket($state, $startpoint, $limit);
            $MarketCount = mysql_num_rows($Marketlist);
        }
    } else {
         $Marketlist = entity::populateMarket($startpoint, $limit);
            $MarketCount = mysql_num_rows($Marketlist);
        $error = $errorList;
    }
    $query = $_SESSION['query'];
    //fecth a list of all the menus
    
} elseif (isset($_SESSION['menuName']) or isset($_GET['actionSuccessfull']) && isset($_SESSION['username'])) {
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $menuTableName = $_SESSION['menuTableName'];
    $menuName = $_SESSION['menuName'];
    //fectch all the record for a table
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {

      $Marketlist = entity::populateMarket($startpoint, $limit);
            $MarketCount = mysql_num_rows($Marketlist);
    } 
    else {
        $query = $_SESSION['query'];
         $Marketlist = entity::limitquery($query, $startpoint, $limit);
            $MarketCount = mysql_num_rows($Marketlist);
    }
    /* @var $_SESSION type */
    $query = $_SESSION['query']; 
    
    
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

                   

                 
         })</script>
        </head>

        <body>
            <div id="wrapper">
                <div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
                <div id="header"><?php include 'sliding.php'; ?></div>
                <div id="Navigation"><?php include 'navigation.php'; ?></div>
                <div id="content">
                    <div id="post">
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
                        <div id="view">
                            <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">View Market</div>
    <?php
    if (isset($error)) {
        echo "<div id ='errorMsg'>Please select a State </div>";
    }
    unset($error);
    ?>
                            <div id="SearchHolder">
                                <form id="form1" name="form1" method="post" action="ViewMarket.php">
                                    <table width="100%" cellpadding="5">
                                        <tr id="entityRowEven">
                                            <td width="40%">State </td>
                                            <td width="60%"><select name="state" id="state"  style="width:250px;">
                                                    <option value="-1" >Select State</option>
    <?php
    $state = entity::fetchEntityList('states');
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
                                        <tr id="entityRowOdd">
                                            <td>LGA </td>
                                            <td><select name="lga" id="lga"   style="width:250px;">
                                                    <option >Select LGA</option>
                                                </select>              <div id="lgaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div>
                                            </td>
                                        </tr>
                                        <tr id="entityRowEven">
                                            <td colspan="2"><div id="wardloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>            </td>
                                        </tr>
                                        <tr><td colspan="2" align="center">  <input type="submit" value="Search" name="Search" id="Search" /></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
    <?php
   

        echo "<div id='searchParam'> Search Result for Market </div>";
        ?>

                                <table width="100%" cellpadding="3" class="recordTable" >
                                    <tr id="entityHeader">
                                        <td width="10%">S/N</td>
                                        <td width="30%">MARKET NAME</td>
                                        <td width="36%"> MARKET ADDRESS</td>
                                        <td width="24%">ACTION</td></tr>
        <?php
        if ($MarketCount > 0) {
            for ($index = 0; $index < $MarketCount; $index++) {
                $ID = mysql_result($Marketlist, $index, 0);
                $marketName = mysql_result($Marketlist, $index, 1);
                $marketAddress = mysql_result($Marketlist, $index, 2);
                $sn = $startpoint + 1;
                $startpoint++;
                if ($index % 2 == 0) {
                    $bg = "entityRowOdd";
                } else {
                    $bg = "entityRowEven";
                }
                ?>
                                            <tr id="<?php echo $bg; ?>">
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $marketName; ?></td>
                                                <td><?php echo $marketAddress ?></td>
                                                <td><a href="<?php echo "../Controller/RequestController.php?ViewRecord=$ID" ?>">View</a></td></tr>
                <?php
            }
        } else {
            ?>
                                        <tr bgcolor="#96CA1D">
                                            <td colspan="9" align="center">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </table>
                               
                            <div id="pagination">
                            <?php
                            echo pagination($query, $limit, $page, "ViewMarket.php?");
                            ?>
                            </div>
                        </div>

                    </div>

                </div>
                <div id="footer">
    <?php include'footer.php'; ?>
            </div>
        </div>
    </body>
</html>
