<?php
$kayttajanimi = $_POST["kayttajanimi"];
$salasana = md5($_POST["salasana"]);

//echo $kayttajanimi;
echo $salasana;
echo "</br>";
if($kayttajanimi && $salasana) {
	// Tietokannan asetukset
	require_once("dbsettings.php");

	// Tarkistetaan onko sama käyttäjänimi jo olemassa
	try
	{
			
	
		//$sql = $kanta->prepare("SELECT * FROM kayttaja WHERE kayttajanimi = :kayttajanimi AND salasana = :salasana");
		$sql = $kanta->prepare("SELECT * FROM kayttaja WHERE salasana = :salasana");
		//$sql->bindParam(':kayttajanimi', $kayttajanimi);
		$sql->bindParam(':salasana', $salasana);
		$sql->execute();
		$kayttajanimi = "TatuPutto";
		$salasana = "dd20aef87220dd7dc788b0a1acea9fa4";
		echo $sql->rowCount() . "</br>";
	}
	catch (PDOException $e)
	{
		echo 'TIETOKANTAVIRHE: '. $e->getMessage();
	}

	if($sql->rowCount() > 0)
	{	
		echo "osu ja upposi";
		// Onnistunut kirjautuminen
		//header('Location: ../main.php');
	} else {
		echo "Virheellinen kayttajatunnus tai salasana.";
	}
} else {
	echo "Syötä käyttäjätunnus ja salasana.";
}
?>
