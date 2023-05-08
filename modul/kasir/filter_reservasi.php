  <?php
    error_reporting(0);
    ?>
  <div class="col-md-12">
      <?php
        $id = base64_decode($_GET["id"]);
        $sqlku = mysqli_query($konek, "select * FROM header_reservasi where kode='$id'");
        $data  = mysqli_fetch_array($sqlku);
        ?>
      <div class="box">

          <div class="box-header">
              <h4> Daftar Pesanan : <?php echo $data['nama_pelanggan']; ?></H4>
              <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>NAMA MENU</th>
                              <th>JUMLAH</th>
                              <th>HARGA</th>
                              <th>SUB TOTAL</th>

                          </tr>
                      </thead>
                      <tbody>


                          <?php

                            $qry = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori`,`header_pesanan`.`kode_reservasi` AS `kode_reservasi`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`total` AS `total` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where  kode_reservasi LIKE '%$id%'");
                            while ($data = mysqli_fetch_array($qry)) {
                                $jumlah = $data['jumlah'];
                                $harga = $data['harga'];
                                $hasil = $harga * $jumlah;
                                $gred_total += $hasil;
                                $diskon = $gred_total * 0.1
                                ?>
                          <tr>

                              <td><?php echo $data['nama']; ?></td>
                              <td><?php echo $data['jumlah']; ?></td>
                              <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
                              <td>Rp. <?php echo (number_format($hasil)); ?></td>

                          </tr>

                          <?php } ?>

                          </tfoot>
                  </table>
              </div>
          </div>
      </div>
  </div>


  <div class="col-md-12">
      <div class="box box-success">
          <form class="form-horizontal" method="POST" action="">
              <div class="modal-body">
                  <div class="form-group">
                      <!-- <td><input value="<?php echo $data['id_pesanan']; ?>" name="id_pesanan"></td> -->

                      <label for="inputEmail3" class="col-sm-2 control-label">Total</label>
                      <div class="col-sm-3">
                          <input type="number" class="form-control" id="meja" name="txttotal" onchange="kali()" value="<?php echo ($gred_total); ?>" placeholder="Total" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" readonly value="" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Diskon</label>
                      <div class="col-sm-3">
                          <input type="number" value="<?php echo ($diskon); ?>" class="form-control" id="meja" name="txtbayar" onchange="kali()" placeholder="Uang Muka" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                      </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <a href="beranda.php?page=daftar_reservasi" button class="btn btn-danger pull-left" data-dismiss="modal"> Batal</button></a>
                  <input type="submit" name="btnedit" class="btn btn-primary pull-left" value="Lanjutkan">
              </div>


          </form>
          <?php
            if (isset($_POST["btnedit"])) {
                $txttotal = mysqli_real_escape_string($konek, $_POST['txttotal']);
                $txtbayar = mysqli_real_escape_string($konek, $_POST['txtbayar']);
                $id_pesanan = mysqli_real_escape_string($konek, $_POST['id_pesanan']);

                $edit = mysqli_query($konek, "UPDATE  header_reservasi SET total='$txttotal',dp='$txtbayar',status='Selesai' WHERE kode='$id'");

                $edit_pesanan = mysqli_query($konek, "UPDATE  header_pesanan SET total='$txttotal',uang_muka='$txtbayar' WHERE kode_reservasi='$id'");

                // $edit_detail = mysqli_query($konek, "UPDATE  detail_pesanan SET status='Reservasi' WHERE id_pesanan='$id_pesanan'");


                if ($edit) {
                    ?>
          <script type="text/javascript">
              document.location.href = "beranda.php?page=daftar_reservasi";
          </script>
          <?php
                } else {
                    echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
                    echo "<meta http-equiv='refresh' content='0; url=?page=reservasi'>";
                }
            }
            ?>
      </div>
  </div>
  </div>