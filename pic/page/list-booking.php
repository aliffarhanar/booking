<!-- start: content -->
            <div id="content">
                <div class="panel">
                  <div class="panel-body">
                      <div class="col-md-6 col-sm-12">
                        <h2 class="animated fadeInLeft"> List Booking</h2>
                        <p class="animated fadeInDown"><span class="fa  fa-map-marker"></span> Bandung,Indonesia</p>
                    </div>
                  </div>                    
                </div>

                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-12 padding-0">
                             <div class="col-md-12 padding-0">
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Today</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-clock icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-left">
                                        <ol>
                                        <?php 
                                          $data = array('ql' => "select * where tanggal=NOW()");
                                          //reading data ruangan
                                          $pinjams = $client->get_collection('pinjams',$data);
                                          $no=0;
                                          while ($pinjams->has_next_entity()) {             
                                              $no++;
                                              $pinjam = $pinjams->get_next_entity();
                                              echo '<li>'.$pinjam->get('name').'</li>';
                                          }
                                          if ($no==0) echo 'Tidak ada data hari ini';
                                        ?>
                                        </ol>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Tomorrow</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-plane icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-left">
                                        <ol>
                                        <?php 
                                          $data = array('ql' => "select * where tanggal=NOW()");
                                          //reading data ruangan
                                          $no=0;
                                          $pinjams = $client->get_collection('pinjams',$data);
                                          while ($pinjams->has_next_entity()) {             
                                              $no++;
                                              $pinjam = $pinjams->get_next_entity();
                                              echo '<li>'.$pinjam->get('name').'</li>';
                                          }
                                          if ($no==0) echo 'Tidak ada data untuk besok';
                                        ?>
                                        </ol>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                              <div class="panel-heading">
                                <h4>Need Approval</h4>
                              </div>
                              <div class="panel-body">
                                <div class="col-md-12 responsive-table">
                                    <table class="table table-hover">
                                      <tbody><tr>
                                        <th>No</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                      </tr>
                                      <ol>
                                        <?php
                                          //reading data ruangan
                                          $pinjams = $client->get_collection('pinjams');
                                          $no=1;
                                          while ($pinjams->has_next_entity()) {             
                                              $pinjam = $pinjams->get_next_entity();
                                              echo '<tr>
                                                      <td>'.$no.'</td>
                                                      <td>'.$pinjam->get('name').'</td>
                                                      <td>
                                                        <span class="label label-primary">'.$pinjam->get('tanggal').'</span>
                                                      </td>
                                                      <td>
                                                        <div class="btn-group" role="group">
                                                          <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                            <span class="icon-arrow-down icons"></span>
                                                          </button>
                                                          <ul class="dropdown-menu">
                                                            <li><a href="#">Confirm</a></li>
                                                            <li><a href="#">Ignore</a></li>
                                                          </ul>
                                                        </div>
                                                      </td>
                                                    </tr>';
                                                    $no++;
                                          }
                                        ?>
                                        </ol>
                                    </tbody></table>
                                    <center>
                                      <div class="btn-group" role="group" aria-label="..." style="margin-top:20px;">
                                              <button type="button" class="btn">
                                                <span class="icon-arrow-left icons"></span>
                                              </button>
                                              <button type="button" class="btn active">1</button>
                                              <button type="button" class="btn">2</button>
                                              <button type="button" class="btn">
                                                <span class="icon-arrow-right icons"></span>
                                              </button>
                                            </div>
                                    </center>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
      		  </div>
          <!-- end: content -->

          <?php include "inc/footer.php";?>
          