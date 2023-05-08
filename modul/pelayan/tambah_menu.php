<body>
  <?php
  $sql = "select `menu`.`kode` AS `kode`,`menu`.`kode_kategori` AS `kode_kategori`,`menu`.`nama` AS `nama`,`menu`.`harga` AS `harga`,`menu`.`deskripsi` AS `deskripsi`,`menu`.`gambar` AS `gambar`,`menu`.`tanggal` AS `tanggal`,`menu`.`jumlah_pesan` AS `jumlah_pesan`,`kategori`.`uraian` AS `kategori`,`menu`.`status` AS `status` from (`kategori` join `menu` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where (`menu`.`status` = 'Aktif') order by `menu`.`kode` desc";
  $result = mysqli_query($konek, $sql);
  ?>
  <div class="col-md-12">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">DAFTAR MENU</h3>
      </div>
      <div class="box-body table-responsive">
        <table id="example3" class="table table-bordered table-striped">
          <thead>
            <tr>

              <th>NAMA</th>
              <th>HARGA</th>
              <th>KATEGORI</th>
              <th>GAMBAR</th>
              <th>PESAN</th>
            </tr>
          </thead>
          <?php while ($data = mysqli_fetch_object($result)) { ?>
          <tr>
            <td> <?php echo $data->nama; ?></td>
            <td> Rp.<?php echo $data->harga; ?> </td>
            <td> <?php echo $data->kategori; ?> </td>
            <td><img src="gambar/barang/<?php echo $data->gambar; ?>" class="img-circle" width="80px;" hight="100px;">
            <td> <a href="beranda.php?page=card_1&id= <?php echo $data->kode; ?> &action=add"><button class="btn btn-danger fa fa-shopping-cart"> Pesan </button></a> </td>
          </tr>
          <?php } ?>
          </tfoot>
        </table>
      </div>


    </div>
  </div>
  </div>