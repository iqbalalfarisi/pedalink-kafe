<section class="content-header">
  <div class="callout callout-warning">
    <h4>LAPORAN FAFORIT</h4>
  </div>
</section>
<div class="col-md-12">
  <div class="box box-success" id="cetak">
    <div class="box-header with-border">
      <H4>LAPORAN FAVORIT</H4>
    </div>
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped">
        <!-- <table id="example2" class="table table-bordered table-striped"> -->
        <thead>
          <tr>
            <th>NO</th>
            <th>TANGGAL INPUT</th>
            <th>NAMA MENU</th>
            <th>HARGA</th>
            <th>KATEGORI</th>
            <th>JUMLAH PESAN</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $qry = mysqli_query($konek, "SELECT distinct sum(`detail_pesanan`.`jumlah`) AS `total`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`menu`.`nama` AS `nama`,`detail_pesanan`.`status` AS `status`,`menu`.`kode` AS `kode`,`menu`.`kode_kategori` AS `kode_kategori`,`menu`.`harga` AS `harga`,`menu`.`deskripsi` AS `deskripsi`,`menu`.`gambar` AS `gambar`,`menu`.`tanggal` AS `tanggal`,`menu`.`jumlah_pesan` AS `jumlah_pesan`,`kategori`.`uraian` AS `kastegori` from ((`detail_pesanan` join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) group by `detail_pesanan`.`id_menu` order by total desc");
          while ($data = mysqli_fetch_array($qry)) {
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['tanggal']; ?></td>
              <td><?php echo $data['nama']; ?></td>
              <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
              <td><?php echo $data['kastegori']; ?></td>
              <td><?php echo $data['total']; ?></td>
            </tr>
          <?php } ?>
          </tfoot>
      </table>
    </div>
  </div>
</div>
<div class="modal-footer">
  <a button class="btn btn-danger pull-left " data-dismiss="modal" onclick="printContent('cetak')"> CETAK</button></a>
</div>
</div>
</section>