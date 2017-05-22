<?php
///////////////////////////////
// LOMAKKEELTA TULLUT DATA ////
///////////////////////////////

	//$otsikko sisältää idean otsikon.
	$otsikko = strip_tags($_POST['idea_name']);

	//$ominaisuudet sisältää arrayna kaikki tallennetut ominaisuudet
	$ominaisuudet = $_POST['features'];

	//$info sisältää idealle syötetyt lisätiedot
	$info = strip_tags($_POST['details']);
	
	//Ominaisuuksien lukumäärä
	//$omin_lkm = count($ominaisuudet);

////////////////////////////////////////////
// IDEAN OTSIKON TALLENNUS TIETOKANTAAN ////
////////////////////////////////////////////

	// Tietokannan asetukset
	require_once("dbsettings.php");
	
	$error = false;
	
	try
	{
		echo $otsikko;
		echo $info;
	
		// Viedään tiedot tietokantaan
		$sql = $kanta->prepare("INSERT INTO idea (otsikko, kuvaus, id_kayttaja) VALUES (:otsikko, :kuvaus, 0)");
		$sql->bindParam("otsikko", $otsikko);
		$sql->bindParam("kuvaus", $info);
		$sql->execute();
	}
	catch (PDOException $e)
	{
		echo 'TIETOKANTAVIRHE: '. $e->getMessage();
		$error = true;
	}
	
/////////////////////////////////////////////
// OMINAISUUKSIEN TALLENNUS TIETOKANTAAN ////
/////////////////////////////////////////////
	
	// Ominaisuudet viedään transaktiona, jotta virheen sattuessa
	// muutokset voidaan rollbackata
	
	if($error == false)
	{
		// Haetaan lisätyn idean ID
		$id = $kanta->lastInsertId();
		
		try
		{
			$kanta->beginTransaction();
			
			foreach($ominaisuudet as $key => $value)
			{
				$sql = $kanta->prepare('INSERT INTO ominaisuus (id_kayttaja, id_idea, ominaisuus) VALUES (0, :id, :ominaisuus)');
				$sql->bindParam(':id', $id);
				$sql->bindParam(':ominaisuus', strip_tags($value));
				$sql->execute();
			}

			$kanta->commit();
		}
		catch (PDOException $e)
		{
			// Virheen sattuessa rollback
			echo 'TIETOKANTAVIRHE: '. $e->getMessage();
			$kanta->rollback();
		}
}
	
//Lopuksi ohjataan käyttäjä sivulle, joka ilmoittaa idean lisäämisen onnistuneen
//header('Location: ../main.php');
?>
