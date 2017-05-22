<?php 
$header = true;
//Mukautetaan head-osion title sivun mukaan automaattisesti
$title = "";
if(isset($_GET['page'])) {
	
	if ($_GET['page'] == "concept") {
		$title = "Konseptoi ideasi";
	}
	else if ($_GET['page'] == "search") {
		$title = "Hakutulokset";
	}
	else if ($_GET['page'] == "show-all") {
		$title = "Näytä kaikki ideat";
	}
	else if ($_GET['page'] == "terms") {
		$title = "Käyttöehdot";
	}
	else if ($_GET['page'] == "privacy") {
		$title = "Yksityisyydensuoja";
	}
	else if ($_GET['page'] == "privacypolicy") {
		$title = "Rekisteriseloste";
	}
	else if ($_GET['page'] == "help") {
		$title = "FAQ";
	}
	else if ($_GET['page'] == "registeration") {
		$title = "Rekisteröityminen";
	}
	else if ($_GET['page'] == "idea") {
		require_once('functions/dbsettings.php');
		
		if(isset($_GET['id'])) {
			$thisID = $_GET['id'];
			$haeTitle = $kanta->prepare("SELECT otsikko FROM idea WHERE id_idea = $thisID LIMIT 1");
			$haeTitle->execute();
			$tulos = $haeTitle->fetch();
			$title = $tulos['otsikko'];
		}
	}
	
	$title = $title." - T-Idea";
}
else {
$title = "T-Idea &raquo; Social innovation - put into practice";
}?><!DOCTYPE html>
<head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="keywords" content="T-Idea, Karelia, Karelia-AMK, tiko, idea, portaali">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/jquery.autosize.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('textarea').autosize();   
	});
	</script>
</head>
<body>
<div id="main">
<!-- Yläpalkki -->
	<div id="header">
		<div class="inner">
			<div class="logo">
				<a href="main.php">
					<img src="layout/logo_small.png" alt="Logo">
				</a>
			</div>
			<div class="searchbox">
				<form id="searchForm" action="main.php" method="get">
					<input type="hidden" name="page" value="search">
					<input type="text" class="input-search" name="result"><input type="submit" class="submit-search" value="">
				</form>
				<script type="text/javascript">
					$('#searchForm').submit(function(e){
							if($('.input-search').val() == '') {e.preventDefault(e);}
					});
				</script>
			</div>
		</div>
	</div>
	
	<!-- Containerin sisällä navigaatio, sekä sisältö -->
	<div id="container">
	
		<!-- Vasemman laidan navigaatio -->
		
		<div id="navigation">
			<div class="inner">
				<div class="head">
					Navigaatio
				</div>
				<div class="content">
					<ul>
						<li class="li-tidea"><a href="main.php">T-Idea</a></li>
						<li class="li-addnew"><a href="main.php?page=concept">Lisää uusi idea</a></li>
						<li class="li-listall"><a href="main.php?page=show-all">Näytä kaikki ideat</a></li>
					</ul>
				</div>	
			</div>
			<!--
			<div class="inner">
				<div class="head">
					Asetukset
				</div>
				<div class="content">
					<ul>
						<li class="li-myideas"><a href="main.php?page=my-ideas">Omat ideasi</a></li>
						<li class="li-mydetails"><a href="main.php?page=my-details">Omat tiedot</a></li>
						<li class="li-logout"><a href="">Kirjaudu ulos</a></li>
					</ul>
				</div>
			</div>
			-->
			<div class="inner">
				<div class="head">
					Kirjaudu sisään
				</div>
				<div class="content">
					<div class="login">
						<form id="loginForm" action="functions/login.php" method="post">
						<input type="text" name="kayttajanimi" class="log-account">
						<input type="password" name="salasana" class="log-passwd">
						<div class="checkBox">
							<input id="checkboxRemember" type="checkbox" name="remember">
							<label for="checkboxRemember"></label>
						</div>
						<div class="checkboxText">
						Muista minut
						</div>
						<input type="submit" value="Kirjaudu" class="log-submit">
						<div class="error"></div>
						<span class="register-text">
						Ei vielä tunnusta? <a href="main.php?page=registeration">Rekisteröidy tästä</a>
						</span>
						</form>
						<script type="text/javascript">
						
						$('#loginForm').submit(function(e){
	
							$(".error").empty();
							var loginError = false;

							/*käyttäjätunnuksen tarkastus*/
							var loginAccount = $( ".log-account" ).val();
							if( loginAccount.length < 5 || loginAccount.length > 30) {
								loginError = true;
							}
							/*salasanan tarkastus*/
							var loginPasswd = $( ".log-passwd" ).val();
							if( loginPasswd.length < 5 || loginPasswd.length > 30) {
								loginError = true;
							}
							
							/*Virheen sattuessa näytetään virheilmoitus*/
							if (loginError) {
								$(".error").css("display", "inline").hide().fadeIn(200);
								$(".error").append("Virheellinen käyttäjätunnus tai salasana!");
								e.preventDefault(e);
							}
						   
						});
							
					</script>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Sivun sisältö -->
		
		<div id="content">