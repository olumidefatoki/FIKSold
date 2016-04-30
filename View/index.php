<?php
include('../Controller/entity.php');
include('../Controller/ManageSessions.php');
//unset($_SESSION['tableName']);

if(isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$menuList=entity::fetchMenu();
$menuRow=mysql_num_rows($menuList);
}
else{
	header("Location:../index.php");	
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
  <div id="Navigation"><?php include 'navigation.php'; ?>
  </div>
  <div id="content">
    <div style="padding:15px;text-align:justify;text-justify:inter-word; color:#044407">
      <div>
      <h2>FADAMA INFORMATION KNOWLEDGE SYSTEM</h2></div>
        <div style="color:#000; font-size:16px;">
          <p> The Third National Fadama  Development Project (NFDP III) is a follow up of NFDP II. The basic strategic  approach is community Driven Development (CDD) which has proven to be one of  the most viable approaches to rural transformation in Nigeria and Africa in  general. The project Development Objective (PDO) of Fadama III is to increase  the income of rural people, land and water resources on sustainable basis,  thereby reducing rural poverty, increase food security and contributing to the  achievement of Millennium Development Goal (MDG).</p>
          <p>All over the world ICT Tools are  been applied to Agricultural activities to improve the impact of the  Agricultural Development activities and agriculture Value chains. For this  reason, the FADAMA III Information, Knowledge Service (FIKS) is being developed  as a subproject under the Third National Fadama Development Project (Fadama III).</p>
          <p>The FIKS project is funded by the  Japanese Social Development Fund (JSDF), with the objective to establish a sustainable  Fadama Information Knowledge/Business Services and to increase Farm  Productivity and rural household income in the poorest sections of fadama Community.  It’s a pilot implementation in four selected  states namely, Lagos, Cross River, Sokoto, and yobe State.  The time line is spread over a period of four  years (June 2011- 2015) in order to promote methods for generating improved  Agricultural production Information in these communities.</p>

        </div>
      
  </div>
  
  </div>
  <div id="footer">
   <?php include'footer.php';?>
  </div>
</div>
</body>
</html>
