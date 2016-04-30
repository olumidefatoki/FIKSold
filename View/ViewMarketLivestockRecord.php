<?php

include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//session_start();
 if(isset($_GET['ViewRecord'])&& isset($_SESSION['username']))
{

$username=$_SESSION['username'];

$recID=$_GET['ViewRecord'];
$menuName=$_SESSION['menuName'];
$entityName=$_SESSION['menuTableName'];
$result= entity::fetchMarketLivestockRec($recID);
$row=mysql_num_rows($result);
                $ID = mysql_result($result, 0, 0);
                $cropName = mysql_result($result, 0, 1);
                $qty = mysql_result($result, 0, 2);
                $price = mysql_result($result, 0, 3);
                $measurement = mysql_result($result, 0, 4);
                $marketName=mysql_result($result, 0, 5);
                $marketID=mysql_result($result, 0, 6);
}


else{
	//header('location:../index.php');
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
                   
                    var dataString ='cropMeasurement='+id;
					
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
        Market Crop Details  
        </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
        <table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
          <tr bgcolor="#96CA1D">
            <td>Market Name</td>
            <td><?php
			  echo $marketName;
			  ?></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="139"> Crop</td>
            <td width="257"><label for="name"></label>
              <?php
			  echo strtoupper($cropName);
			  ?>
              </td>
          </tr>
          <tr id="entityRowEven">
            <td>Unit Price </td>
            <td><?php
			  echo $price;
			  ?></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Measurement</td>
            <td><?php
			 echo $measurement;
			  ?>
            </td>
          </tr>
          <tr id="entityRowEven">
            <td>&nbsp;</td>
            <td align="right">&nbsp;</td>
          </tr>
        </table>
      </form>
      </div>
      <div id="subMenu"><ul>
        <?php  echo 	"<li><a href='../Controller/RequestController.php?add&marketID=$marketID'>Add </a></li>"; ?>
        <?php //  echo 	"<li><a href='../Controller/RequestController.php?update&redID=$ID'>Update</a> </li>"; ?>
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
