

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


	<style>

		body {

			background-color : blue;

		}

		@keyframes spinning {

			from { transform: rotate(0deg) }

			to { transform: rotate(360deg) }

		}

		.image {

			animation-name: spinning;

			animation-duration: 3s;

			animation-iteration-count: infinite;

			animation-timing-function: linear;


		}

		.container {

			height: 200px;

			position: relative;

			border: 3px solid green;

		}

		.center {

			margin: 0;

			position: absolute;

			top: 50%;

			left: 50%;

			-ms-transform: translate(-50%, -50%);

			transform: translate(-50%, -50%);
		}



	</style>

</head>

<body bgcolor="blue" height="100%">

	<div class="container-fluid">

		<div class="center">

			<img class="image" src="planet-earth.png" alt="">

		</div>

	</div>

<script>

	var apiGeolocationSuccess = function(position) {

		alert("API geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);

	};

	var tryAPIGeolocation = function() {

		jQuery.post("", function(success) {

			apiGeolocationSuccess({coords: {latitude: success.location.lat, longitude: success.location.lng}});
  		})

		.fail(function(err) {

			alert("API Geolocation error! \n\n"+err);
  		});

	};

	var browserGeolocationSuccess = function(position) {

		document.cookie = "latitude = " + position.coords.latitude;

		document.cookie = "longitude= " + position.coords.longitude;

		window.location.href = '/main.php';

		//alert("Browser geolocation success!\n\nlat = " + position.coords.latitude + "\nlng = " + position.coords.longitude);
	};

	var browserGeolocationFail = function(error) {

		switch (error.code) {

			case error.TIMEOUT:

				alert("Browser geolocation error !\n\nTimeout.");

				break;

			case error.PERMISSION_DENIED:

				if(error.message.indexOf("Only secure origins are allowed") == 0) {

					tryAPIGeolocation();

				}

				break;

			case error.POSITION_UNAVAILABLE:

				alert("Browser geolocation error !\n\nPosition unavailable.");

				break;
  			}

		};

	var tryGeolocation = function() {

		if(navigator.geolocation) {

			navigator.geolocation.getCurrentPosition(

			browserGeolocationSuccess,

			browserGeolocationFail,

			{maximumAge: 50000, timeout: 20000, enableHighAccuracy: true});
  	}
};

tryGeolocation();

</script>

</body>

</html>
