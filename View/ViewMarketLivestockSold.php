<?php
//include('../Controller/entity.php');
include('../Controller/RequestController.php');
include('../Controller/ManageSessions.php');
//session_start();
if (isset($_SESSION['menuName']) or isset($_GET['recID']) && isset($_SESSION['username'])) {
    $userType = $_SESSION['UserType'];
    $username = $_SESSION['username'];
    $_SESSION['menuTableName']='marketlivestock';
    $_SESSION['menuName']='marketlivestock';
    $marketID=$_GET['marketID'];
    
    $MarketRecord = entity::fetchRecord('markets',$marketID);
      $marketName=  mysql_result($MarketRecord, 0, 1);
    //fectch all the record for a table
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $startpoint = ($page * $limit) - $limit;
    if (!isset($_SESSION['query'])) {
      
      $Marketlist = entity::populateMarketLivestock($marketID,$startpoint, $limit);
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
           echo 	"<li><a href='../Controller/RequestController.php?add&marketID=$marketID'>Add</a></li>";
		
        }
    }
    if ($UserType == 'State') {
        echo 	"<li><a href='../Controller/RequestController.php?add&marketID=$marketID'>Add </a></li>";
    }
    ?>
                            </ul>
                        </div>
                        <div id="view">
                            <div style="color:#044407; font-size:28px; margin-top:2px ; margin-bottom:10px;">View <?php echo $marketName; ?>  Market Livestock</div>
                            <table width="100%" cellpadding="3" class="recordTable" >
                      <tr id="entityHeader">
                                        <td width="6%">S/N</td>
                                        <td width="20%">Crop Name</td>
                                        <td width="27%">Unit Price(Naira)</td>
                                         <td width="16%">Measurement</td>
                                        <td width="17%">Action</td></tr>
        <?php
        if ($MarketCount > 0) {
            for ($index = 0; $index < $MarketCount; $index++) {
                $ID = mysql_result($Marketlist, $index, 0);
                $cropName = mysql_result($Marketlist, $index, 1);
                $qty = mysql_result($Marketlist, $index, 2);
                $price = mysql_result($Marketlist, $index, 3);
                $measurement = mysql_result($Marketlist, $index, 4);
               
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
                                                <td><?php echo $cropName; ?></td>
                                                <td><?php echo $price; ?></td>
                                                <td><?php echo $measurement; ?></td>
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
