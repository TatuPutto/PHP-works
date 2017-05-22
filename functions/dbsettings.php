<?php
	# Tietokanta-asetukset
	$tunnus = "root";
	$salasana = "";
	
	try {
		$kanta = new PDO("mysql:host=localhost:3306;dbname=tidea", $tunnus, $salasana);
		$kanta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$kanta->exec("SET NAMES utf8");
	} catch (PDOException $e) {
		echo 'TIETOKANTAVIRHE: '. $e->getMessage();
	}
	
?>
