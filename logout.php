<?php
	session_start();
	session_destroy();
	header("location:http://pinopi.com/booking/?page=login");
?>