  <?php
  error_reporting(0);
  ?>

  <section class="content-header">
    <div class="callout callout-warning">
      <center>
        <h4>DETAIL PESANAN</h4>
      </center>
    </div>
  </section>
  </div>
  <div class="box">

    <div class="box-body table-responsive">
      <table id="example3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>NAMA MENU</th>
            <th>JUMLAH</th>
            <th>NO MEJA</th>
            <th>KETEGORI</th>
            <th>KETERANGAN</th>
            <th>STATUS</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $select = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori`,`header_pesanan`.`kode_meja` AS `kode_meja` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where ((`detail_pesanan`.`status` = 'Proses') or (`detail_pesanan`.`status` = 'Selesai') or (`detail_pesanan`.`status` = '1')) order by `detail_pesanan`.`kode` desc");

          if (mysqli_num_rows($select)) {
            while ($data = mysqli_fetch_array($select)) {
               if ($data['status']=='1') {
                  $proses='Sedang di Proses di Dapur';
                  }elseif($data['status']=='Selesai') {
                  $proses='Siap Dari Dapur';
                  }elseif($data['status']=='Proses') {
                  $proses='Sedang di Proses di Dapur';
                }
              ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td>
              <center><?php echo (number_format($data['jumlah'])); ?><center>
            </td>
            <td><?php echo $data['kode_meja']; ?></td>
            <td><?php echo $data['kategori']; ?></td>
            <td><?php echo $data['keterangan']; ?></td>
            <td>
            
              <button type="button" class="btn btn-block btn-danger btn-xs"> <?php echo $proses; ?></button>
            </td>
            <td align="right">
              
              <a onClick="return confirm('Apakah Sudah Selesai di Hidangkan.?')" href="beranda.php?page=detail_pesanan&hapus=<?php echo $data['kode']; ?>" class="fa fa-bell btn btn-success"> Dihidangkan</a>


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
    $qry = mysqli_query($konek, "UPDATE  detail_pesanan SET status='Dihidangkan' where kode='" . $_GET["hapus"] . "'");
    if ($qry) {
      echo "<script>alert('Data Berhasil diupdate')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=detail_pesanan'>";
    } else {
      echo "Gagal di Hapus";
      echo "<meta http-equiv='refresh' content='0; url=?page=detail_pesanan'>";
    }
  }
  ?>