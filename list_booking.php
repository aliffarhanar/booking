<div class="row">
	<div class="col-md-12">
		<div class="panel panel-body">
			<div class="col-md-12">
			<?php
				if(isset($_GET['delete'])){
					 $endpoint = 'pinjams/'.$_GET['delete'];
					 $query_string = array();
					 $result =  $client->delete($endpoint, $query_string);
					 if ($result->get_error()){
						echo "
							<div class='alert alert-warning'>
								Gagal menghapus data peminjaman/penyewaan ruangan.
							</div>
						";
					 } else {
						echo "
							<div class='alert alert-success'>
								Berhasil menghapus data peminjaman/penyewaan ruangan.
							</div>
						";
					 }
				}
			?>
			<h4>Riwayat Peminjaman Ruangan</h4>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-condensed" style="font-size:1em;" >
					<thead>
						<tr>
							<th width="2%">NO</th>
							<th >NAMA RAPAT</th>
							<th >WAKTU PEMINJAMAN</th>
							<th >JUMLAH</th>
							<th >TAMU KHUSUS</th>
							<th >LOKASI RUANGAN</th>
							<th  width="5%">BIAYA</th>
							<th >PEMBAYARAN</th>
							<th >DATA MAKANAN</th>
							<th >DATA MINUMAN</th>
							<th >FASILITAS TAMBAHAN</th>
							<th >PIC RUANGAN</th>
							<th width="7%">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$data = array('ql' => "select * where user='".$_SESSION['uuid']."'");		
							//reading data ruangan
							$pinjams = $client->get_collection('pinjams',$data);
							//do something with the data
							while ($pinjams->has_next_entity()) {							
								$pinjam = $pinjams->get_next_entity();
								
								$data_ruangan = array('ql' => "select * where uuid='".$pinjam->get('ruangan')."'");		
								$ruangans = $client->get_collection('ruangans',$data_ruangan);
								$ruangan = $ruangans->get_next_entity();
								
								$data_gedung = array('ql' => "select * where uuid='".$ruangan->get('gedung')."'");		
								$gedungs = $client->get_collection('gedungs',$data_gedung);
								$gedung = $gedungs->get_next_entity();
								
								$data_kota = array('ql' => "select * where uuid='".$gedung->get('kota')."'");		
								$kotas = $client->get_collection('kotas',$data_kota);
								$kota = $kotas->get_next_entity();
								$makanan = '';
								$daftar_makanan = explode(",",$pinjam->get('makanan'));
								for($i=0;$i<count($daftar_makanan);$i++){
									$m = explode(":",$daftar_makanan[$i]);									
									$makanan = $m[0]."(".$m[1]." porsi),";		
								}
								$minuman = '';
								$daftar_minuman = explode(",",$pinjam->get('minuman'));
								for($i=0;$i<count($daftar_minuman);$i++){
									$m = explode(":",$daftar_minuman[$i]);									
									$minuman = $m[0]."(".$m[1]." pcs),";		
								}
								$tamu = '';
								$daftar_tamu = explode(",",$pinjam->get('tamu'));
								for($i=0;$i<count($daftar_tamu);$i++){
									$m = explode("?",$daftar_tamu[$i]);									
									$tamu = $m[0]."(".$m[1]."),";		
								}
						?>
								<tr>
									<td align="center"><?php echo $no; ?></td>
									<td><?php echo $pinjam->get('name'); ?></td>
									<td><?php echo $pinjam->get('tanggal'); ?><br> Jam <?php echo $pinjam->get('jammulai'); ?> s/d <?php echo $pinjam->get('jamselesai'); ?></td>
									<td><?php echo $pinjam->get('jumlah'); ?> orang</td>
									<td><?php echo $tamu; ?></td>
									<td>
										<?php echo $kota->get('name').", ".$gedung->get('name').", ".$ruangan->get('name'); ?>
									</td>
									<td align="right">Rp <?php echo $pinjam->get('harga'); ?> ;-</td>
									<td><?php echo $pinjam->get('pembayaran'); ?></td>
									<td>
										<?php echo $makanan."<br>"; ?>
										*<?php echo $pinjam->get('keteranganmakanan'); ?>
									</td>
									<td>
										<?php echo $minuman."<br>"; ?>
										*<?php echo $pinjam->get('keteranganminuman'); ?>
									</td>
									<td><?php echo $pinjam->get('fasilitastambahan'); ?></td>
									<td><?php echo $ruangan->get('pic'); ?></td>
									<td>
										<a href="?page=edit-booking&rapat=<?php echo $pinjam->get('name'); ?>" ><button class="btn btn-info btn-sm" title="Ubah Detail Peminjaman"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a>
										<a href="?page=riwayat-booking&delete=<?php echo $pinjam->get('name'); ?>" onClick="confirm('Anda yakin ingin menghapus data pemesanan/peminjaman ruangan ini ?')"><button class="btn btn-danger btn-sm" title="Batalkan Peminjaman Ruangan"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
										<!-- <a href="?page=riwayat-booking&delete=" data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete"><button class="btn btn-danger btn-sm" title="Batalkan Peminjaman Ruangan"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a> -->
									</td>
								</tr>
						<?php
							$no++;
							}
						?>
					</tbody>
				</table>
			</div>
			</div>			
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Konfirmasi Penghapusan Data</strong>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data pemesanan/peminjaman ruangan ini ?<br>
				<font color="red">Data yang sudah dihapus tidak dapat dikembalikan lagi.</font>
            </div>
            <div class="modal-footer">
				<div class="col-md-9 col-xs-9">
					<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
				</div>
				<div class="col-md-2 col-xs-2">
						<a class="btn btn-danger btn-ok">Ya, Saya Yakin</a>
					<form action="" method="post">
					</form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));		
		});
</script>