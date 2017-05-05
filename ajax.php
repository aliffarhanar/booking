<?php
	include 'config/config.php';
	$_SESSION['data_ruangan'] = array("AUDITORIUM","EXECUTIVE LOUNGE","BUSINESS-1","BUSINESS-2","EXPERIENCE CENTER","SERBAGUNA","DiCo/ViCON","BIOSPHERE/N21","INOVATION ROOM");
	$_SESSION['data_foto'] = array("img/foto.svg","foto/Executive.png","foto/Business 1.png","foto/Business 2.png","img/foto.svg","img/foto.svg","img/foto.svg","img/foto.svg","foto/Inovation.png");
	$_SESSION['data_fasilitas'] = array("Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor","Kursi, Meja, Proyektor");
	$_SESSION['data_kapasitas'] = array(250,15,55,35,25,30,10,19,15);
	$_SESSION['data_harga'] = array("gratis","gratis","gratis","gratis","gratis","gratis","gratis","gratis","gratis");
	$_SESSION['data_lokasi'] = array("Kota Bandung","Kota Bandung","DKI Jakarta","DKI Jakarta","Kota Bandung","Kota Bandung","Kota Bandung","Kota Bandung","DKI Jakarta");
	$_SESSION['data_alamat'] = array("AUDITORIUM","EXECUTIVE LOUNGE","Menara BDV lt. 5","BUSINESS-2","EXPERIENCE CENTER","SERBAGUNA","Gd. Utama DDS Bandung lt. 2","Gd. Utama DDS Bandung lt. 2","Menara BDV lt. 2");
	
	
	if(isset($_POST['cari'])){
		$_SESSION['kota'] = $_POST['lokasi'];
		$_SESSION['gedung'] = $_POST['lokasi_gedung'];
		$_SESSION['kapasitas'] = $_POST['kapasitas'];
		$_SESSION['tanggal'] = $_POST['tanggal'];
		$_SESSION['jam_mulai'] = $_POST['jam_mulai'];
		$_SESSION['jam_selesai'] = $_POST['jam_selesai'];
		if(isset($_POST['konsumsi'])){
			$_SESSION['konsumsi'] = "Bisa";					
		}else{
			$_SESSION['konsumsi'] = "Tidak Bisa";					
		}
		?>
		<div class="col-md-12">	
		<?php
			if($_POST['lokasi'] != 'all'){
				$data = array('ql' => "select * where name='".$_POST['lokasi']."'");		
				//reading data kota
				$kotas = $client->get_collection('kotas',$data);
			}else{
				$kotas = $client->get_collection('kotas');
			}
			//do something with the data
			while ($kotas->has_next_entity()) {
				$kota = $kotas->get_next_entity();
				if($_POST['lokasi_gedung'] != 'all'){
					$data = array('ql' => "select * where kota='".$kota->get('uuid')."' AND name='".$_POST['lokasi_gedung']."'" );
				}else{
					$data = array('ql' => 'select * where kota='.$kota->get('uuid'));
				}				
				//reading data gedung
				$gedungs = $client->get_collection('gedungs',$data);
				//do something with the data
				while ($gedungs->has_next_entity()) {
					$gedung = $gedungs->get_next_entity();
				?>
				<div class="panel panel-primary">
					<div class="panel-heading"><?php echo strtoupper($gedung->get('name'));?></div>
					<div class="panel-body">
				<?php	
					$data = array('ql' => 'select * where gedung='.$gedung->get('uuid'));
					//reading data ruangan
					$ruangans = $client->get_collection('ruangans',$data);
					//do something with the data
					while ($ruangans->has_next_entity()) {
						$ruangan = $ruangans->get_next_entity();
						if($_POST['kapasitas'] == 'all'){							
				?>
							<div class="col-md-3" style="padding:5px;">
							<div class="panel panel-body" style="box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);padding: 10px;">
								<img src="<?php echo $ruangan->get('foto');?>" style="width:100%" alt="...">
								<center>
									<h6 style="margin:10px;margin-bottom:0px;font-weight:bold"><?php echo $ruangan->get('name');?></h6>
									<small style="padding-bottom:10px;">
										<center>
											<?php	
												$data = array('ql' => 'select * where ruangan='.$ruangan->get('uuid'));
												//reading data ruangan
												$reviews = $client->get_collection('reviews',$data);
												//do something with the data
												$reviewer = 0;
												$rating = 0;
												while ($reviews->has_next_entity()) {
													$review = $reviews->get_next_entity();
													$reviewer++;
													$rating = $rating+$review->get('rating');
												}
												$total_rating = $rating / $reviewer;
												for($r=1;$r<=$total_rating;$r++){
													echo'<font color="blue"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></font>';
												}
												for($rr=$r;$rr<=5;$rr++){
													echo'<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
												}
											?>									
										</center>
									</small>
								</center>
								<small>
									<table class="" style="font-size: small;">
										<tr>
											<td style="width:40%" class="text-bold">Kapasitas</td><td>: +- <?php echo $ruangan->get('kapasitas')['rata-rata'];?> orang</td>
										</tr>
										<tr>
											<td colspan="2" class="text-bold">Fasilitas Yang Tersedia :</td>
										</tr>
										<tr>
											<td colspan="2" style="padding-top: 0px;"><?php echo $ruangan->get('fasilitas');?></td>
										</tr>
									</table>				
								</small>
								<hr>
								<div class="col-md-12">
									<a href="?page=booking&ruangan=<?php echo $ruangan->get('name');?>" role="button" class="btn btn-primary btn-sm col-md-12">LIHAT DETAIL</a>
								</div>
							</div>
							</div>
				<?php
						}else{
							$kapasitas = explode("-",$_POST['kapasitas']);							
							if($kapasitas[0] <= $ruangan->get('kapasitas')['rata-rata'] AND $ruangan->get('kapasitas')['rata-rata'] <= $kapasitas[1]){								
				?>
								<div class="col-md-3" style="padding:5px;">
								<div class="panel panel-body" style="box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);padding: 10px;">
									<img src="<?php echo $ruangan->get('foto');?>" style="width:100%" alt="...">
									<center>
										<h6 style="margin:10px;margin-bottom:0px;font-weight:bold"><?php echo $ruangan->get('name');?></h6>
										<small style="padding-bottom:10px;">
											<center>
												<?php	
													$data = array('ql' => 'select * where ruangan='.$ruangan->get('uuid'));
													//reading data ruangan
													$reviews = $client->get_collection('reviews',$data);
													//do something with the data
													$reviewer = 0;
													$rating = 0;
													while ($reviews->has_next_entity()) {
														$review = $reviews->get_next_entity();
														$reviewer++;
														$rating = $rating+$review->get('rating');
													}
													$total_rating = $rating / $reviewer;
													for($r=1;$r<=$total_rating;$r++){
														echo'<font color="blue"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></font>';
													}
													for($rr=$r;$rr<=5;$rr++){
														echo'<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
													}
												?>									
											</center>
										</small>
									</center>
									<small>
										<table class="" style="font-size: small;">
											<tr>
												<td style="width:40%" class="text-bold">Kapasitas</td><td>: +- <?php echo $ruangan->get('kapasitas')['rata-rata'];?> orang</td>
											</tr>
											<tr>
												<td colspan="2" class="text-bold">Fasilitas Yang Tersedia :</td>
											</tr>
											<tr>
												<td colspan="2" style="padding-top: 0px;"><?php echo $ruangan->get('fasilitas');?></td>
											</tr>
										</table>				
									</small>
									<hr>
									<div class="col-md-12">
										<a href="?page=booking&ruangan=<?php echo $ruangan->get('name');?>" role="button" class="btn btn-primary btn-sm col-md-12">LIHAT DETAIL</a>
									</div>
								</div>
								</div>
				<?php
							}
						}
					}
				?>
					</div>
				</div>
				<?php
				}
			}
		?>
		</div>
		<?php
	}
	if(isset($_POST['cari_gedung'])){		
		$data = array('ql' => "select * where name='".$_POST['cari_gedung']."'");		
		//reading data gedung
		$kotas = $client->get_collection('kotas',$data);
		//do something with the data
		$exist = false;
		$option = "";
		while ($kotas->has_next_entity()) {
			$kota = $kotas->get_next_entity();
			$data = array('ql' => 'select * where kota='.$kota->get('uuid'));
			//reading data gedung
			$gedungs = $client->get_collection('gedungs',$data);
			//do something with the data
			while ($gedungs->has_next_entity()) {
				$gedung = $gedungs->get_next_entity();
				$selected = '';
				if($gedung->get('name') == $_SESSION['gedung']){
					$selected = "selected";
				}
				$option .= "<option value='".$gedung->get('name')."' ".$selected."> " .$gedung->get('name'). " </option>";
				$exist = true;
			}
		}
		if($exist){
			echo '<option value="all"> Semua Gedung </option>';
			echo $option;
		}else{
			echo "<option> Tidak ada gedung </option>";			
		}
	}
	if(isset($_POST['daftar_tamu'])){
		$_SESSION['daftar_tamu'] .= ",".$_POST['daftar_tamu']."?".$_POST['jabatan'];
		if(count($_SESSION['daftar_tamu']) > 0){
			echo "
				<table class='table table-bordered table-condensed'>
					<thead>
						<tr>
							<th><font size='1'>NAMA</font></th>
							<th><font size='1'>JABATAN</font></th>
							<th width='1%'><font size='1'></font></th>
						</tr>
					</thead>
					<tbody>
			";
				$daftar_tamu = explode(",",$_SESSION['daftar_tamu']);
				for($i=1;$i<count($daftar_tamu);$i++){
					$tamu = explode("?",$daftar_tamu[$i]);
					echo "
						<tr>
							<td><font size='2'>".$tamu[0]."</font></td>
							<td><font size='2'>".$tamu[1]."</font></td>
							<td><font size='1'><a title='Hapus Tamu' onclick=deleteTamu('".$tamu[0]."') >[HAPUS]</a></font></td>
						</tr>
					";				
				}
			echo "
					</tbody>
				</table>
			";
		}
	}
	if(isset($_POST['delete_tamu'])){
		$daftar_tamu = explode(",",$_SESSION['daftar_tamu']);
		unset($_SESSION['daftar_tamu']);
		for($i=1;$i<count($daftar_tamu);$i++){
			$tamu = explode("?",$daftar_tamu[$i]);
			if($tamu[0] != $_POST['delete_tamu']){
				$_SESSION['daftar_tamu'] .= ",".$tamu[0]."?".$tamu[1];				
			}
		}
		if(count($_SESSION['daftar_tamu']) > 0){
			echo "
				<table class='table table-bordered table-condensed'>
					<thead>
						<tr>
							<th style='width: 186px;'><font size='1'>NAMA</font></th>
							<th><font size='1'>JABATAN</font></th>
							<th width='1%'><font size='1'></font></th>
						</tr>
					</thead>
					<tbody>
			";
				$daftar_tamu = explode(",",$_SESSION['daftar_tamu']);
				for($i=1;$i<count($daftar_tamu);$i++){
					$tamu = explode("?",$daftar_tamu[$i]);
					echo "
						<tr>
							<td><font size='2'>".$tamu[0]."</font></td>
							<td><font size='2'>".$tamu[1]."</font></td>
							<td><font size='1' style='cursor:pointer;'><a title='Hapus Tamu' onclick=deleteTamu('".$tamu[0]."')>[HAPUS]</a></font></td>
						</tr>
					";				
				}
			echo "
					</tbody>
				</table>
			";
		}
	}
	if(isset($_POST['cari_waktu'])){		
		?>
		<thead>
			<tr>
				<th colspan="2">Ket : </th>
				<td style="background-color:#00964a"></td><td colspan="2">= Tersedia</td>
				<td style="background-color:#cc2b36"></td><td colspan="4">= Tidak Tersedia</td>
			</tr>
			<tr style="border-top:2px solid grey;">
				<th>#</th>
				<?php
				$startdate=str_replace("/","-",$_POST['cari_waktu']);
				
				$day =  date('l',strtotime("-1 day",strtotime($startdate)));										
				$tanggal = date('d/m/Y',strtotime("-1 day",strtotime($startdate)));
				switch($day){
					case "Sunday" : $day = strtoupper("Minggu");break;
					case "Monday" : $day = strtoupper("Senin");break;
					case "Tuesday" : $day = strtoupper("Selasa");break;
					case "Wednesday" : $day = strtoupper("Rabu");break;
					case "Thursday" : $day = strtoupper("Kamis");break;
					case "Friday" : $day = strtoupper("Jumat");break;
					case "Saturday" : $day = strtoupper("Sabtu");break;
				}
				
				echo "<th><small>$day<br><font size='1'>$tanggal</font></small></th>";
				for($i=0;$i<=7;$i++){
					$day =  date('l',strtotime("+$i day",strtotime($startdate)));										
					$tanggal = date('d/m/Y',strtotime("+$i day",strtotime($startdate)));
					switch($day){
						case "Sunday" : $day = strtoupper("Minggu");break;
						case "Monday" : $day = strtoupper("Senin");break;
						case "Tuesday" : $day = strtoupper("Selasa");break;
						case "Wednesday" : $day = strtoupper("Rabu");break;
						case "Thursday" : $day = strtoupper("Kamis");break;
						case "Friday" : $day = strtoupper("Jumat");break;
						case "Saturday" : $day = strtoupper("Sabtu");break;
					}
					echo "<th><small>$day<br><font size='1'>$tanggal</font></small></th>";
				}
				?>
			</tr>
			</thead>
			<tbody style="font-size:12px;">
				<?php
					for($i=8;$i<17;$i++){
						$row="";
						if(strlen($i) == 1){
							$jam = "0".$i;
							$jam_akhir = $i+1;
							if(strlen($jam_akhir) == 1){
								$jam_akhir = "0".$jam_akhir;
							}
						}else{
							$jam = $i;
							$jam_akhir = $i+1;
						}
						$row = "
						<tr>
							<th>$jam:00</th>";
							$tanggal = date('d/m/Y',strtotime("-1 day",strtotime($startdate)));																				
							
							$data = array('ql' => "select * where ruangan='".$_SESSION['ruanganUUID']."' AND tanggal='".$tanggal."' AND (jammulai<=".$i." AND jamselesai>=".($i+1).")");		
							//reading data ruangan
							$pinjams = $client->get_collection('pinjams',$data);
							//do something with the data
							if($pinjams->has_next_entity()){
								$pinjam = $pinjams->get_next_entity();
								$row .= "<td style='tidak tersedia'><small>".strtoupper($pinjam->get('name'))."</small></td>";														
							}else{
								$row .= "<td style='tersedia'></td>";														
							}
							
						for($x=0;$x<=7;$x++){
							$tanggal = date('d/m/Y',strtotime("+$x day",strtotime($startdate)));																				
							
							$data = array('ql' => "select * where ruangan='".$_SESSION['ruanganUUID']."' AND tanggal='".$tanggal."' AND (jammulai<=".$i." AND jamselesai>=".($i+1).")");		
							//reading data ruangan
							$pinjams = $client->get_collection('pinjams',$data);
							//do something with the data
							if($pinjams->has_next_entity()){
								$pinjam = $pinjams->get_next_entity();
								$row .= "<td style='tidak tersedia'><small>".strtoupper($pinjam->get('name'))."</small></td>";														
							}else{
								$row .= "<td style='tersedia'></td>";														
							}
							
						}
						$row = $row."</tr>";
						$row = str_replace("style='tersedia'","style='background-color:white;color:black; '",$row);
						$row = str_replace("style='tidak tersedia'","style='background-color:#cc2b36;color:white;vertical-align: middle;text-align: center;'",$row);
						echo $row."</tr>";
					}
					
				?>
			</tbody>
		<?php
	}
	?>

