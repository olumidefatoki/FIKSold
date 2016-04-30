<?php
include('../Controller/entity.php');
include('../Controller/utils.php');
include('../Controller/ManageSessions.php');
if (isset($_GET['action']) && isset($_GET['id']) && isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $action = trim($_GET['action']);
    $recID = $_GET['id'];
    $menuName = $_SESSION['menuName'];
    $entityName = $_SESSION['menuTableName'];
    $result = entity::fetchRecord($entityName, $recID);
    $row = mysql_num_rows($result);
    $seasonID = mysql_result($result, 0, 0);
	 $langID=  mysql_result($result, 0, 1);
         $langRow=entity::fetchRecord('languages',$langID);
        $lang= mysql_result($langRow, 0, 1);
    $cropid = mysql_result($result, 0, 3);
    $cropRow = entity::fetchRecord('crops', $cropid);
    $cropName = mysql_result($cropRow, 0, 1);
    $siteSelection = mysql_result($result, 0, 4);
    $landPreparation = mysql_result($result, 0, 5);
    $ploughing = mysql_result($result, 0, 6);
    $harrowing = mysql_result($result, 0, 7);
    $ridging = mysql_result($result, 0, 8);
    $extraInfo1 = mysql_result($result, 0, 9);
    $extraInfo2 = mysql_result($result, 0, 10);
    $extraInfo3 = mysql_result($result, 0, 11);

    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} else if (isset($_GET['action']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $menuName = $_SESSION['menuName'];
    $action = trim($_GET['action']);
    $entityName = $_SESSION['menuTableName'];
    $menuList = entity::fetchMenu();
    $menuRow = mysql_num_rows($menuList);
} else {
    header('location:../index.php');
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
                        <div id="addRecord">
<?php
if ($action == 'add') {
    echo 'Add New ' . $menuName;
} else if ($action == 'update') {
    echo 'Update  ' . $menuName . '  Details for ' . ucfirst($cropName);
}
if (isset($_GET['respond'])) { 
           echo "<div id='errorMsg'>";
           echo 'Duplicate Entry. Record already exist <br>'; 
           echo "</div>";
        } 
?>

                        </div>
                        <div style="color:#FFF;">
                            Please fill all fields
                        </div>
                        <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
                            <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">

                                <tr id="entityRowEven">
                                    <td width="129">Crop Name</td>
                                    <td width="546">


                        <?php
                        if ($action == 'update') {
                            echo strtoupper($cropName); 
                            ?>      
                                            <input type="hidden" name="id" id="id" value="<?php echo $seasonID; ?>">
                                <?php
                            } else {
                                ?> 
                                                <select name="cropID" id="cropID">
                                            <?php
                                            $cropList = entity::fetchEntityList('crops');
                                            $cropNum = mysql_num_rows($cropList);
                                            for ($index = 0; $index < $cropNum; $index++) {
                                                $cropId = mysql_result($cropList, $index, 'ID');
                                                $cropName = mysql_result($cropList, $index, 1);
                                                ?>
                                                        <option value="<?php echo $cropId; ?>"> <?php echo ucfirst($cropName); ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>  
                                                <?php
                                            }
                                            ?>

                                    </td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td> Language</td>
                                    <td> <?php 
                   if ($action=='update') {
                    echo strtoupper($lang);   
                   }
                   else{
                   ?>
                <select name="langID" id="langID">
                  <?php  
			$cropList=entity::fetchEntityList('languages');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                  <option value="<?php echo $fertid; ?>"> <?php echo $fertName; ?></option>
                  <?php  
			}
			?>
                </select>
                  <?php
                   }
                   ?>
                <input name="recID" type="hidden" id="ID" value="<?php if($action=='update'){echo $recID;} ?>"/></td>
                                </tr>
                                <tr bgcolor="#96CA1D" id="entityRowOdd">
                                    <td width="129">Access Channel</td>
                                    <td width="546"><label for="fName"></label>
                                        <select name="accessChannel" id="accessChannel">
                                          <option value="Web">Web</option>
                                          <option value="Mobile">Mobile</option>
                                        </select></td>
                                </tr>
                                <tr id="entityRowEven">
                                    <td>Site Selection</td>
                                    <td><label for="gender"></label>
                                  <textarea name="site" cols="60" rows="6" id="site">
<?php
if ($action == 'update') {
    echo $siteSelection;
}
?>
                                        </textarea></td>
                                </tr>
                                <tr id="entityRowOdd">
                                    <td>Land Preparation</td>
                                    <td>            <span >
                                        <textarea name="land" cols="60" rows="6" id="land">
                                            <?php
                                            if ($action == 'update') {
                                                echo $landPreparation;
                                            }
                                            ?>
                                            </textarea>
                                  </span></td>
                                </tr>

                                <tr id="entityRowEven">
                                    <td>Ploughing</td>
                                    <td><textarea name="ploughing" cols="60" rows="6" id="ploughing" $description="$description">
<?php
if ($action == 'update') {
    echo $ploughing;
}
?>
                                    </textarea></td>
                            </tr>
                            <tr bgcolor="#96CA1D" id="entityRowOdd">
                                <td>Harrowing</td>
                                <td><label for="fName"></label>
                                    <textarea name="harrowing" cols="60" rows="5" id="harrowing">
                  <?php
if ($action == 'update') {
    echo $harrowing;
}
?>
                                    </textarea></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td>Ridging</td>
                                <td><textarea name="ridging" cols="60" rows="5" id="ridging" >
                                        <?php
                                        if ($action == 'update') {
                                            echo $ridging;
                                        }
                                        ?>
                                    </textarea></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td>Extra Info</td>
                                <td><textarea name="extraInfo" cols="60" rows="5" id="extraInfo">
                                        <?php
                                        if ($action == 'update') {
                                            echo $extraInfo1;
                                        }
                                        ?>
                                    </textarea></td>
                            </tr>
                            <tr id="entityRowEven">
                                <td>Extra Info2</td>
                                <td><textarea name="extraInfo2" cols="60" rows="5" id="extraInfo2" >
<?php if ($action == 'update') {
    echo $extraInfo2;
} ?>
                                    </textarea></td>
                            </tr>
                            <tr id="entityRowOdd">
                                <td>Extra Info3</td>
                                <td><textarea name="extraInfo3" cols="60" rows="5" id="extraInfo3" >
<?php if ($action == 'update') {
    echo $extraInfo3;
} ?>
                                    </textarea></td>
                            </tr>
                            <tr bgcolor="#96CA1D" id="entityRowEven">
                                <td>&nbsp;</td>
                                <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>"  /></td>
                            </tr>
                        </table>

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
