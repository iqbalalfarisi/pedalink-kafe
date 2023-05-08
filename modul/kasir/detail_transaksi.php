  <?php
  error_reporting(0);
  ?>

  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">RIAWAYAT TRANSAKSI</h3>
    </div>
    <div class="box-body table-responsive">
      <!-- <div class="box-body table-responsive no-padding"> -->
      <table id="example3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>NO BILL</th>
            <th>PELAYAN</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;

          $qry = mysqli_query($konek, "select `header_pesanan`.`kode` AS `kode`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status`,`header_pesanan`.`total` AS `total`,`pengguna`.`nama_pengguna` AS `nama_pengguna` from (`header_pesanan` join `pengguna` on((`pengguna`.`kode` = `header_pesanan`.`id_pengguna`))) where (`header_pesanan`.`status` = 'Selesai')");
          while ($data = mysqli_fetch_array($qry)) {
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['kode']; ?></td>
            <td><?php echo $data['nama_pengguna']; ?></td>
            <td> <a href="beranda.php?page=lihat_pembayaran&id=<?php echo base64_encode($data['kode']); ?>"><button class="btn btn-success fa fa-eye"> Cetak</button>
              </a>
            </td>
          </tr>
          <?php } ?>
          </tfoot>
      </table>
    </div>
  </div>
  </section>