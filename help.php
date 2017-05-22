<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 
?>
		<div class="inside">
		<h1 class="h1-faq">Usein kysytyt kysymykset</h1>
		<hr>
		<section id="faq">
			<h3>Mikä on T-Idea?</h3>
			<div class="answer">
				<p>T-Idea on avoin kanava uusien ideoiden esittämiselle ja jatkokehitykselle. T-Idea toimii Karelia-ammattikorkeakoulun tietojenkäsittelyn koulutuslinjan alaisuudessa, mutta sitä voidaan hyödyntää myöskin muiden koulutuslinjan tarpeiden mukaan. Myöskin Karelia-ammattikorkeakoulun ulkopuolisille käyttäjille on mahdollista osallistua palveluun, mutta osa toiminnoista saattaa olla ulkopuolisille käyttäjille rajoitettuja taikka muilla tavoin estettyjä.
			</div>
			<h3>Miksi tälläinen palvelu?</h3>
			<div class="answer">
				<p>Karelia-ammattikorkeakoulun tietojenkäsittelyn koulutuslinjalla oli tarve palvelulle jonka avulla pystyisi kokoamaan ja viemään eteenpäin uusia innovatiivisia ideoita joita opiskelijat tuottavat. Varsinainen sivusto toteutettiin toisen vuoden opiskelijaryhmän toimesta projektityönä. 
			</div>
			<h3>Mitä minun tulisi tietää ennen palvelun käytön aloittamista?</h3>
			<div class="answer">
				<p>Jokaisen käyttäjän tulisi tutustua ennen palvelun käyttöä <a href="">Käyttöehdot</a> sekä <a href="">Tietosuoja</a> dokumentteihin jotka löytyvät omilta sivuiltaan. Lisäksi jokaiselta käyttäjältä odotetaan hyvää makua sekä peruslaatuista netiketin tuntemista ja käyttämistä, sekä Karelia-ammattikorkeakoulun muiden sääntöjen noudattamista. 
			</div>
			<h3>Olen unohtanut salasanani!</h3>
			<div class="answer">
				<p>Salasanan voi palauttaa pyytämällä sitä erikseen palvelun ylläpitäjältä. Tätä varten tarvitset sen sähköpostiosoitteen jota käytit rekisteröityessäsi palveluun.
			</div>
			<h3>Olen unohtanut käyttäjätunnukseni!</h3>
			<div class="answer">
				<p>Käyttäjätunnuksen voi palauttaa pyytämällä sitä erikseen palvelun ylläpitäjältä. Tätä varten tarvitset sen sähköpostiosoitteen jota käytit rekisteröityessäsi  palveluun.
			</div>
			<h3>Olen unohtanut käyttäjätunnukseni ja/tai salasanani enkä pääse enää sähköpostiin jota käytin rekisteröityessäni!</h3>
			<div class="answer">
				<p>Palvelun ylläpitäjä voi oman harkintansa mukaan palauttaa tunnuksesi tässäkin tilanteessa, mutta hän todennäköisesti tulee kysymään henkilöllisyytesi varmentavia turvakysymyksiä. Mikäli et halua/voi vastata kysymyksiin ainoa vaihtoehtosi on tehdä täysin uusi käyttäjätili.
			</div>
			<h3>Apua, käyttäjätilini on varastettu!</h3>
			<div class="answer">
				<p>Ota samantien yhteyttä palvelun ylläpitäjään, hän voi palauttaa käyttäjätilisi vastattuasi mahdollisiin turvakysymyksiin. Lisäksi ottamalla yhteyttä ylläpitäjään vapaudut vastuusta liittyen varastetun tilin käyttöön.
			</div>
			<h3>Sain bannit palveluun ja haluan valittaa asiasta.</h3>
			<div class="answer">
				<p>Ylläpitäjällä on oikeus estää käyttäjän pääsy palveluun mikäli käyttäjän käytös ei vastaa odotettuja normeja, taikka rikkoo käyttöehtoja tai suomen lakia. Mikäli näet kuitenkin että tämä esto on ollut epäoikeudenmukainen, voit lähettää ylläpitäjälle sähköpostia jossa pyydät käyttöoikeuksiesi palauttamista.
			</div>
		</section>
		<hr>
		<h4 id="questionForm_info">Mikäli sinulla on kysymyksiä joihin tämä FAQ ei vastannut, voit jättää ne tähän. Palvelun ylläpitäjä käsittelee kysymykset normaalin työviikon aikana ja vastaa niihin jättämääsi sähköpostiosoitteeseen. </h4>
		<form action="" method="post">
		<div id="questionForm">
			<div class="email">Sähköposti:</div>
			<input type="text" name="email">
			<div class="question">Kysymys:</div>
			<textarea name="message"></textarea>
			<input type="submit" value="Lähetä">
		</div>
		</form>
		</div>
		<script type="text/javascript">
		$(document).ready(function() {
			$('#faq h3').click(function() {
		 
				$(this).next('.answer').slideToggle(500);
				$(this).toggleClass('close');
		 
			});
		});
		</script>
		