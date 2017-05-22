<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 

if (!isset($_GET['result'])) {
header('Location: main.php');
}

$haettava = $_GET['result'];

require_once('functions/idea_search.php');

$hakutulos = search($haettava, 0);
$maara = count($hakutulos);
?>
		<div class="inside">
			<h1>Hakutulokset</h1>
			Tulokset haulle "<?php echo $haettava;?>". <span style="float:right;">Yhteensä <?php echo $maara; ?> tulosta.</span>
			<hr>
			<?php
			foreach ($hakutulos as $row) {
			?>
			<div class="searchResult">
			<?php echo "<a href=\"main.php?page=idea&id=".$row["id_idea"]."\">";?>
				<?php echo $row["otsikko"];?><img src="layout/icon_go.png" alt=">">
			<span style="font-size: 12px;font-weight:normal;float:right;"><?php echo date("d.m.Y", strtotime($row["aikaleima"])); ?></span>
			</a>
			</div>
			<?php
			}
			?>

		</div>