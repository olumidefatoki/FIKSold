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
$result= entity::fetchRecord($entityName,$recID);
$row=mysql_num_rows($result);
$recID=  mysql_result($result, 0, 0);
$fetilizername=  mysql_result($result, 0, 1);
$description=  mysql_result($result, 0, 2);

$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
}

else if(isset($_GET['action']) && isset($_SESSION['username']))
{
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

<link href="../css/main.css" rel="stylesheet" type="text/css" />

  <script type="text/javascript" src="../script/jquery.min.js"></script>
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
                    $("#wardloading").css("display","inline-block");
                    var dataString ='lgaid='+id;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/RequestController.php",
                        data: dataString,
                        cache: false,
                        success: function(html){	
                            $("#ward").html(html);
                            $("#wardloading").css("display","none");} 
                    });   
                });

             
            })</script>

</head>

<body>
<div id="wrapper">
	<div id="loginDetail"> Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a> </div>
  <div id="header"><?php include 'sliding.php'; ?></div>
  <div id="Navigation"><?php include 'navigation.php'; ?></div>
  <div id="post">
      <div id="view">
       <div id="addRecord">
        <?php  if($action=='add'){
		echo 'Add New '.$menuName;
		}
		 else if($action=='update'){
			  echo 'Update  '.$menuName.'  '.$fetilizername;
			  } ?>
        </div>
      <div style="color:#FFF;">
      Please fill all fields
      </div>
      <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="5" cellspacing="1" class="recordTable">
        
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="139"> Name</td>
            <td width="257"><label for="name"></label>
            <input name="name" type="text" id="name"  value="<?php if($action=='update'){echo $fetilizername;} ?>" size="38"/>
            <input type="hidden" name="id" id="id" value="<?php if($action=='update'){echo $recID;} ?>" /></td>
          </tr>
          
          <tr id="entityRowEven">
            <td>Market Address</td>
            <td><textarea name="address" cols="30" rows="3" id="address" $description="$description"><?php if($action=='update'){echo $description;} ?>
            </textarea></td>
          </tr>
         <tr id="entityRowOdd">
            <td>State </td>
            <td><select name="state" id="state" onchange ="composeEntities('state','lga','stateId','lgaloading');" style="width:250px;">
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
          <tr id="entityRowEven">
            <td>LGA </td>
            <td><select name="lga" id="lga"   style="width:250px;">
              <option >Select LGA</option>
            </select>              <div id="lgaloading"> <img src="../images/ajax-loader2.gif" alt=""/> Loading </div>
            </td>
          </tr>
          <tr id="entityRowOdd">
            <td>Ward </td>
            <td><select name="ward" id="ward" style="width:250px;">
              <option >Select Ward</option>
            </select> <div id="wardloading"> <img src="../images/ajax-loader1.gif" alt=""/> Loading </div>
            </td>
          </tr>
          <tr id="entityRowEven">
            <td>Market Day </td>
            <td><label for="marketDay"></label>
              <input name="marketDay" type="text" id="marketDay" size="38"/></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td>&nbsp;</td>
            <td align="right"><input type="submit" name="<?php echo $action; ?>" id="<?php echo $action; ?>" value="<?php echo $action; ?>" /></td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu">
      <ul>
        <?php include'sideMenu.php'; ?>
        </ul>
      </div>
  </div>
   <div id="footer">
   <?php include'footer.php';?>
  </div>

  </div>
</div>
</body>
</html>
