 <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Menunggu Persetujuan</h3>
                        <p class="animated fadeInDown">
                          Jadwal <span class="fa-angle-right fa"></span> Approval Queue
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
                          <tr>
                              <th>No</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
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
                                        '.$pinjam->get('tanggal').'
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