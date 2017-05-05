	<script type="text/javascript">
		function changeFilter(){
			var lokasi = document.getElementById("lokasi").value;
			var lokasi_gedung = document.getElementById("lokasi_gedung").value;
			var kapasitas = document.getElementById("kapasitas").value;
			var tanggal = document.getElementById("tanggal").value;
			var jam_mulai = document.getElementById("jam_mulai").value;
			var jam_selesai = document.getElementById("jam_selesai").value;
			var konsumsi = document.getElementById("konsumsi").value;
			submitForm("&lokasi="+lokasi+"&lokasi_gedung="+lokasi_gedung+"&kapasitas="+kapasitas+"&tanggal="+tanggal+"&jam_mulai="+jam_mulai+"&jam_selesai="+jam_selesai+"&konsumsi="+konsumsi);
			searchGedung(document.getElementById("lokasi").value);
		}
		function submitForm(data_post){
			var dataString = 'cari=1'+data_post;
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById("list_ruangan").innerHTML = html;				
				}
			});
		}
		function searchGedung(data_post){
			var dataString = 'cari_gedung='+data_post;
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: dataString,
				cache: false,
				success: function(html) {
					document.getElementById("lokasi_gedung").innerHTML = html;				
				}
			});
		}
	</script>
<div class="row">
	<div class="col-md-3" style="margin-left:3%;padding:0px">		
		<div class="col-md-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Kebutuhan Ruangan :</div>
				<div class="panel-body">
					<form class="form-vertical" id="form_cari" action="" method="post">
						<div class="form-group form-group-sm">
							<label class="form-label">Lokasi Kota :</label>
							<select class="form-control" onChange="changeFilter()" name="lokasi" id="lokasi">
								<option value="all"> Semua Kota </option>
								<?php
									//reading data
									$kotas = $client->get_collection('kotas');
									//do something with the data
									while ($kotas->has_next_entity()) {
										$kota = $kotas->get_next_entity();
										$title = $kota->get('name');
										echo "<option value='".$kota->get('name')."'> " . $title . " </option>";
									}
								?>
							</select>
						</div>
						<div class="form-group form-group-sm">
							<label class="form-label">Gedung :</label>
							<select class="form-control" onChange="changeFilter()" name="lokasi_gedung" id="lokasi_gedung">
								<option value="all"> Semua Gedung </option>
							</select>
						</div>
						<div class=" form-group form-group-sm">
							<label class="form-label">Kapasitas Ruangan :</label>
							<select class="form-control" onChange="changeFilter()" name="kapasitas" id="kapasitas">
								<option value="all"> Semua Kapasitas </option>
								<option value="5-10"> 5-10 orang </option>
								<option value="11-20"> 11-20 orang </option>
								<option value="21-30"> 21-30 orang </option>
								<option value="31-40"> 31-40 orang </option>
								<option value="40-9999"> >40 orang </option>
							</select>
						</div>
						<div style="display:none;">
						<div class=" form-group form-group-sm">
							<input type="checkbox" class="" name="atur_tanggal" onClick="setting_datetime(this)" > Atur Tanggal & Waktu
							<div class="col-md-12" id="setting_datetime" style="border : 1px solid #c3c3c3;padding:10px;display:none;">
								<div class=" form-group form-group-sm">
									<label class="form-label">Tanggal Pakai:</label>
									<div class='input-group date' id='datepicker' >
										<input type='text' class="form-control" onChange="changeFilter()" name="tanggal" id="tanggal"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<div class=" form-group form-group-sm">
									<label class="form-label">Jam Pakai :</label>
									<div class="col-md-12" style="padding:0px">
										<div class="col-md-5" style="padding:0px">
											<select class="form-control" onChange="changeFilter()" name="jam_mulai" id="jam_mulai">
												<?php
													for($i=8;$i<=17;$i++){
														echo"<option> ".sprintf('%02d', $i).":00 </option>";
													}
												?>							
											</select>
										</div>
										<div class="col-md-2" style="padding-top:4%">
											<small style="margin-left: -5px;">s/d</small>
										</div>
										<div class="col-md-5" style="padding:0px">
											<select class="form-control" name="jam_selesai" id="jam_selesai" onChange="changeFilter()">
												<?php
													for($i=8;$i<=17;$i++){
														echo"<option> ".sprintf('%02d', $i).":00 </option>";
													}
												?>							
											</select>
										</div>
									</div>
								</div>
							<br>
							</div>
						</div>
						</div>
						<div class=" form-group form-group-sm">
							<label class="form-label">Snack/Konsumsi :</label>
							<div class="col-md-12">
								<input type="checkbox" class="" onChange="changeFilter()" name="konsumsi" id="konsumsi"> Bisa pesan
							</div>
						</div>
						<input type="hidden" name="cari" value="cari"/>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="col-md-12">
			<div class=" panel panel-body">			
				<div class="form-inline">
				  <div class="form-group form-group-sm pull-right">
					<label><b>Sort by </b></label>
					<select class="form-control" name="lokasi">
						<option> Kapasitas Kecil-Besar </option>
						<option> Kapasitas Besar-Kecil </option>
						<option> Harga Kecil-Besar </option>
						<option> Harga Besar-Kecil </option>
					</select>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8" id="list_ruangan">
		<div class="col-md-12">	
		<?php
			//reading data kota
			$kotas = $client->get_collection('kotas');
			//do something with the data
			while ($kotas->has_next_entity()) {
				$kota = $kotas->get_next_entity();
				$title = $kota->get('name');
				$data = array('ql' => 'select * where kota='.$kota->get('uuid'));
				//reading data gedung
				$gedungs = $client->get_collection('gedungs',$data);
				//do something with the data
				while ($gedungs->has_next_entity()) {
					$gedung = $gedungs->get_next_entity();
				?>
				<div class="panel panel-primary">
					<div class="panel-heading"><?php echo strtoupper($gedung->get('name'));?></div>
					<div class="panel-body">
					<section class="pinBoot">
				<?php	
					$data = array('ql' => 'select * where gedung='.$gedung->get('uuid'));
					//reading data ruangan
					$ruangans = $client->get_collection('ruangans',$data);
					//do something with the data
					while ($ruangans->has_next_entity()) {
						$ruangan = $ruangans->get_next_entity();
				?>
						<div class="white-panel">
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
				<?php
					}
				?>
					</section>
					</div>
				</div>
				<?php
				}
			}
		?>
		</div>
	</div>
</div>
  <script src="js/pinterest.js"></script>
<style>
.pinBoot{
  position: relative;
  max-width: 100%;
  width: 100%;
}
img {
  width: 100%;
  max-width: 100%;
  height: auto;
}
.white-panel {
  position: absolute;
  background: white;
  box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
  padding: 10px;
}
/*
stylize any heading tags withing white-panel below
*/

.white-panel h1 {
  font-size: 1em;
}
.white-panel h1 a {
  color: #A92733;
}
.white-panel:hover {
  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
<!--  margin-top: -5px; -->
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
</style>
