<?php
/*
Template Name: UnderConstruction
*/
?>
<!DOCTYPE html>
<html  lang="es">
<head>
	<meta charset="utf-8">
	<title>ConceptoCero</title>
	<script type="text/javascript" src="countdown.js"></script>
	<style type="text/css">
		body,html{
			background-color: #000;
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;
		}
		#logo{
			margin: 50px auto 0;
			width: 350px;
		}
		#logo > img{
			width: 350px;
			position: relative;
			top: 19px;
			left: -10px;
		}
		#countdown{
			color: #FFF;
			text-align: center;
			font-family: Arial;
			margin-top: 30px;
		}
	</style>	
</head>
<body>
	<div id="logo">
		<img src="placa.jpg">
	</div>
	<div id="countdown">Tue May 07 2013 11:00:00 GMT-0300 (ART)</div>
	<script type="text/javascript">
		var countdown = document.getElementById("countdown");
		var estreno = new Date(countdown.textContent);
		setInterval(function(){
			var actual = new Date();
			var millis = estreno.getTime() - actual.getTime();
			var segundos = Math.round(millis/1000);
			var minutos = Math.round(segundos/60);
			var horas = Math.round(minutos/60);
			var dias = Math.round(horas/24);
			var result = "En ";
			if(dias>1){
				result += dias+" dias";
			}else if(horas>1){
				result += horas+" horas";
			}else if(minutos>1){
				result += minutos+" minutos";
			}else{
				result += segundos+" segundos";
			}
			result += " estamos.";
			countdown.textContent = result;
		},500);
	</script>
</body>
</html>