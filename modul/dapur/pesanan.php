  <?php
    error_reporting(0);
    ?>

  <section class="content-header">
      <div class="callout callout-warning">
          <center>
              <h4>DAFTAR PESANAN</h4>
          </center>
      </div>
  </section>

  <div class="col-md-9">
      <div class="box">
          <div class="box-body table-responsive">
              <table id="example3" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>NO</th>
                          <th>NAMA MENU</th>
                          <th>JUMLAH</th>
                          <th>NO MEJA</th>
                          <th>TANGGAL</th>
                          <th>KETERANGAN</th>
                          <th>AKSI</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php

                        // $hari_ini = date(NOW());
                        $no = 1;
                        date_default_timezone_set('Asia/Jakarta');
                        $hari_ini = date("Y-m-d");
                        $select = mysqli_query($konek, "SELECT * FROM v_pesanan_dapur WHERE (tanggal BETWEEN '$hari_ini' AND '$hari_ini')");
                        if (mysqli_num_rows($select)) {


                            while ($data = mysqli_fetch_array($select)) {
                                ?>
                      <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td>
                              <center><?php echo (number_format($data['jumlah'])); ?><center>
                          </td>
                          <td><?php echo $data['kode_meja']; ?></td>
                          <td><?php echo $data['tanggal']; ?></td>
                          <td><?php echo $data['keterangan']; ?></td>
                          <td align="right">
                              <a onClick="return confirm('Apakah Sudah Selesai.?')" href="beranda.php?page=pesanan_dapur&selesai=<?php echo $data['kode']; ?>" class="fa fa-hand-stop-o btn btn-danger"> Selesai</a>
                          </td>


                      </tr>
                      <?php }
                        } ?>
                      </tfoot>

              </table>
          </div>
      </div>
  </div>

  <div class="col-md-3">
      <div class="box">
          <div class="box-body table-responsive">
              <table id="example3" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>NAMA MENU</th>
                          <th>TOTAL PESANAN</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $tanggal_hari_ini = date("Y-m-d");
                        $select = mysqli_query($konek, "select * from v_jumlah_pesanan where (tanggal BETWEEN '$tanggal_hari_ini' AND '$tanggal_hari_ini')");
                        if (mysqli_num_rows($select)) {
                            while ($data = mysqli_fetch_array($select)) {
                                $gren += $data['total'];
                                ?>
                      <tr>

                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['total']; ?></td>


                      </tr>
                      <?php }
                        } ?>
                      </tfoot>
                      <tr>
                          <TD> Total Pesanan
                          </TD>
                          <TD>
                              <?php echo number_format($gren); ?>
                          </TD>
                      </tr>
              </table>


          </div>
      </div>
  </div>


  </div>

  </section>


  <?php
    if (isset($_GET[selesai])) {
        $qry = mysqli_query($konek, "UPDATE  detail_pesanan SET status='Selesai' where kode='" . $_GET["selesai"] . "'");
        if ($qry) {
            echo "<script>alert('Data Berhasil diupdate')</script>";
            echo "<meta http-equiv='refresh' content='0; url=?page=pesanan_dapur'>";
        } else {
            echo "Gagal di selesai";
            echo "<meta http-equiv='refresh' content='0; url=?page=pesanan_dapur'>";
        }
    }
    ?>