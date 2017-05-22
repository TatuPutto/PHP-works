<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');}

/*
// TESTING: Virhekoodien toimivuuden tsekkausta
echo '<pre>';
if(isset($_GET['errors'])) { print_r(unserialize($_GET['errors'])); }
echo '</pre>';
*/

?>
<div class="inside">
	<form id="registerationForm" action="functions/register.php" method="get">
	<h3>Rekisteröi uusi käyttäjätunnus</h3>
		<div class="reg-content">
			<div class="row">
				<span>Käyttäjätunnus:</span>
				<div id="icon" class="icon-usr"></div>
				<input type="text" class="reg-username" name="username">
			</div>
			<div class="notification">Käyttäjätunnuksen tulee olla pituudeltaan 5-30 merkkiä.</div>
			<div class="row">
				<span>Salasana:</span>
				<div id="icon" class="icon-passwd"></div>
				<input type="password" class="reg-passwd" name="passwd">
			</div>
			<div class="notification">Salasanan tulee olla pituudeltaan 5-30 merkkiä.</div>
			<div class="row">
				<span>Vahvista salasana:</span>
				<div id="icon" class="icon-confirm"></div>
				<input type="password" class="reg-confirm" name="confirm">
			</div>
			<div class="notification">Syötä antamasi salasana uudelleen.</div>
			<div class="row">
				<span>Sähköpostiosoite:</span>
				<div id="icon" class="icon-email"></div>
				<input type="text" class="reg-email" name="email">
			</div>
			<div class="notification">Syötä kelvollinen sähköpostiosoite.</div>
		</div>
		<div class="reg-agree">
			<div class="checkBox">
				<input id="checkboxRegister" type="checkbox" name="agree">
				<label for="checkboxRegister"></label>
			</div>
			<div class="checkboxText">
			Olen lukenut palvelun <a target="_blank" href="main.php?page=terms">käyttöehdot</a> ja hyväksyn ne.
			</div>
		</div>
		<div style="display:none;" id="notification">
			<div class="noti"></div>
			<div class="balloon"></div>
		</div>
		<input type="submit" class="reg-submit" value="Rekisteröidy">
	</form>
	<script src="js/register.js"></script>
</div>