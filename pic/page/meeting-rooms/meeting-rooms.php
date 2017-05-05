 <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Meeting Rooms</h3>
                        <p class="animated fadeInDown">
                          Manage Data Gedung <span class="fa-angle-right fa"></span> Meeting Rooms
                        </p>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading">
                      <?php 
                          if (isset($_REQUEST['gedung'])) {
                            echo '<h4>'.$_REQUEST['gedung'].'</h4>';
                          } else {
                            echo '<h4>Semua Gedung</h4>';
                          }
                      ?>
                    </div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nama Ruangan</th>
                          <th>PIC</th>
                          <th>Gedung</th>
                          <th>Fasilitas</th>
                          <th>Kapasitas (+-)</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if(isset($_GET['gedung'])){
                            $data = array('ql' => "select * where name='".$_GET['gedung']."'");
                            $gedungs = $client->get_collection('gedungs',$data);
                            //reading data kota
                            $gedung = $gedungs->get_next_entity();
                            $data = array('ql' => 'select * where gedung='.$gedung->get('uuid'));
                            //reading data ruangan
                            $ruangans = $client->get_collection('ruangans',$data);
                        } else {
                            $ruangans = $client->get_collection('ruangans');
                        }
                            //do something with the data
                            while ($ruangans->has_next_entity()) {
                              $ruangan = $ruangans->get_next_entity();
                              echo '<tr>
                                      <td>'.ucfirst($ruangan->get('name')).'</td>
                                      <td>'.ucfirst($ruangan->get('pic')).'</td>
                                      <td>'.ucfirst($ruangan->get('name')).'</td>
                                      <td>'.ucfirst($ruangan->get('fasilitas')).'</td>
                                      <td>'.$ruangan->get('kapasitas')['rata-rata'].'</td>
                                      <td width="17%">
                                          <a href="?page=meeting-rooms&ruangan='.$ruangan->get('name').'" class=" btn btn-raised btn-primary" value="primary">Edit Ruangan</a>
                                    </tr>';
                            }
                      ?>
                      </tbody>
                        </table>
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
            });
          </script>