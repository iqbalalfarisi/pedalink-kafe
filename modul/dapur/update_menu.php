  <?php
    error_reporting(0);
    ?>

  </div>
  <div class="box">
      <div class="box-header with-border">
          <center>
              <h3 class="box-title">UPDATE MENU</h3>
          </center>
      </div>
      <div class="box-body table-responsive">
          <!-- <a class="box-body table-responsive no-padding"> -->
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>NO</th>
                      <th width="30%">NAMA</th>
                      <th>KATEGORI</th>
                      <th>HARGA</th>
                      <th width="10%">GAMBAR</th>
                      <th width="18%">ACTION</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;

                    $qry = mysqli_query($konek, "select `menu`.`kode` AS `kode`,`menu`.`kode_kategori` AS `kode_kategori`,`menu`.`nama` AS `nama`,`menu`.`harga` AS `harga`,`menu`.`deskripsi` AS `deskripsi`,`menu`.`gambar` AS `gambar`,`menu`.`tanggal` AS `tanggal`,`menu`.`jumlah_pesan` AS `jumlah_pesan`,`kategori`.`uraian` AS `kategori`,`menu`.`status` AS `status` from (`kategori` join `menu` on((`kategori`.`kode` = `menu`.`kode_kategori`))) order by `menu`.`kode` desc");
                    while ($data = mysqli_fetch_array($qry)) {
                        ?>
                      <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['kategori']; ?></td>
                          <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
                          <td><img src="gambar/barang/<?php echo $data['gambar']; ?>" width="80px;" hight="100px;">
                          </td>
                          <td>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><?php echo $data['status']; ?>
                                      <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">

                                      <li><a onClick="return confirm('Apakah Menu di Aktifkan')" href="beranda.php?page=update_menu&aktif=<?php echo $data['kode']; ?>" class="fa fa-send btn btn-primary"> Aktif </a></li> <br>


                                      <li><a onClick="return confirm('Apakah Menu di NonAktifkan')" href="beranda.php?page=update_menu&tidak_aktif=<?php echo $data['kode']; ?>" class="fa fa-send btn btn-warning"> NonAktif </a></li>
                                  </ul>
                              </div>

                      </tr>

                  <?php } ?>
                  </tfoot>
          </table>
          <center> <a href="beranda.php?page=pesanan_dapur" button class="btn btn-primary">SELESAI</button></a>
          </center>
      </div>
      </section>


      <?php
        if (isset($_GET[aktif])) {
            $qry = mysqli_query($konek, "UPDATE  menu SET status='Aktif' where kode='" . $_GET["aktif"] . "'");
            if ($qry) {
                echo "<script>alert('Data Berhasil diupdate')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=update_menu'>";
            } else {
                echo "Gagal di aktif";
                echo "<meta http-equiv='refresh' content='0; url=?page=update_menu'>";
            }
        }
        ?>



      <?php
        if (isset($_GET[tidak_aktif])) {
            $qry = mysqli_query($konek, "UPDATE  menu SET status='NonAktif' where kode='" . $_GET["tidak_aktif"] . "'");
            if ($qry) {
                echo "<script>alert('Data Berhasil diupdate')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=update_menu'>";
            } else {
                echo "Gagal di tidak_aktif";
                echo "<meta http-equiv='refresh' content='0; url=?page=update_menu'>";
            }
        }
        ?>