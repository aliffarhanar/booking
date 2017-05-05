<html>
<title>Booking Ruangan</title>
<head>
    <!-- BOOTSTRAP -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap-min.css">
    <!-- MATERIAL DESIGN -->
	<link rel="stylesheet" href="material/material.css">
	<link rel="stylesheet" href="material/material.min.css">
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.9.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="material/material.min.js"></script>
    <script src="material/material.js"></script>
	
	
	<style>
			.demo-card-wide > .mdl-card__title {
			  color: #fff;
			  height: 176px;
			  background: url('../assets/demos/welcome_card.jpg') center / cover;
			}
			.demo-card-wide > .mdl-card__menu {
			  color: #fff;
			}
			.body {
				background:url('img/bg.png');
				width:100%
				height:100%
			}
			</style>
</head>
<body class="body">
	<br><br>
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-body">
			<?php
				$fb = new Facebook\Facebook([
				  'app_id' => $app_id, // Replace {app-id} with your app id
				  'app_secret' => $app_secret,
				  'default_graph_version' => 'v2.2',
				  ]);

				$helper = $fb->getRedirectLoginHelper();

				$permissions = ['email']; // Optional permissions
				$loginUrl = $helper->getLoginUrl('http://pinopi.com/booking/fb-callback.php', $permissions);

				echo '<a href="' . htmlspecialchars($loginUrl) . '" class="btn btn-primary col-md-12">Log in with Facebook</a>';
			?>
		</div>
	</div>
</body>
</html>
		
