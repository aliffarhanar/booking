 <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Data Gedung</h3>
                        <p class="animated fadeInDown">
                          Manage <span class="fa-angle-right fa"></span> Data Gedung
                        </p>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Kota</th>
                          <th>Alamat</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        //reading data kota
                        $kotas = $client->get_collection('kotas');
                        //do something with the data
                        while ($kotas->has_next_entity()) {
                              $kota = $kotas->get_next_entity();
                              $data = array('ql' => 'select * where kota='.$kota->get('uuid'));
                              //reading data gedung
                              $gedungs = $client->get_collection('gedungs',$data);
                              while ($gedungs->has_next_entity()) {
                                  $gedung = $gedungs->get_next_entity();
                                  $data = array('ql' => 'select * where gedung='.$gedung->get('uuid'));
                                  //reading data ruangan
                                  $ruangans = $client->get_collection('ruangans');
                                  echo '<tr>
                                          <td>'.ucfirst($gedung->get('name')).'</td>
                                          <td>'.ucfirst($kota->get('name')).'</td>
                                          <td>'.ucfirst($gedung->get('alamat')).'</td>
                                          <td width="17%">
                                              <a href="?page=meeting-rooms&gedung='.$gedung->get('name').'" class=" btn btn-raised btn-primary" value="primary">Lihat Ruangan</a>
                                        </tr>';
                              }
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