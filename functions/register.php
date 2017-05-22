<?php

$username = htmlspecialchars($_GET['username']);
$passwd = htmlspecialchars($_GET['passwd']);
$email = htmlspecialchars($_GET['email']);
$agree = htmlspecialchars($_GET['agree']);

$error = false;

// Virhekoodit lisätään $virhekoodit-taulukkoon
unset($virhekoodit);
$virhekoodit = array();

//////////////////////////
// SYÖTTEIDEN TARKISTUS //
//////////////////////////

// Käyttäjänimi
if (strlen($username) < 5 || strlen($username) > 30 )
{
	// Virhekoodi 1
	array_push($virhekoodit, 1);
	$error = true;
}

// Salasana
if (strlen($passwd) < 5 || strlen($passwd) > 30 )
{
	// Virhekoodi 2
	array_push($virhekoodit, 2);
	$error = true;
}

// Sähköpostiosoite
if (strpos($email,"@") == false)
{
	// Virhekoodi 3
	array_push($virhekoodit, 3);
	$error = true;
}

// Käyttäjäehtojen hyväksyminen
if ($agree != "on")
{
	// Virhekoodi 4
	array_push($virhekoodit, 4);
	$error = true;
}

///////////////////////////////////
// KÄYTTÄJÄN LISÄYS TIETOKANTAAN //
///////////////////////////////////

if($error == false)
{
	// Tietokannan asetukset
	require_once("dbsettings.php");

	// Tarkistetaan onko sama käyttäjänimi jo olemassa
	try
	{
		$sql = $kanta->prepare("SELECT kayttajatunnus FROM kayttaja WHERE kayttajatunnus = :username");
		$sql->bindParam(':username', $username);
		$sql->execute();
	}
	catch (PDOException $e)
	{
		echo 'TIETOKANTAVIRHE: '. $e->getMessage();
		// Virhekoodi 999
		array_push($virhekoodit, 999);
	}

	if($sql->rowCount() > 0)
	{
		// Virhekoodi 5
		array_push($virhekoodit, 5);
	}
	else
	{
		try
		{
			// Lisätään käyttäjä tietokantaan
			$sql = $kanta->prepare("INSERT INTO kayttaja (kayttajatunnus, salasana, email) VALUES (?, ?, ?)");
			$sql->bindParam(1, $username);
			$sql->bindParam(2, md5($passwd));
			$sql->bindParam(3, $email);
			$sql->execute();
		}
		catch (PDOException $e)
		{
			echo 'TIETOKANTAVIRHE: '. $e->getMessage();
			// Virhekoodi 999
			array_push($virhekoodit, 999);
		}
	} 
}

///////////////////////////
// VIRHEKOODIEN TOIMITUS //
///////////////////////////

// Jos syötteissä virheitä palataan rekisteröinti-sivulle virhekoodien kera
if($error == true)
{
	$virhekoodit = serialize($virhekoodit);
	header('Location: ../main.php?page=registeration&errors='.$virhekoodit.'');
}
else
{
	header('Location: ../main.php');
}
?>
