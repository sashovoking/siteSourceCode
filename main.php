
<?php

if(!isset($_COOKIE['latitude']) and !isset($_COOKIE['longitude'])) {

	header("Location: index.php");

}

else {

	$latitude = $_COOKIE['latitude'];

	$longitude = $_COOKIE['longitude'];

	$json = file_get_contents("http://api.geonames.org/countryCodeJSON?lat=". $latitude . "&lng=" . $longitude . "&username=jess");

	$d = json_decode($json);

	$country = $d->countryName;

	$countryCode = $d->countryCode;

}

?>

<!DOCTYPE html>

<html>

<head>

        <title>A Website</title>

        <meta charset="UTF-8">

        <meta name="keywords" content="Geolocation, GPS">

        <meta name="author" content="Caragea Alexandru">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<base href="#main" target="_blank">

	<style>

		* {

			padding: 0;

			margin: 0;

		}

		iframe {

			width: 100%;

			height: 100%;

		}


		.dropbtn {

			background-color: #3498DB;

			padding: 16px;

			color: white;

			font-size: 16px;

			bottom: 0;

			width: 100%;

		}

		.dropup {

			position: fixed;

			display: inline-block;

			bottom: 0;

			width: 100%;

		}

		.dropup-content {

			display: none;

			position: absolute;

			background-color: #f1f1f1;

			min-width: 16px;

			bottom: 50px;

			z-index: 1;

		}

		.dropup-content a {

			color: black;

			padding: 12px 16px;

			text-decoration: none;

			display: block;
		}

		.dropup-content a {

			background-color: #ccc;

		}

		.dropup:hover .dropup-content {

			display: block;
		}

		.dropup:hover .dropbtn { //here

			background-color: #2980B9;
		}

		table {

			width: 0;

			height: 0;

			padding: 0px;

		}

		@media only screen and (min-width: 900px) {

			button {

				display: inline-block;

				padding-right: 100px;

				padding-left: 100px;

				text-align: center;

			}

			.firstButton {

				padding-left: 65px;

			}

		}

		@media only screen and (max-width: 899px) {

			button {

				display: inline-block;

				padding-right: 5px;

				padding-left: 5px;

				text-align: center;

			}


		}


		#sub {

			padding-left: 200px;

			text-align: center;

		}

		#subb {

			text-align: center;

		}

		#subbb {

			text-align: center;

		}

	</style>

</head>

<body>

	<div id="map" style="width: 100%; height: 90%; position: absolute;"></div>

	<div class="dropup">

		<button class="dropbtn">Learn More About <?php echo $country; ?></button>

		<div class="dropup-content" style="background-color: #032b25; width: 100%; float:left;">

		<i class="fa fa-close" id="closeButton" onclick="cb()" style="color: #00ff00;"></i>

		<div class="container" style="width: 100%;">

				<div class="row">

					<div class="col-*-*">

						<h3 class="firstButton"><button class="firstButton" onclick="to()" style="font-family: Courier; color: white; background-color: #032b25; border: 3px solid white;" href="#Info">Info</button></h3>

					</div>

					<div class="col-*-*">

						<h3><button onclick="tt()" style="font-family: Courier; color: white; background-color: #032b25; border: 3px solid white;" href="#Weather">Weather</button></h3>

					</div>

					<div class="col-*-*">

						<h3><button onclick="ttt()" style="font-family: Courier; color: white; background-color: #032b25; border: 3px solid white;" href="#CurrencyExchange">Money Rate</button></h3>

					</div>

						<i><h4 style="text-align: center; color: white;"><div id="sub"></div></h4></i>

						<i><h4 style="text-align: center; color: white;"><div id="subb""></div></h4></i>

						<i><h4 style="text-align: center; color: white;"><div id="subbb"></div></h4></i>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>

<script>

	function to() {

		document.getElementById("subbb").innerHTML = "";

		document.getElementById("subb").innerHTML = "";

		document.getElementById("sub").innerHTML = "<br><br><?php $lowercaseCountry = strtolower($country); ?> <?php $flagUrl = 'https://www.countryflags.io/' . $countryCode . '/shiny/64.png';?> <p><img src='<?php echo $flagUrl; ?>'/></p><p>Country: <?php echo $country; ?></p><p>Capital: <?php $response = file_get_contents('https://restcountries.eu/rest/v2/name/' . $lowercaseCountry); $jDecode = json_decode($response); echo $jDecode[0]->capital; ?> </p> <p>Population: <?php echo $jDecode[0]->population; ?></p><p>Area: <?php echo $jDecode[0]->area; ?> km<sup>2</sup></p><p>Currency: <?php echo $jDecode[0]->currencies[0]->name; ?></p></div></div></div></div>";


	}

	function tt() {

		document.getElementById("sub").innerHTML = "";

		document.getElementById("subb").innerHTML = "";

		document.getElementById("subb").innerHTML = "weather"; //needs weather api

	}

	function ttt() {

		document.getElementById("sub").innerHTML = "";

		document.getElementById("subb").innerHTML = "";

		document.getElementById("subbb").innerHTML = "currency exchange"; //needs currency exchange api

	}

	function cb() {

		document.getElementById("sub").innerHTML = "";

		document.getElementById("subb").innerHTML = "";

		document.getElementById("subbb").innerHTML = "";

		location.replace("main.php");

	}

	var cookies = document.cookie.split(";");

	var latitudeSplitCookies = (cookies[0].split("="));

	var longitudeSplitCookies = (cookies[1].split("="));

	var latitude = parseFloat(latitudeSplitCookies[1]);

	var longitude = parseFloat(longitudeSplitCookies[1]);

	function initMap() {

		var location = {lat:latitude, lng:longitude};

		var map = new google.maps.Map(document.getElementById("map"), {zoom:10, center:location});

		var marker = new google.maps.Marker({position:location, map:map});


	}

</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8MZ-YG9TNtDJPfujNRumhw1Pv8FWd3FA&callback=initMap"></script>


</body>

</html>
