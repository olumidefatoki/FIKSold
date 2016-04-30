<?php
$roles=$_SESSION['Roles'];
$rolesList=explode(",", $roles);
 
?>
<nav>
	<ul><li><a href="index.php">Home</a></li>	
		<li><a href="#">Crop</a>
			<ul>
				<li><a href="<?php echo"../Controller/RequestController.php?menuTableName=crops&menuName=Crops" ;?>">CROPS</a></li>
			    <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=diseases&menuName=Diseases" ;?>">DIEASEASE</a></li>
			    <li ><a href="<?php echo"../Controller/RequestController.php?menuTableName=herbicides&menuName=Herbicides" ;?>">HERBICIDES</a></li>
			    <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=fertilizers&menuName=Fertilizer" ;?>">FETILIZER</a></li>
			    <!--<li><a href="<?php /*echo"../Controller/RequestController.php?menuTableName=pesticides&menuName=Pesticides"*/ ;?>">PESTICIDES</a></li>-->
			    <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=pests&menuName=Pest" ;?>">PEST</a></li>
			</ul>
		</li>
		<li><a href="#">Farmers Info</a>
			<ul>
             <?php            foreach ($rolesList as $value) {
                if ($value==4) {
                    
                
            ?>
				<li><a href="<?php echo"../Controller/RequestController.php?menuTableName=farmers&menuName=Farmer" ;?>">FARMER</a></li>
                 <?php  }}   ?> 
			    <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=fca&menuName=FCA" ;?>">FCA</a></li>
			    <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=fug&menuName=FUG" ;?>">FUG</a></li>
			</ul>
		</li>
        <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=markets&menuName=Market" ;?>">Market</a></li>
	    <li><a href=" <?php echo"../Controller/RequestController.php?menuTableName=lifecycle&menuName=Crop lifecycle" ;?>"> Crop LifeCycle</a></li>
    <?php            foreach ($rolesList as $value) {
                if ($value==3) {
                    
                
            ?>
            
        <li><a href="<?php echo"../Controller/RequestController.php?menuTableName=broadcast&menuName=Broadcast" ;?>">Broadcast</a></li>
     <?php  }}   ?> 
		<li><a href="#">Animal Husbandry</a>
             <ul>
				   <li ><a href="<?php echo"../Controller/RequestController.php?menuTableName=animalhusbandry&menuName=Livestock";?>">LIVESTOCK	</a></li>
                  <li ><a href="<?php echo"../Controller/RequestController.php?menuTableName=animalhusbandry&menuName=Aquaculture";?>">AQUACULTURE</a></li>
			</ul>        
        </li>
        <li><a href="#">User </a>
             <ul>
                 <?php            foreach ($rolesList as $value) {
                if ($value==4) { 
            ?>
		<li><a href="<?php echo"../Controller/RequestController.php?menuTableName=users&menuName=Users" ;?>">VIEW USERS</a></li>
                 <?php  }}   ?> 
                <li><a href="ChangePassword.php">CHANGE PASSWORD</a></li>
                 <?php            foreach ($rolesList as $value) {
                if ($value==1) {        
            ?>
                <li><a href="ManageUsers.php"> CREATE USER</a> </li>
                <?php  }}   ?> 
			</ul>        
        </li>
	</ul>
</nav>