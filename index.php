<!DOCTYPE html>
<html lang="en">
<head>
	<title>T-Idea &raquo; Social innovation - put into practice</title>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="keywords" content="T-Idea, Karelia, Karelia-AMK, tiko, idea, portaali" />
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/front.css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="js/jquery.autosize.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('textarea').autosize();   
	});
	</script>
</head>

<body>
<div id="main">

	<div class="header">
			<img src="layout/logo_big.jpg" alt="Logo">
	</div>
	
	<div class="content">

		<div id="frontpage_form">
		
			<h2>Kerro ideasi</h2>
			
				<form action="main.php" method="get">
					<input type="hidden" name="page" value="concept">
					<textarea id="noempty" name="title"></textarea>
					<input type="submit" value="Jatka">
				</form>
				<div style="display:none;" id="notification">
					<div class="noti"></div>
					<div class="balloon"></div>
				</div>
			
		</div>
		<div id="gostraight">
		<a href="main.php">Siirry suoraan sivustolle</a>
		</div>
		
		<script type="text/javascript">
			$(':submit').focusout(function(){
				$("#notification").css("display", "none");
			});
			
			$('form').submit(function(e){
		
				$(".noti").empty();
		
			   if($('#noempty').val() == ''){
					$("#notification").css("display", "inline").hide().fadeIn(200);
					$(".noti").append("Virhe! Et voi jättää kenttää tyhjäksi.");
				  e.preventDefault(e);
			   }
			});
		</script>

	</div>
	
</div>

</body>

</html> 