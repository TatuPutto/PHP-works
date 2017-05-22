<?php 
//Ohjataan käyttäjä pääsivulle, mikäli tiedostoon ei ole sisällytetty sivurakennetta.
if(!$header){ header('Location: index.php');} 
?>
		</div>
		
	</div>
	
	<!-- Container loppuu ja alapalkki alkaa -->
	
	<div id="footer">
		<div class="footer_content">
			<div class="left">
				<ul>
					<li><h3>Kieli</h3></li>
					<li><a href="">Suomeksi</a></li>
					<li><a href="">In English</a></li>
					<li><a href="">På svenska</a></li>
				</ul>
			</div>
			<div class="center">
				<a href="http://www.karelia.fi/"><img src="layout/karelia_logo.jpg" alt="Karelia-AMK"></a>
			</div>
			<div class="right">
				<ul>
					<li><h3>Info</h3></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=terms">Käyttöehdot <!--Terms of Service--></a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=privacy">Yksityisyydensuoja <!--Privacy Policy--></a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=privacypolicy">Rekisteriseloste <!--Privacy Policy--></a></li>
					<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=help">FAQ <!--Help--></a></li>
				</ul>
			</div>
		</div>
	</div>
	
</div>

</body>
</html>