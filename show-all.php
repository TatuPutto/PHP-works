<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 
?>
		<div class="inside">
			<div id="idea_listing">
				<div class="topbar">
					<?php 
					//Lisätään oikealle linkille oikea class.
					if(isset($_GET['sort']) && $_GET['sort'] == "new"){$classnew = "selected";$classpopular = "";}
					else if(isset($_GET['sort']) && $_GET['sort'] == "popular"){$classnew = "";$classpopular = "selected";}
					else {$classnew = "selected";}
					?>
					<a class="<?php echo$classnew;?>" href="<?php echo $_SERVER['PHP_SELF'];?>?page=show-all&amp;sort=new">Uusimmat</a> &#124; <a class="<?php echo$classpopular;?>" href="<?php echo $_SERVER['PHP_SELF'];?>?page=show-all&amp;sort=popular">Suosituimmat</a>
				</div>

<?php

//Yhteys tietokantaan
require_once('functions/dbsettings.php');

//Haetaan kannasta ideoiden määrä idea-taulusta.
$idealkm = $kanta->prepare("SELECT count(*) FROM idea");
$idealkm->execute();

//Rivien eli ideoiden määrä idea-taulussa.
$numrows = $idealkm->fetchColumn();

/////////////////////////////////////////////
//Jatketaan, jos tietokanta sisältää dataa.//
/////////////////////////////////////////////
if($numrows > 0) {

	// montako riviä näytetään per sivu.
	$rowsperpage = 10;
	// selvitetään sivujen määrä
	$totalpages = ceil($numrows / $rowsperpage); //pyöristys ceil-funktion avulla.

	// hae tämän hetkinen sivu tai aseta oletus
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
	   $currentpage = (int) $_GET['currentpage'];
	} else {
	   // oletuksena sivunumero 1
	   $currentpage = 1;
	}

	// Jos käyttäjä syöttää käsin suuremman sivunumeron, kuin mahdollista
	if ($currentpage > $totalpages) {
	   // näytetään viimeinen sivu
	   $currentpage = $totalpages;
	}
	// Jos käyttäjä syöttää pienemmän sivunumeron, kuin ensimmäinen
	if ($currentpage < 1) {
	   // näytetään ensimmäinen sivu
	   $currentpage = 1;
	}

	//offset kertoo mikä luku näytetään ensimmäisenä kullakin sivulla.
	$offset = ($currentpage - 1) * $rowsperpage;

	//Sisällytetään äänten lisäämisen sisältävä tiedosto
	require_once('functions/idea_vote.php');
	
	//JOS IDEOIDEN LAJITTELU ON MÄÄRITETTY
	if(isset($_GET['sort'])) {

		///////////////////////////////////////////////////////////////////
		//ALLA OLEVAN IF-LAUSEEN SISÄÄN LAJITTELU UUSIMPIEN IDEOIDEN MUKAAN
		///////////////////////////////////////////////////////////////////
		if($_GET['sort'] == "new")
		{

			//Lajittelun tallennus muuttujaan. Muuttujaa käytetään apuna sivunumeroinnissa.
			$lajittelu = "new";

			// HAETAAN UUSIMMAT IDEAT TIETOKANNASTA
			$uusimmat = $kanta->prepare("SELECT * FROM idea ORDER BY id_idea DESC LIMIT $offset, $rowsperpage");
			$uusimmat->execute();

			//Idean sijoitus. Kasvatetaan while-lauseessa.
			$position = $currentpage * 10 - 9;
			
			//WHILE-lause kaikkien ideoiden tulostamiseen. 
			while ($idea = $uusimmat->fetch()) {
		?>		
					<div class="listitem">
						<div class="ideabox">
							<div class="name">
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=idea&id=".$idea['id_idea']."\">";
							echo $idea['otsikko']; //TÄHÄN KOHTAAN TULOSTETAAN IDEAN NIMI 
							?>
							</a>
							</div>
							<div class="publisher">
							<?php echo "Anonyymi"; //TÄHÄN TULOSTETAAN JULKAISIJAN NIMI. JOS IDEA SYÖTETTY ILMAN TUNNUSTA TULOSTETAAN "anonyymi" tms. ?>
							</div>
							<div class="likes">
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=show-all&sort=new&id=".$idea['id_idea']."&vote=plus\">";
							?>
								<img class="rotate" src="layout/icon_like.png" alt="Tykkää">
							</a> 
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=show-all&sort=new&id=".$idea['id_idea']."&vote=minus\">";
							?>
								<img class="rotate" src="layout/icon_dislike.png" alt="En tykkää">
							</a>
							</div>
							<div class="votes">
							<?php 
							//idean äänet
							$votes = $idea['plus'] - $idea['miinus']; 
							if ($votes > 0) {echo "+";}
							echo $votes;
							?>
							</div>
						</div>
						<div class="position"><?php echo $position; //KOKONAISIJOITUKSEN TULOSTAMINEN ?>.</div>
					</div>
		<?php 
			//Kasvatetaan position-muuttujaa, jotta sijoitus näkyy oikein
			$position++;
			} //WHILE-lause loppuu
		} //IF-lause loppuu
		
		///////////////////////////////////////////////////////////////////////
		//ALLA OLEVAN IF-LAUSEEN SISÄÄN LAJITTELU SUOSITUIMPIEN IDEOIDEN MUKAAN
		///////////////////////////////////////////////////////////////////////
		
		else if($_GET['sort'] == "popular")
		{
			//Lajittelun tallennus muuttujaan. Muuttujaa käytetään apuna sivunumeroinnissa.
			$lajittelu = "popular";

			// HAETAAN SUOSITUIMMAT IDEAT TIETOKANNASTA
			$suosituimmat = $kanta->prepare("SELECT * FROM idea ORDER BY plus DESC LIMIT $offset, $rowsperpage");
			$suosituimmat->execute();

			//Idean sijoitus. Kasvatetaan while-lauseessa.
			$position = $currentpage * 10 - 9;
			//WHILE-lause kaikkien ideoiden tulostamiseen. 
			while ($idea = $suosituimmat->fetch()) {
			
		?>		
					<div class="listitem">
						<div class="ideabox">
							<div class="name">
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=idea&id=".$idea['id_idea']."\">";
							?>
							<?php echo $idea['otsikko']; //TÄHÄN KOHTAAN TULOSTETAAN IDEAN NIMI ?>
							</a>
							</div>
							<div class="publisher">
							<?php echo "Anonyymi"; //TÄHÄN TULOSTETAAN JULKAISIJAN NIMI. JOS IDEA SYÖTETTY ILMAN TUNNUSTA TULOSTETAAN "anonyymi" tms. ?>
							</div>
							<div class="likes">
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=show-all&sort=popular&id=".$idea['id_idea']."&vote=plus\">";
							?>
								<img class="rotate" src="layout/icon_like.png" alt="Tykkää">
							</a> 
							<?php
							echo "<a href=\"".$_SERVER['PHP_SELF']."?page=show-all&sort=popular&id=".$idea['id_idea']."&vote=minus\">";
							?>
								<img class="rotate" src="layout/icon_dislike.png" alt="En tykkää">
							</a>
							</div>
							<div class="votes">
							<?php 
							$votes = $idea['plus'] - $idea['miinus']; 
							if ($votes > 0) {echo "+";}
							echo $votes;
							?>
							</div>
						</div>
						<div class="position"><?php echo $position; //KOKONAISIJOITUKSEN TULOSTAMINEN ?>.</div>
					</div>
		<?php 
			//Kasvatetaan position-muuttujaa, jotta sijoitus näkyy oikein
			$position++;
			} //WHILE-lause loppuu
		} //IF-lause loppuu
		
		/////////////////////////////////////////////////////////
		//JOS LAJITTELU ON MÄÄRITETTY, MUTTA SE ON VIRHEELLINEN//
		/////////////////////////////////////////////////////////
		
		else {
		//Tulostetaan oletuksena uusimmat ideat
		$lajittelu = "new";
		header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=new');
		}
	}

	//////////////////////////////////////////////////////////////////////
	//JOS LAJITTELUA EI OLE ASETETTU, TULOSTETAAN OLETUKSENA UUSIMMAT IDEAT
	//////////////////////////////////////////////////////////////////////
	else{
	$lajittelu = "new";
	header('Location: '.$_SERVER['PHP_SELF'].'?page=show-all&sort=new');
	}

	//////////////////////////////////////////////////////////////////////
	///////////////////////////SIVUNUMEROINTI/////////////////////////////
	//////////////////////////////////////////////////////////////////////

	// näytettävien sivujen määrä valittuun sivuun nähden
	$range = 3;
	?>
				<div class="pages">
					<div style="float:left;text-align:right;" class="edgeArea">
	<?php
	// Näytä edellinen-painike, mikäli ei olla ensimmäisellä sivulla
	if ($currentpage > 1) {
	   // linkki ensimmäiselle sivulle
	   echo "<a class=\"edge\" href=\"".$_SERVER['PHP_SELF']."?page=show-all&amp;sort=".$lajittelu."&amp;currentpage=1\">&#60;&#60;</a> \n";
	   // aiemman sivun numero
	   $prevpage = $currentpage - 1;
	   // linkki edelliselle sivulle
	   echo "<a class=\"edge\" href=\"".$_SERVER['PHP_SELF']."?page=show-all&amp;sort=".$lajittelu."&amp;currentpage=$prevpage\">&#60; Edellinen</a> \n";
	}
	?>
					</div>
					<div class="pagenum">
	<?php
	//FOR-lause oikeiden sivunumerojen näyttämiseen valitun sivun ympärillä.
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
	   // Jos on toimiva sivunumero
	   if (($x > 0) && ($x <= $totalpages)) {
		  // Tämän hetkinen sivu
		  if ($x == $currentpage) {
			 // Muotoillaan hieman eri tavalla tämän hetkinen sivu
			 echo "<a class=\"selected\">$x</a> \n";
		  // Muut sivut
		  } else {
			 // Tulostetaan linkki sivulle
			 echo "<a href=\"".$_SERVER['PHP_SELF']."?page=show-all&amp;sort=".$lajittelu."&amp;currentpage=$x\">$x</a> \n";
		  }
	   }
	}
	?>
					</div>
					<div style="float:right;text-align:left;" class="edgeArea">
	<?php
	// Näytä seuraava ja viimeinen painikkeet, jos ei olla viimeisellä sivulla.
	if ($currentpage != $totalpages) {
	   // seuraava sivu
	   $nextpage = $currentpage + 1;
		// tulostetaan linkki seuraavalle sivulle
	   echo "<a class=\"edge\" href=\"".$_SERVER['PHP_SELF']."?page=show-all&amp;sort=".$lajittelu."&amp;currentpage=$nextpage\">Seuraava &#62;</a> \n";
	   // tulostetaan linkki viimeiselle sivulle
	   echo "<a class=\"edge\" href=\"".$_SERVER['PHP_SELF']."?page=show-all&amp;sort=".$lajittelu."&amp;currentpage=$totalpages\">&#62;&#62;</a> \n";
	}
	?>
					</div>
				</div>
				<div class="total">
	<?php
				//Viimeisen näytettävän sijoitus
				$lastShowing = $currentpage * 10;
				//Ensimmäisen näytettävän sijoitus
				$firstShowing = $lastShowing - 9;
				
				
				if ($lastShowing > $numrows) {
					$lastShowing = $numrows;
				}
	?>
				<?php echo "Ideat ".$firstShowing."-".$lastShowing;?>. Ideoita yhteensä <?php echo $numrows;?> kpl.
				</div>
<?php 
} else {
?>
				<div style="width:300px;margin:0 auto;padding-top:60px;">
				<h2>Ei yhtään lisättyä ideaa. </h2>
				<p>Lisää palveluun ensimmäinen idea <?php echo "<a href=\"".$_SERVER['PHP_SELF']."?page=concept\">tästä</a>";?>.
				</div>
<?php
}
?>
			</div>
		</div>