<?php

include('../Controller/entity.php');
if(isset($_GET['action']) && isset($_GET['id'])&& isset($_SESSION['username']))
{
	
$username=$_SESSION['username'];
$action=trim($_GET['action']);
$recID=$_GET['id'];
$menuName=$_SESSION['menuName'];
$entityName=$_SESSION['menuTableName'];
$result= entity::fetchRecord($entityName,$recID);

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
<script type="text/javascript" src="../script/jquery.js"></script>
<script type="text/javascript" src="../script/jquery-calendar.js"></script>
<script type="text/javascript" src="../script/customscripts.js"></script>
<link rel="stylesheet" type="text/css" href="../script/jquery-calendar.css">
<script type="text/javascript">
$(document).ready(function(){
	   $("#calendar1, #calendar2").calendar();
           $("#calendar1_alert").click(function(){alert(popUpCal.parseDate($('#calendar1').val()))
		   });      
       
        });
</script>
</head>

<body>
<div id="wrapper">
  <div id="header"><img src="../images/banner.jpg" width="1000" height="200" /></div>
<div id="loginDetail">Welcome  <?php echo strtoupper($username); ?> | <a href="../index.php">logout</a>&nbsp;&nbsp;&nbsp;</div>
<div id="content">
  <div id="navigation">
    <ul>
    <?php
    
    for($i=0;$i<$menuRow;$i++)
    {
        $id=  mysql_result($menuList, $i, 0);
        $tableName=  mysql_result($menuList, $i, 1);
        $name=mysql_result($menuList, $i, 2);
        
    
    ?>
    
    
      <a href="<?php echo"../Controller/RequestController.php?menuTableName=$tableName&menuName=$name" ;?>"> <li> 
	  <img src="../images/list_bullet.gif" /><img src="../images/list_bullet.gif" />
	  <?php   echo $name;  ?></li></a>
    
    <?php
    }
    ?>
    </ul>
  </div>
    <div id="post">
      <div id="view">
       <div id="addRecord">
        <?php  if($action=='add'){
		echo 'Schedule New '.$menuName;
		}
		 else if($action=='update'){
			  echo 'Update  '.$menuName.'  '.$firstName." ".$lastName;
			  } ?>
        </div>
       <div id ="FormHeader"> Please fill all fields </div>
       <form id="form1" name="form1" method="post" action="../Controller/RequestController.php">
<table width="100%" cellpadding="3" cellspacing="1" class="recordTable">
         <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="242">State </td>
            <td width="405"><label for="fName"></label>
              <select name="state" id="state" onchange ="composeEntities('state','lga','stateId');" style="width:300px;">
                <option >---------------------------Select a State---------------------------</option>
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
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="242">Lga</td>
            <td width="405"><label for="fName"></label>
              <select name="lga" id="lga" disabled="disabled" onchange ="composeEntities('lga','fca','farmerlgaid');"  style="width:300px;">
                <option >----------------------------All Lga----------------------------</option>
              </select></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="242">Farmer Community Association (FCA)</td>
            <td width="405"><label for="fName"></label>
              <select name="fca" id="fca" disabled="disabled" onchange="composeEntities('fca','fug','fcaId');" style="width:300px;">
                <option >----------------------------All FCA----------------------------</option>
              </select></td>
          </tr>
          <tr bgcolor="#96CA1D" id="entityRowOdd">
            <td width="242">Farmer User Group (FUG)</td>
            <td width="405"><label for="fName"></label>
              <select name="fug" id="fug" disabled="disabled" style="width:300px;">
                <option >----------------------------All FUG----------------------------</option>
              </select></td>
          </tr>
          <tr id="entityRowEven">
            <td>Season </td>
            <td><select name="season" id="season" onchange="composeEntities('season','messageTitle','seasonType');" style="width:300px;" >
             <option >---------------------------Select a season---------------------------</option>
             <option value="pre_season">Pre Season</option>
             <option value="post_season">Post Season</option>
             <option value="in_season">In Season</option>
              
            </select>
            
            </td>
          </tr>
          <tr id="entityRowOdd">
            <td>Message Title</td>
            <td><select name="messageTitle" id="messageTitle" style="width:300px;" disabled="disabled">
             <option selected="selected">--Select a title--</option>
            </select>     <div id="msgTitle" style="display:none;" ><img src="../images/ajax-loader1.gif"/>&nbsp; &nbsp;Loading </div></td>
          </tr>
          <tr id="entityRowOdd">
            <td>Crop </td>
            <td><select name="cropID" id="cropID" style="width:300px;" onchange="getMessage('cropID', 'messageTitle', 'season', 'msgContent');">
            <option selected="selected">--Select a Crop --</option>
              <?php  
			$cropList=entity::fetchEntityList('crops');
			$cropNum=mysql_num_rows($cropList);
			for ($index = 0; $index < $cropNum; $index++) {
                $fertid=  mysql_result($cropList, $index, 'ID');
        		$fertName=  mysql_result($cropList, $index, 1);
            
			?>
              <option value="<?php echo $fertid; ?>"> <?php echo $fertName; ?></option>
              <?php  
			}
			?>
            </select></td>
          </tr>
          
          
          <tr id="entityRowOdd">
            <td>Message Content</td>
            <td><label for="msgContent"></label>
              <textarea name="msgContent" id="msgContent" cols="35" rows="5" disabled="disabled"></textarea>
              <input type="hidden" name="msg" id="msg" /></td>
          </tr>
          <tr id="entityRowOdd">
            <td height="28">Delivary Date</td>
            <td><p>
              <input name="deliveryDate" type="text" class="calendarFocus" id="calendar1" size="40">
            </p></td>
          </tr>
          <tr bgcolor="#96CA1D" id="">
            <td colspan="2" align="right"><input name="Broadcast" type="submit" id="Broadcast"  style="width:80px; text-align:center;" value="Broadcast"  /> &nbsp;&nbsp;&nbsp;</td>
          </tr>
        </table>

</form>
      </div>
      <div id="subMenu" >
        <div id="subMenu2">
          <ul>
            <li> <a href="<?php echo"../Controller/RequestController.php?add" ;?> ">Add</a> </li>
          </ul>
          </table>
        </div>
      </div>
      <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  
  </div>
  
  <?php
  mysql_close();
  ?>
  <div id="footer">
    <p>Copyright &copy; 2012 cellulant life is mobile</p>
  </div>
</div>
</body>
</html>
