<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 

else if (!isset($_GET['id'])) {
header('Location: '.$_SERVER['PHP_SELF'].'');
}
else {
require_once('functions/dbsettings.php');

	$thisID = $_GET['id'];
		
	//Varmistetaan, että id löytyy kannasta
	$hae = $kanta->prepare("SELECT * FROM idea WHERE id_idea = $thisID LIMIT 1");
	$hae->execute();
		
	$idea = $hae->fetch();
		
	//Jos id löytyi tietokannasta
	if($idea) {
?>
	<?php
	// Hae ominaisuudet kyseiselle idealle
	$ideaOminaisuudet = $kanta->prepare("SELECT * FROM ominaisuus WHERE id_idea = $thisID");
	$ideaOminaisuudet->execute();
	
	// Hae lisätiedot kyseiselle idealle
	$ideaLisatiedot = $kanta->prepare("SELECT kuvaus FROM idea WHERE id_idea = $thisID");
	$ideaLisatiedot->execute();
	$lisatiedot = $ideaLisatiedot->fetch();

	// Tagien haku
	//$ideaTagit = $kanta->prepare("SELECT * FROM ???? WHERE id_idea = $thisID");
	//$ideaTagit->execute();

	// Jäsenten haku
	//$ideaJasenet = $kanta->prepare("SELECT * FROM ????? WHERE ?? = ??");
	//$ideaJasenet->execute();

	// Hae idean omistajan tiedot
	$omistaja_id = $idea['id_kayttaja'];
	$omistaja_rivit = $kanta->prepare("SELECT etunimi,sukunimi FROM kayttaja WHERE id_kayttaja = $omistaja_id LIMIT 1");
	$omistaja_rivit->execute();
	$omistaja = $omistaja_rivit->fetch();

	// Ja yhdistä string muuttujat
	$omistaja_nimi = $omistaja['etunimi'] . " " . $omistaja['sukunimi'];
	if ($omistaja_nimi == " ") {
	$omistaja_nimi = "Anonyymi";
	}
	

	// Muokkaa timestamp luettavampaan muotoon
	$timestamp = date('d.m.Y', strtotime($idea['aikaleima']));
	
	?>
		<div class="inside">
		  <div id="ideapage">
		  <h1><?php echo $idea['otsikko'];?></h1>
			<div class="left-column">
				<h3>Ominaisuudet</h3>
				<?php
				// Tulosta jokainen yksittäinen ominaisuus
				while ($ominaisuus = $ideaOminaisuudet->fetch()) {
				?>
					<div class="feature">
						<div class="name">
							<?php echo $ominaisuus['ominaisuus']; ?>
						</div>
						<div class="dislike">
							<img class="rotate" src="layout/icon_dislike.png" alt="En tykkää">
						</div>
						<div class="like">
							<img class="rotate" src="layout/icon_like.png" alt="Tykkää">
						</div>
					</div>
				<?php
				} // while-loopin loppusulku
				?>
				<div class="additional">
				<h3>Lisätiedot</h3>
					<div class="additionalcontent">
					<?php
					if ($lisatiedot['kuvaus'] == "") {
					echo "Ei lisätietoja.";
					}
					else {
					echo $lisatiedot['kuvaus'];
					}
					?>
					</div>
				</div>
			</div>
			<div class="right-column">
				<div class="tags">
					<h3>Tagit</h3>
					<?php
						/*
						while ($tag = $ideaTagit->fetch()) {
							<div class="tag">
								$tag['nimi']
							</div>
						}
						*/
					?>
					<div class="tag">Web</div>
					<div class="tag">PHP</div>
					<div class="tag">Java</div>
					<div class="tag">Facebook</div>
					<div class="tag">T-idea</div>
					<div class="tag">Application</div>
					<div class="tag">Mobile</div>
					<div class="tag">Touch UI</div>
					<div class="tag">Nämä</div>
					<div class="tag">tagit</div>
					<div class="tag">ovat</div>
					<div class="tag">vain</div>
					<div class="tag">esimerkkejä</div>
				</div>
				<div class="members">
					<h3>Jäsenet</h3>
					<div class="memberlist">
					Ei vielä yhtään jäsentä.
					</div>
					<a class="join" href="">Liity</a>
				</div>
			</div>
			<div class="details">
				<div class="pic">
					<img src="layout/profile_pic.png" alt="Profiilikuva">
				</div>
				<div class="name"> <?php echo $omistaja_nimi ?> </div>
				<div class="timestamp">Lisätty: <?php echo " " . $timestamp ?> </div>
			</div>
		  </div>
		</div>
<?php
	} 
	else {
		header('Location: '.$_SERVER['PHP_SELF'].'');
	}
}
?>