  <?php
  error_reporting(0);
  ?>

  <section class="content-header">
    <div class="callout callout-warning">
      <center>
        <h4>PESANAN</h4>
      </center>
    </div>
  </section>
  </div>
  <div class="box">
    <div class="box-header">
      <!-- <form class="form-inline" role="form" method="post" action="">
        <div class="form-group">
          <select name="cbpesanan" class="form-control select2" style="width: 100%;">
            <?php
            $qry = mysqli_query($konek, "select `header_pesanan`.`kode` AS `kode`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status`,`header_pesanan`.`total` AS `total`,`pengguna`.`nama_pengguna` AS `nama_pengguna` from (`header_pesanan` join `pengguna` on((`pengguna`.`kode` = `header_pesanan`.`id_pengguna`))) where (`header_pesanan`.`status` = 'Proses')");
            while ($d = mysqli_fetch_array($qry)) { ?>
            <option class="form-control" value="<?php echo $d["kode"]; ?>"> No Meja : <?php echo $d['kode_meja']; ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-danger">Filter Pesanan</button>
      </form> -->



    </div>
    <div class="box-body table-responsive">
      <table id="example3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>NAMA MENU</th>
            <th>KATEGORI</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>SUB TOTAL</th>
            <th>KETERANGAN</th>
            <th></th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          if (isset($_REQUEST['submit'])) {
            $submit = $_REQUEST['submit'];
            $cbpesanan = $_REQUEST['cbpesanan'];
            $select = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where ((`detail_pesanan`.`status` = 'Proses') or (`detail_pesanan`.`status` = '1')) WHERE  id_pesanan LIKE '%$cbpesanan%'");
          } else {
            $select = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where ((`detail_pesanan`.`status` = 'Proses') or (`detail_pesanan`.`status` = '1')) order by kode desc limit 10");
          }

          if (mysqli_num_rows($select)) {
            while ($data = mysqli_fetch_array($select)) {
              $jumlah = $data['jumlah'];
              $harga = $data['harga'];
              $hasil = $harga * $jumlah;

              ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['kategori']; ?></td>
            <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
            <td>
              <center><?php echo (number_format($data['jumlah'])); ?><center>
            </td>
            <td>Rp. <?php echo (number_format($hasil)); ?> </td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
              <a href="beranda.php?page=edit_pesanan&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-send btn btn-success"> Edit</a></td>


            <td align="right">
              <a onClick="return confirm('Data ini akan di hapus.?')" href="beranda.php?page=keranjang&hapus=<?php echo $data['kode']; ?>" class="fa fa-trash btn btn-danger"> Hapus</a>
            </td>


          </tr>
          <?php }
          } ?>
          </tfoot>
      </table>
    </div>
  </div>
  </section>

  <?php
  if (isset($_GET[hapus])) {
    $qry = mysqli_query($konek, "DELETE from detail_pesanan where kode='" . $_GET["hapus"] . "'");
    if ($qry) {
      echo "<script>alert('Data Berhasil di Hapus')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=keranjang'>";
    } else {
      echo "Gagal di Hapus";
      echo "<meta http-equiv='refresh' content='0; url=?page=keranjang'>";
    }
  }
  ?>