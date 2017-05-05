 <?php 
    $data = array('ql' => "select * where name='".$_GET['ruangan']."'");
    //reading data ruangan
    $ruangans = $client->get_collection('ruangans',$data);
    //do something with the data
    $ruangan = $ruangans->get_next_entity();

 ?>
 <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft"><?=$_REQUEST['ruangan']?></h3>
                        <p class="animated fadeInDown">
                          Manage Data Gedung <span class="fa-angle-right fa"></span> 
                          Meeting Rooms <span class="fa-angle-right fa"></span>
                          Detail Ruangan
                        </p>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-sm-3 product-grid">
                      <div class="col-md-12 product-location">
                          <span class="pull-right"><span class="fa-map-marker fa"></span> <?php echo ucfirst($ruangan->get('kota')); ?></span>
                      </div>
                      <div class="thumbnail">
                        <img src="<?php echo $ruangan->get('foto'); ?>" data-src="holder.js/500x250" data-holder-rendered="true" style="width: 500px; height: 250px;">
                        <div class="caption">
                          <small class="pull-right">
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
                                  echo'<span class="rate fa-star fa"></span>';
                                }
                            ?>                  
                          </small>
                          <h4><?=$ruangan->get('name')?></h4>
                          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis.</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading">
                      <h4>Edit Ruangan</h4>
                    </div>
                    <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                      <div class="col-md-12">
                        <form class="cmxform" id="signupForm" method="get" action="" novalidate="novalidate">
                          <div class="col-md-12">
                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                              <input type="text" class="form-text" id="validate_firstname" value="<?=$ruangan->get('name')?>" name="validate_firstname" required="" aria-required="true">
                              <span class="bar"></span>
                              <label>Nama Ruangan</label>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                              <select class="select2-A form-text" multiple="multiple">
                                <optgroup label="Recent">
                                  <option value="Meja">Meja</option>
                                  <option value="Kursi">Kursi</option>
                                  <option value="Proyektor">Proyektor</option>
                                </optgroup>
                              </select>
                            </div>

                            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                              <select class="select2-B form-text">
                                <?php
                                    //reading data kota
                                    $kotas = $client->get_collection('kotas');
                                    //do something with the data
                                    while ($kotas->has_next_entity()) {                                      
                                        $kota = $kotas->get_next_entity();
                                        $data = array('ql' => 'select * where kota='.$kota->get('uuid'));
                                        echo '<optgroup label="'.ucfirst($kota->get('name')).'">';
                                        //reading data gedung
                                        $gedungs = $client->get_collection('gedungs',$data);
                                        while ($gedungs->has_next_entity()) {
                                            $gedung = $gedungs->get_next_entity();
                                            $data = array('ql' => 'select * where gedung='.$gedung->get('uuid'));
                                            //reading data ruangan
                                            $ruangans = $client->get_collection('ruangans');
                                            echo '<option value="'.ucfirst($gedung->get('name')).'">'.ucfirst($gedung->get('name')).'</option>';
                                       }
                                       echo '</optgroup>';
                                    }
                                  ?>
                              </select>
                            </div>
                          </div>
                 
                          <div class="col-md-12">
                              <input class="submit btn btn-danger" type="submit" value="Simpan Perubahan">
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
                    </div>
                  </div>
              </div>
              </div>  
              </div>
            </div>
          <!-- end: content -->

          <?php include "inc/footer.php";?>
          <script type="text/javascript">
            $(document).ready(function(){
               $('#datatables-example').DataTable();
               $(".select2-A").select2({
                  placeholder: "Pilih Fasilitas",
                  allowClear: true
                });
               $(".select2-B").select2({
                  placeholder: "Pilih Gedung",
                  allowClear: true
                });
            });
          </script>