<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
 if(isset($_GET['action']) && isset($_GET['id'])&& isset($_SESSION['username']))
{

$username=$_SESSION['username'];
$action=trim($_GET['action']);
$recID=$_GET['id'];
$menuName=$_SESSION['menuName'];
$entityName=$_SESSION['menuTableName'];
$result= entity::fetchMarketCropRec($recID);
$row=mysql_num_rows($result);
                $ID = mysql_result($result, 0, 0);
                $cropName = mysql_result($result, 0, 1);
                $qty = mysql_result($result, 0, 2);
                $price = mysql_result($result, 0, 3);
                $measurement = mysql_result($result, 0, 4);
                $marketName=mysql_result($result, 0, 5);
                $marketID=mysql_result($result, 0, 6);

$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
}

else if(isset($_GET['action']) && isset($_SESSION['username'])  && isset($_GET['marketID']))
{
	$marketID=$_GET['marketID'];
if (isset($_SESSION['error'])) {
        $errorlist = $_SESSION['error'];
        unset($_SESSION['error']);
    }
$username=$_SESSION['username'];
$menuName=$_SESSION['menuName'];
$action=trim($_GET['action']);
$entityName=$_SESSION['menuTableName'];
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);

}
else{
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
<link  href="../css/dropdownMenu.css" media="screen" rel="stylesheet" type="text/css" /></head>
<script type="text/javascript">
            $(document).ready(function(){	
                $("#crop").change(function(){	
                    var id=$(this).val();
                    
                    if (id==-1) {
                        alert('Please select a  Crop ') ;  
                        return;  
                    }
                   
                    var dataString ='livestockMeasurement='+id;
					
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#measurement").html(html);
                            $("#lgaloading").css("display","none");
                            
                        } 
                    });
 
                });

              

             
            })</script>
<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
<div id="content">
  <div id="post">
      <div id="view">
      <div id="addRecord">
        <?php  if($action=='add'){
		echo 'Add New '.$menuName;
		}
		 else if($action=='update'){
			  echo 'Update  '.$menuName.' Details';
			  } ?>
        </div>
         <?php
                   if (isset($errorlist)) {
                                echo "<div id ='errorMsg'> <div class ='errorColor'> * </div> The following Information are required</div>";
                            }
                            unset($_SESSION['error']);
							if (isset($_GET['respond'])) { 
           echo "<div id='errorMsg'>";
           echo 'Duplicate Entry. Record already exist <br>'; 
           echo "</div>";
        } 
        
		?>
      <div style="color:#FFF;">
      Please fill all fields
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
        <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="139"> Crop</td>
            <td width="257"><label for="name"></label>
                  <input type="hidden" name="id" id="id" value="<?php if($action=='update'){echo $ID;} ?>" />
            <?php 
                   if ($action=='update') {
                    echo strtoupper($cropName); 
					  
                   }
                   
					else{
                   ?>
              <select name="crop" id="crop" style="width:190px;" >
                <option value="-1">Select a Livestock </option>
                <?php  
			$cropList=entity::fetchEntityList('animalhusbandry');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
                <option value="<?php echo $fertid; ?>" selected> <?php echo ucfirst($fertName); ?></option>
                <?php  
			}
			?>
              </select>
            
              <input type="hidden" name="marketID" id="marketID" value="<?php  echo $marketID; ?>" />
              <?php
			  if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'crop') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
				   }
			  ?>
              
              </td>
          </tr>
          <tr id="entityRowEven">
            <td>Unit Price </td>
            <td><input name="unitPrice" type="text" id="unitPrice" size="18"> <?php
			  if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'unitPrice') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
			  ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Measurement</td>
            <td>
                <?php 
                   if ($action=='update') {
                    echo strtoupper($measurement);   
                   }
                   else{
                   ?>
                <select name="measurement" id="measurement" style="width:190px;" onchange="getMessage('cropID', 'messageTitle', 'season', 'msgContent');">
             
              <option value="-1">Select a Measurement type </option>
             
			}
			?>
            </select>
             <?php
			  if (isset($errorlist)) {
                                            foreach ($errorlist as $value) {
                                                if ($value == 'measurement') {
                                                    echo "<div class ='errorColor'> <img src='../images/s_attention.png'/>  Required</div> ";
                                                }
                                            }
                                        }
				   }
			  ?>
            </td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>&nbsp;</td>
            <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>" /></td>
          </tr>
        </table>
      </form>
      </div>
      <div id="subMenu"><ul>
        <?php  echo 	"<li><a href='../Controller/RequestController.php?add&marketID=$marketID'>Add </a></li>"; ?>
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
