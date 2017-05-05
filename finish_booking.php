<?php 
	if(isset($_POST['selesai'])){
		ini_set('display_errors',1);
		$data = array('ql' => "select * where name='".$_GET['ruangan']."'");		
		//reading data ruangan
		$ruangans = $client->get_collection('ruangans',$data);
		//do something with the data
		while ($ruangans->has_next_entity()) {
			$ruangan = $ruangans->get_next_entity();
			$_SESSION['get_ruangan'] = $ruangan;
			$_SESSION['ruanganUUID'] = $ruangan->get('uuid');
		}
		
		$endpoint = 'pinjams';
		$query_string = array();
		$makanan = "";
		for($i=0;$i<count($_POST['menu_makanan']);$i++){
			if($_POST['qty_makanan'][$i] != 0){
				if($makanan != ""){
					$makanan .= ',';
				}
				$makanan = $makanan.$_POST['menu_makanan'][$i].":".$_POST['qty_makanan'][$i].":".$_POST['harga_makanan'][$i]; 								
			}
		}
/**		for($i=0;$i<count($_POST['makanan']);$i++){
			$makanan = $makanan.$_POST['makanan'][$i]; 								
			if($i != (count($_POST['makanan'])-1)){
				$makanan .= ',';
			}
		}
**/		
		$minuman = "";
		for($i=0;$i<count($_POST['menu_minuman']);$i++){
			if($_POST['qty_minuman'][$i] != 0){
				if($minuman != ""){
					$minuman .= ',';
				}
				$minuman = $minuman.$_POST['menu_minuman'][$i].":".$_POST['qty_minuman'][$i].":".$_POST['harga_minuman'][$i]; 								
			}
		}
/**		for($i=0;$i<count($_POST['minuman']);$i++){
			$minuman = $minuman.$_POST['minuman'][$i]; 								
			if($i != (count($_POST['minuman'])-1)){
				$minuman .= ',';
			}
		}
**/		
		$daftar_tamu = $_SESSION['daftar_tamu'];
		$body = array(
				"name" => $_POST['nama'],
				"bentukruangan" => $_POST['bentuk_ruangan'],
				"jammulai" => (int)$_POST['jam_mulai'],
				"jamselesai" => (int)$_POST['jam_selesai'],
				"jumlah" => (int)$_POST['jumlah'],
				"fasilitastambahan" => $_POST['fasilitas_tambahan'],
				"keteranganmakanan" => $_POST['makanan_keterangan'],
				"keteranganminuman" => $_POST['minuman_keterangan'],
				"makanan" => $makanan,
				"minuman" => $minuman,
				"ruangan" => $ruangan->get('uuid'),
				"tamu" => $daftar_tamu,
				"tanggal" => $_POST['tanggal'],
				"harga" => (int)$_POST['harga'],
				"pembayaran" => $_POST['pembayaran'],
				"user" => $_SESSION['uuid']
			);
			
		$success = false;
		$result = $client->post($endpoint, $query_string, $body);
		if ($result->get_error()){
			echo "
			<div class='row'>
				<div class='col-md-8 col-md-offset-2'>
					<div class='alert alert-danger' style='text-align:center;'>
						<h4>Gagal Melakukan Pemesanan, silahkan lakukan proses pemesanan ulang.</h4>
					</div>
				</div>
			</div>
			";
			echo '<meta http-equiv="refresh" content="0; url=?page=dashboard">';
		} else {
			$success = true;
		}
	}else{
		echo '<meta http-equiv="refresh" content="0; url=?page=dashboard">';
	}
	if($success){
		unset($_SESSION['daftar_tamu']);
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-body">
			<div class="col-md-5">
				<h6 class=" text-bold"><?php echo $ruangan->get('name'); ?></h6>
				<img class="thumbnail" src="<?php echo $ruangan->get('foto'); ?>" style="width:100%" alt="...">
				<table class="table table-bordered table-striped" style="font-size: small;">
					<tr>
						<th>KAPASITAS RATA-RATA</th><th>FASILITAS</th>
					</tr>
					<tr>
						<td>+- <?php echo $ruangan->get('kapasitas')['rata-rata'];?> orang</td>
						<td> <?php echo $ruangan->get('fasilitas'); ?></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7" style="padding:0px">
				<h6 class=" text-bold">DETAIL INORMASI PEMINJAMAN</h6>
				<hr>
				<div>
					<div class="col-md-4 text-bold">
						Nama Meeting
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['nama'];?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Tanggal & Waktu
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['tanggal']; ?>, Jam <?php echo $_POST['jam_mulai']; ?> s/d <?php echo $_POST['jam_selesai']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Jumlah Orang
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['jumlah']; ?> orang
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Tamu Undangan
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['tamu']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Makanan
					</div>
					<div class="col-md-8">
						: <?php 
							echo $makanan;
						  ?>
					</div>
				</div>
				<div>
					<div class="col-md-4">
						Catatan Makanan
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['makanan_keterangan']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Minuman
					</div>
					<div class="col-md-8">
						: <?php 
							echo $minuman;
						?>
					</div>
				</div>
				<div>
					<div class="col-md-4">
						Catatan Minuman
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['minuman_keterangan']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Fasilitas
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['fasilitas_tambahan']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Lokasi Ruangan 
					</div>
					<div class="col-md-8">
						: <?php echo $ruangan->get('alamat'); ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Pembayaran 
					</div>
					<div class="col-md-8">
						: <?php echo $_POST['pembayaran']; ?>
					</div>
				</div>
				<div>
					<div class="col-md-4 text-bold">
						Peta Ruangan 
					</div>
					<div class="col-md-8">
						: <?php echo ucfirst($_POST['bentuk_ruangan']); ?><br>
						<img src="img/kapasitas/venue-layout-<?php echo $_POST['bentuk_ruangan']; ?>.png" width="75px"/>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<a href="?page=riwayat-booking" class="btn btn-success pull-right">OK, LIHAT RIWAYAT PEMINJAMAN</a>
			</div>
		</div>
	</div>
</div>
<?php		
	}
?>
