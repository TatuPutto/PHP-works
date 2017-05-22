<?php

// Funktio etsii hakuehtoa vastaavan idean ja palauttaa sen taulukkona.
// Ottaa parametrina hakusanan: Oletuksena etsii vain idean nimestä.
// 
// Ottaa parametrina myös numeroarvon 1-3:
// 1 = haku vain idean ID:llä
// 2 = haku vain idean kuvauksesta
// 3 = haku kaikista

function search($hakuword, $param) {

	$statement = "none";
	
	// Tietokanta-asetukset
	require_once("dbsettings.php");

	// Muodostetaan hakulause parametristä riippuen
	switch($param)
	{
	case "1":
		
		// HAKU 1: HAKU IDEAN ID:LLÄ
		$statement = 'SELECT * FROM idea WHERE id_idea LIKE :haku';
		break;

	case "2":
		// HAKU 3: HAKU IDEAN KUVAUKSESTA
		$statement = 'SELECT * FROM idea WHERE kuvaus LIKE :haku';
		break;
		
	case "3":
		// HAKU 4: HAKU KAIKISTA
		$statement = 'SELECT * FROM idea WHERE kuvaus LIKE :haku OR otsikko LIKE :haku OR id_idea LIKE :haku';
		break;
		
	default:
		// OLETUS: HAKU VAIN IDEAN OTSIKOSTA
		$statement = 'SELECT * FROM idea WHERE otsikko LIKE :haku';
		break;
	}
	
	// Suoritetaan kysely
	try
	{
		// Lisätään hakusanaan SQL wildcardit
		$hakuword = '%' . $hakuword. '%'; 
		
		$sql = $kanta->prepare($statement);
		$sql->bindParam(':haku', $hakuword);
		$sql->execute();
		$vastaus = $sql->fetchAll();
		return $vastaus;
	}
	catch (PDOException $e)
	{
		echo 'TIETOKANTAVIRHE: '. $e->getMessage();
	}
}
?>
