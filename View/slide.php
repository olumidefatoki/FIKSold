<?ob_start(); ?>

<!DOCTYPE html>


<style type="text/css">
/* rotator in-page placement */
    div#rotator ul{
		position:static;
		list-style:none;
		height:200px;
		padding:0px;
		margin:0px;
}
/* rotator css */
	div#rotator ul li {
	float:left;
	position:absolute;
	list-style: none;
}
/* rotator image style */	
	div#rotator ul li img {
	
	padding: 4px;
	background: #FFF;
}
    div#rotator ul li.show {
	
}
</style>

<script type="text/javascript" src="../script/jquery.min.js"></script>

<!-- By Dylan Wagstaff, http://www.alohatechsupport.net -->
<script type="text/javascript">

function theRotator() {
	//Set the opacity of all images to 0
	$('div#rotator ul li').css({opacity: 0.0});
	
	//Get the first image and display it (gets set to full opacity)
	$('div#rotator ul li:first').css({opacity: 1.0});
		
	//Call the rotator function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval('rotate()',6000);
	
}

function rotate() {	
	//Get the first image
	var current = ($('div#rotator ul li.show')?  $('div#rotator ul li.show') : $('div#rotator ul li:first'));

	//Get next image, when it reaches the end, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotator ul li:first') :current.next()) : $('div#rotator ul li:first'));	
	
	//Set the fade in effect for the next image, the show class has higher z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 1000);

	//Hide the current image
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');
	
};

$(document).ready(function() {		
	//Load the slideshow
	theRotator();
});
</script>





<div id="rotator">
  <ul>       
    <li class="show"> <img src="../images/banner1.jpg" alt="Fadama Banner"></li>
	<li>  <img src="../images/banner2.jpg" alt="Fadama Banner"></li>
    <li>  <img src="../images/banner3.jpg"  alt="Fadama Banner"></li>
	<li>  <img src="../images/banner4.jpg" alt="Fadama Banner"> <li>
    <li>  <img src="../images/banner5.jpg"  alt="Fadama Banner"> </li>
	<li>  <img src="../images/banner6.jpg" alt="Fadama Banner">  </li>
    <li>  <img src="../images/banner7.jpg" alt="Fadama Banner">  </li>
    <li>  <img src="../images/banner8.jpg" alt="Fadama Banner">  </li> 
  </ul>
</div>

<?ob_end_flush();?>