<?php 

//Dynaaminen sivurakenne
if(!isset($_GET["page"])) { 
	$sivu = "mainpage.php"; 
}
else { 
	$sivu = $_GET["page"].".php"; 
}

//Ohjataan virhesivulle, mikäli sivua ei löydy
if(!file_exists($sivu)) { 

	//Sisällytetään virhesivu
	include("errors/404.php");
}
else {
	//Sisällytetään sivuston rakenteen yläosa
	include('header.php');

	//Sisällytetään haluttu sivu
	include($sivu);

	//Sisällytetään sivuston rakenteen alaosa
	include('footer.php');
}
?>