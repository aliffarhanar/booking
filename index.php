<?php
	include 'config/config.php';
	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
	require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
	$app_id = "1348764941859694";
	$app_secret = "c8fb3adb5443de8af1b568e11d863b2e";
	if(isset($_GET['page']) AND $_GET['page'] == 'login'){
		header("location:"."http://" . $_SERVER['SERVER_NAME']."/booking");
	}
?>
<html>
<title>Booking Ruangan</title>
<head>
    <!-- BOOTSTRAP -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap-min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- MATERIAL DESIGN -->
	<link rel="stylesheet" href="material/material.css">
	<link rel="stylesheet" href="material/material.min.css">
    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"   integrity="sha256-xI/qyl9vpwWFOXz7+x/9WkG5j/SVnSw21viy8fWwbeE="   crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap-select.js"></script>
    <script src="material/material.min.js"></script>
    <script src="material/material.js"></script>
	
	<script type="text/javascript">
		function changeMakanan(obj){
			if(obj.checked){
				document.getElementById("edit_mkn").style = "display:block;";
			}else{
				document.getElementById("edit_mkn").style = "display:none;";
			}
		}
		function changeMinuman(obj){
			if(obj.checked){
				document.getElementById("edit_mnn").style = "display:block;";
			}else{
				document.getElementById("edit_mnn").style = "display:none;";
			}
		}
		function addTamu(){
			var nama = document.getElementById("tamu").value;
			var jabatan = document.getElementById("tamu_jabatan").value;
			if(nama == ''){
				alert("Nama Tamu tidak boleh kosong");			
			}else{
				var dataString = 'daftar_tamu='+nama+"&jabatan="+jabatan;
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: dataString,
					cache: false,
					success: function(html) {
						document.getElementById("daftar_tamu").innerHTML = html;
						document.getElementById("tamu").value = '';
						document.getElementById("tamu_jabatan").value = '';
					}
				});
			}
		}
		function deleteTamu(nama){
			var dataString = 'delete_tamu='+nama;
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById("daftar_tamu").innerHTML = html;
				}
			});
		}
		function show(obj){
			var targets = [];
			$.each($(".selectpicker option:selected"), function(){
			targets.push($(this).val());
			});
			alert("You have selected the targets - " + targets.join(", "));
		}
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});		
		$(document).ready(function() {
			$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));		
		});
			$(function () {
				var dateNow = new Date();
				$('#datepicker').datetimepicker({					
					defaultDate:dateNow,
    				format: 'DD/MM/YYYY'
				}).focusout(function (e) {
					var loading = "<tr><td><div class='alert alert-default' style='text-align:center;font-weight:bold;opacity:0.5;'><img src='http://www.moriwo.com/images/loading.gif' width='100px' /><br>Mempersiapkan Data Ketersediaan<br>Untuk 1 Minggu Kedepan</div></td></tr>";
					document.getElementById("available_waktu").innerHTML = loading;
					var waktu = document.getElementById("tanggal").value;
					var dataString = 'cari_waktu='+waktu;
					$.ajax({
						type: "POST",
						url: "ajax.php",
						data: dataString,
						cache: false,
						success: function(html) {
							document.getElementById("available_waktu").innerHTML = html;
						}
					});
				});
			});
		});
		function setting_datetime(obj){
			if(obj.checked){
				$("div:hidden").fadeIn("slow");
				document.getElementById("setting_datetime").style = "border : 1px solid #c3c3c3;padding:10px;display:block;";
			}else{
				document.getElementById("setting_datetime").style = "border : 1px solid #c3c3c3;padding:10px;display:none;";
			}
		}
		function cariWaktu(){
			var waktu = document.getElementById("tanggal").value;
			var dataString = 'cari_waktu='+waktu;
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById("available_waktu").innerHTML = html;
				}
			});
		}
	</script>
	
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
			.text-bold{
				font-weight:bold;
			}
			textarea {
				resize: none;
			}
			</style>
			<?php
			if(isset($_GET['page'])){
			?>
			<nav class="navbar navbar-default ">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
<!--				  <a class="navbar-brand" href="?page=dashboard">BOOKING RUANGAN</a> -->
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">				  
				  <ul class="nav navbar-nav">
					<li class="active"><a href="?page=dashboard">CARI RUANGAN</a></li>
					<li class="active"><a href="?page=riwayat-booking">RIWAYAT BOOKING</a></li>
				  </ul>
					<p class="navbar-text navbar-right">Hai, <?php echo $_SESSION['name']; ?> <a href="logout.php" class="navbar-link">(Log Out)</a></p>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
			<?php
			}
			?>
</head>
<body class="body" style="background-color:grey">
	<div class="col-md-12">
		<?php
			if(isset($_GET['page'])){
				$page = $_GET['page'];				
			}else{
				$page = "login";
			}
			switch($page){
				case 'login_facebook' : include 'fb-callback.php';break;
				case 'login' : include 'login.php';break;
				case 'dashboard' : include 'dashboard.php';break;
				case 'booking' : include 'booking.php';break;
				case 'riwayat-booking' : include 'list_booking.php';break;
				case 'edit-booking' : include 'edit_booking.php';break;
				default: include 'login.php';
			}
		?>
	</div>
</body>
</html>