<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 
?>
<?php
//Haetaan osoiteriviltä syötetty otsikko, mikäli se on asetettu
if (isset($_GET['title'])) {
$otsikko = $_GET['title'];
}
?>
		<div class="inside">
			<div class="concept-box">
			<h1>Konseptoi ideasi</h1>
			<form id="conceptForm" action="functions/add_idea.php" method="post">
				<div class="inner">
					<div class="header">
					<h2>Otsikko</h2>
					<h4>Syötä otsikko ideallesi</h4>
						<?php 
						if (isset($otsikko)) {
						echo "<textarea name=\"idea_name\" class=\"inputfield\">".$otsikko."</textarea>\n";
						}
						else {
						echo "<textarea name=\"idea_name\" class=\"inputfield\"></textarea>\n";
						}
						?>
					</div>
					<div class="column">
						<h2>Ominaisuudet</h2>
						<h4>Liitä ideaasi ominaisuuksia</h4>
						<div id="inputWrapper">
							<div class="row">
								<input type="text" name="features[]" id="field_1" value="" class="inputfield">
								<div class="removeclass"></div>
							</div>
						</div>
						<a href="#" id="lisaaUusi" class="addnew">Lisää ominaisuus</a>
					</div>
					<div class="column">
					<h2>Lisätietoja</h2>
					<h4>Voit halutessasi jättää lisätietoja ideastasi.</h4>
					<textarea name="details"></textarea>
					</div>
					<div style="display:none;" id="notification">
						<div class="noti"></div>
						<div class="balloon"></div>
					</div>
					<div class="submit-idea"><input type="submit" value="Lähetä tiedot"></div>
				</div>
			</form>
			<script type="text/javascript">
				$('.submit-idea :submit').focusout(function(){
					$("#notification").css("display", "none");
				});
				
				$('#conceptForm').submit(function(e){
				
				var error = false;
					
					$(".noti").empty();
					$('.inputfield').each(function(){
					
						if($(this).val() == '') {
						error = true;
						}
					});
					
					if (error) {
						$("#notification").css("display", "inline").hide().fadeIn(200);
						$(".noti").append("Tarkista, että ideallasi on otsikko sekä vähintään yksi ominaisuus.");
						e.preventDefault(e);
					}
				   
				});
			
				$(document).ready(function() {
				
				var maxKentat = 9; //lisättyjen kenttien enimmäismäärä
				var InputsWrapper = $("#inputWrapper"); //tekstikenttien "wrapper", jonka sisään lisättävät kentät tulevat
				var lisaysButton = $("#lisaaUusi"); //Add button ID
				var x = InputsWrapper.length; //initlal text box count
				var kenttaMaara = 1; //apumuuttuja, joka kertoo montako kenttää on lisätty
				
					$(lisaysButton).click(function (e)  //kentän lisäys
					{
						if(x <= maxKentat) //kenttien enimmäismäärä
						{
							kenttaMaara++; //kasvatetaan laskuria
							//luodaan uusi tekstikenttä
							$(InputsWrapper).append('<div class="row"><input type="text" name="features[]" id="field_'+ kenttaMaara +'" class="inputfield"><div class=\"removeclass\"></div></div>');
							x++; //text box increment
						}
					return false;
					});

					$("body").on("click",".removeclass", function(e){ //kentän poisto
						if( x > 1 ) {
							$(this).parent('div').remove(); //poista tekstikenttä
							x--; //decrement textbox
						}
					return false;
					})
				
				});
					
		</script>
			</div>
		</div>