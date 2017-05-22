<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 

//Tietokantayhteys
require_once('functions/dbsettings.php');

//Haetaan kannasta viiden suosituimman idean tiedot
$suosituimmat = $kanta->prepare("SELECT * FROM idea ORDER BY plus DESC LIMIT 0, 5");
$suosituimmat->execute();

//Haetaan kannasta viiden uusimman idean tiedot
$uudet = $kanta->prepare("SELECT * FROM idea ORDER BY id_idea DESC LIMIT 0, 5");
$uudet->execute();
?>
		<div class="inside">
		<p class="headText">Tuo ideasi esille <i><b>vaivattomasti</b></i>
		<p>Idean esille tuominen on todella nopeaa ja vaivatonta. Kirjoita ideasi ja siihen liittyvä kuvaus etusivun tekstikenttään, olet nyt lisännyt ideasi T-idea palveluun! Kirjautumista eikä idean kehittämiseen osallistumista vaadita, vaikka idea etenisikin ideasta toteutukseksi.		
		<hr>
		<p class="headText">Ideasta toteutukseen
		<p>Ideat listataan eniten positiivisia ääniä saaneesta vähiten positiivisia ääniä saaneeseen. Ideasi aloittaa matkansa kohti toteutusta listan häntäpäästä, mutta positiivisten äänten lisääntyessä ideasi nousee listalla. Tätä kautta ideasi saa enemmän ominaisuus ehdotuksia, sekä mahdollisesti idean toteuttamisesta kiinnostuneita henkilöitä.
		<p>Käyttäjät voivat ehdottaa ideaasi lisättäviä ominaisuuksia. Ehdotetut ominaisuudet listataan samalla tavalla kuin ideatkin, listan kärjestä löydät siis käyttäjien mielestä ideaasi parhaiten edistävät ominaisuudet. 
		<hr>
			<div id="popularIdeas" class="box330px">
				<div class="box-head">
				Suosituimmat ideat
				</div>
				<div class="box-content">
				<?php
				while ($idea = $suosituimmat->fetch()) {
				?>
					<div class="element">
						<?php 
						echo"<a class=\"name\" href=\"".$_SERVER['PHP_SELF']."?page=idea&id=".$idea['id_idea']."\">"; 
						?>
						<?php echo $idea['otsikko'];?>
						</a>
						<div class="votes">
						<?php 
						if ($idea['plus'] > 0) {
						echo "+";
						}
						echo $idea['plus'];
						?>
						</div>
					</div>
				<?php
				}
				?>
					<a class="element-bottom" href="<?php echo $_SERVER['PHP_SELF'];?>?page=show-all&amp;sort=popular">Näytä lisää...</a>
				</div>
			</div>
			<div id="newIdeas" class="box330px">
				<div class="box-head">
				Uusimmat ideat
				</div>
				<div class="box-content">
				<?php
				while ($idea = $uudet->fetch()) {
				?>
					<div class="element">
						<?php 
						echo"<a class=\"name\" href=\"".$_SERVER['PHP_SELF']."?page=idea&id=".$idea['id_idea']."\">"; 
						?>
						<?php echo $idea['otsikko'];?>
						</a>
						<div class="timestamp">
						<?php 
						$aikaleima = strtotime($idea['aikaleima']);
						$aikaleima = date('d.m.Y', $aikaleima);
						echo $aikaleima;
						?>
						</div>
					</div>
				<?php
				}
				?>
					<a class="element-bottom" href="<?php echo $_SERVER['PHP_SELF'];?>?page=show-all&amp;sort=new">Näytä lisää...</a>
				</div>
			</div>
		</div>