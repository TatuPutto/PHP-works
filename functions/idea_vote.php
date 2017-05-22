<?php

require_once('dbsettings.php');

	//LISÄTÄÄN ÄÄNI IDEALLE
	if(isset($_GET['vote']) && $_GET['vote'] == "plus") {
	
		$thisID = $_GET['id'];
		
		//Varmistetaan, että id löytyy kannasta
		$hae = $kanta->prepare("SELECT * FROM idea WHERE id_idea = $thisID LIMIT 1");
		$hae->execute();
		
		$tarkista = $hae->fetchColumn();
		
		if($tarkista) {
		
			// Päivitetään kantaan annettu ääni
			$lisaaAani = $kanta->prepare("UPDATE idea SET plus = plus + 1 WHERE id_idea = $thisID");
			$lisaaAani->execute();
			
			//Ohjataan takaisin oikeaan listaukseen
			if ($_GET['sort'] == "new") {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=new');
			} else if ($_GET['sort'] == "popular") {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=popular');
			}
		} else {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all');
		}
		
	}
	//VÄHENNETÄÄN ÄÄNI IDEALTA
	else if(isset($_GET['vote']) && $_GET['vote'] == "minus") {
	
		$thisID = $_GET['id'];
		
		//Varmistetaan, että id löytyy kannasta
		$hae = $kanta->prepare("SELECT * FROM idea WHERE id_idea = $thisID LIMIT 1");
		$hae->execute();
		
		$tarkista = $hae->fetchColumn();
		
		if($tarkista) {
		
			// Päivitetään kantaan annettu ääni
			$lisaaAani = $kanta->prepare("UPDATE idea SET plus = plus - 1 WHERE id_idea = $thisID");
			$lisaaAani->execute();
			
			//Ohjataan takaisin oikeaan listaukseen
			if ($_GET['sort'] == "new") {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=new');
			} else if ($_GET['sort'] == "popular") {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=popular');
			}
		} else {
			header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all');
		}
		
	}

?>