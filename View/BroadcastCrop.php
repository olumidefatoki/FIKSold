<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
if (isset($_SESSION['error']) && isset($_SESSION['username']) && isset($_SESSION['menuTableName']) && isset($_GET['action'])) {

    $errorlist = $_SESSION['error'];
    unset($_SESSION['error']);
    $menuName = $_SESSION['menuName'];
    $entityName = $_SESSION['menuTableName'];
    $username = $_SESSION['username'];
    $action = trim($_GET['action']);
    $userType = $_SESSION['UserType'];
}
$username = $_SESSION['username'];
$userType = $_SESSION['UserType'];
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Fadama Information Knowledge &amp; Services</title>

        <link href="../css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../script/jquery.min.js"></script> 
        <script type="text/javascript" src="../script/jquery-calendar.js"></script>        
        <link rel="stylesheet" type="text/css" href="../script/jquery-calendar.css">
            <link href="../css/main.css" rel="stylesheet" type="text/css" />
            <link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" />
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#calendar1, #calendar2").calendar();
                    $("#calendar1_alert").click(function(){alert(popUpCal.parseDate($('#calendar1').val()))
                    });      
            	
                    $("#state").change(function(){	
                        var id=$(this).val();
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

                    $("#season").change(function(){	
                        var id=$(this).val();
                        $("#Practiseloading").css("display","inline-block");

                        var dataString ='seasonType='+id;
                        $.ajax({
                            type: "GET",
                            url: "../Controller/RequestController.php",
                            data: dataString,
                            cache: false,
                            success: function(html){	
                                $("#messageTitle").html(html);
                                $("#Practiseloading").css("display","none");
                            } 
                        });   
                    });

                    $("#cropID").change(function(){	
                        var id=$(this).val();
                        
                        var msgTitle=$("#messageTitle").val();

                        var season=$("#season").val();
                        var langID=$("#langID").val();
                        if (season==-1) {
                            alert("Select a season");
                            return;
                        }
                        if (msgTitle==-1) {
                            alert("Select a Package of Practise");
                            return;
                        }
                        if (langID==-1) {
                            alert("Select a Language");
                            return;
                        }
                        $("#msgloading").css("display","inline-block");
                        var dataString ='broadcastCropID='+id+'&msgTitle='+msgTitle+'&season='+season+'&langID='+langID;
                        $.ajax({
                            type: "GET",
                            url: "../Controller/RequestController.php",
                            data: dataString,
                            cache: false,
                            success: function(html){ 
                                $("#msgContent").html(html);
                                $("#msgloading").css("display","none");
                                $("#msgContent").css("padding","1px");
                                $("#msgContent").css("display","inline-block");
                                $("#msgContent").css("width","250px");
                                $("#msgContent").css("height","100px");
                                $("#msgContent").css("text-align","justify");
                                $("#msgContent").css("overflow","scroll");
                            } });  });
                })
            </script>
    </head>

    <body>
        <div id="wrapper">
            <div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
            <div id="header"><img src="../images/banner.jpg" width="1000" height="200" /></div>
            <div id="Navigation"><?php include 'navigation.php'; ?></div>
            <div id="content">
                <div id="post">
                    <div id="view">
                        <div id="addRecord"> 
                            Schedule New Broadcast for Crop 

                        </div>
                        <?php
                        if (isset($errorlist)) {
                            echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The following  Information are required</div>";
                        }
                        unset($_SESSION['error']);
                        ?>
                        <div id ="FormHeader"> Please fill all fields </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="3" cellspacing="1" class="recordTable">
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="260">State </td>
                                    <td width="423"><label for="fName"></label>
                                        <select name="state" id="state" style="width:250px;">
                                            <option value="-1" >Select State</option>
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
                                        </select>                                      <?php
                                            if (isset($errorlist)) {
                                                foreach ($errorlist as $value) {

                                                    if ($value == 'state') {

                                                        echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                    }
                                                }
                                            }
                                            ?>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td width="260">LGA</td>
                                    <td width="423"><label for="fName"></label>
                                        <select name="lga" id="lga" style="width:250px;">
                                            <option value="-1">Select LGA</option>
                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'lga') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="lgaloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>
                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="260">Farmer Community Association (FCA)</td>
                                    <td width="423"><label for="fName"></label>
                                        <select name="fca" id="fca"  style="width:250px;">
                                            <option value="-1">Select FCA</option>
                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'fca') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="fcaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowEven">
                                    <td width="260">Farmer User Group (FUG)</td>
                                    <td width="423"><label for="fName"></label>
                                        <select name="fug" id="fug"  style="width:250px;">
                                            <option value="-1">Select FUG</option>
                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'fug') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="fugloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>
                                    </td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Season </td>
                                    <td><select name="season" id="season"  style="width:250px;" >
                                            <option value="-1" >Select  Season</option>
                                            <option value="pre_season">Pre Season</option>
                                            <option value="post_season">Post Season</option>
                                            <option value="in_season">In Season</option>

                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'season') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Package of practise</td>
                                    <td><select name="messageTitle" id="messageTitle" style="width:250px;" >
                                            <option  value="-1">Select  Package of Practise</option>
                                        </select>      <div id="Practiseloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td> Language</td>
                                    <td><select name="langID" id="langID"  style="width:250px;">
                                            <option value="-1">Select  Language</option>
                                            <?php
                                            $langList = entity::fetchEntityList('languages');
                                            $langCount = mysql_num_rows($langList);
                                            for ($index = 0; $index < $langCount; $index++) {
                                                $langid = mysql_result($langList, $index, 'ID');
                                                $langName = mysql_result($langList, $index, 1);
                                                ?>
                                                <option value="<?php echo $langid; ?>"> <?php echo ucfirst($langName); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td></tr>
                                <tr id="entityRowOdd">
                                    <td>Crop </td>
                                    <td><select name="cropID" id="cropID" style="width:250px;" ">
                                            <option  value="-1">Select  Crop </option>
                                            <?php
                                            $cropList = entity::fetchEntityList('crops');
                                            $cropNum = mysql_num_rows($cropList);
                                            for ($index = 0; $index < $cropNum; $index++) {
                                                $fertid = mysql_result($cropList, $index, 'ID');
                                                $fertName = mysql_result($cropList, $index, 1);
                                                ?>
                                                <option value="<?php echo $fertid; ?>"> <?php echo ucfirst($fertName); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'cropID') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>


                                <tr id="entityRowEven">
                                    <td>Message Content</td>
                                    <td><label for="msgContent"></label>
                                        <div id="msgContent"></div>
                                        <input name="stockName" type="hidden" id="stockName" value="crop" />
                                        <?php
                                        if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {

                                                if ($value == 'msgContent') {

                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
                                        ?>
                                        <div id="msgloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div></td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td height="28">Delivery Date</td>
                                    <td><p>
                                            <input name="deliveryDate" type="text" class="calendarFocus" id="calendar1" size="33">
                                                <?php
                                                if (isset($errorlist)) {
                                                    foreach ($errorlist as $value) {

                                                        if ($value == 'deliveryDate') {

                                                            echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                        }
                                                    }
                                                }
                                                ?>
                                        </p></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="">
                                    <td colspan="2" align="right"><input name="BroadcastCrop" type="submit" id="BroadcastCrop"  value="Broadcast"  /> &nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                        </form>
                    </div>
                </div>

                
                <div id="footer">
                    <?php include'footer.php'; ?>
                </div>
            </div>
    </body>
</html>
