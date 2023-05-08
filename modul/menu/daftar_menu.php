  <?php
  error_reporting(0);
  ?>
  <section class="content-header">
    <div class="callout callout-info">
      <a href="beranda.php?page=menu"><button class="btn btn-danger">TAMBAH MENU</button></a>
    </div>
  </section>

  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">DAFTAR MENU</h3>
    </div>
    <div class="box-body table-responsive">
      <!-- <div class="box-body table-responsive no-padding"> -->
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

          $qry = mysqli_query($konek, "SELECT `menu`.`kode` AS `kode`,`menu`.`kode_kategori` AS `kode_kategori`,`menu`.`nama` AS `nama`,`menu`.`harga` AS `harga`,`menu`.`deskripsi` AS `deskripsi`,`menu`.`gambar` AS `gambar`,`menu`.`tanggal` AS `tanggal`,`menu`.`jumlah_pesan` AS `jumlah_pesan`,`kategori`.`uraian` AS `kategori` from (`kategori` join `menu` on((`kategori`.`kode` = `menu`.`kode_kategori`))) order by `menu`.`kode` desc");
          while ($data = mysqli_fetch_array($qry)) {
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['kategori']; ?></td>
            <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
            <td><img src="gambar/barang/<?php echo $data['gambar']; ?>" class="img-circle" width="80px;" hight="100px;">
            </td>

            <td align="right">
              <a href="beranda.php?page=edit_menu&id=<?php echo base64_encode($data['kode']); ?>"><button class="btn btn-success fa fa-edit"> Edit</button>

              </a>

              <a onClick="return confirm('Data ini akan di hapus.?')" href="beranda.php?page=tampil_menu&hapus=<?php echo $data['kode']; ?>" class="fa fa-trash btn btn-danger"> Hapus </a>
            </td>


          </tr>
          <?php } ?>
          </tfoot>
      </table>
    </div>
  </div>
  </section>

  <?php
  if (isset($_GET[hapus])) {
    $qry = mysqli_query($konek, "DELETE from menu where kode='" . $_GET["hapus"] . "'");
    if ($qry) {
      echo "<script>alert('Data Berhasil di Hapus')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=tampil_menu'>";
    } else {
      echo "Gagal di Hapus";
      echo "<meta http-equiv='refresh' content='0; url=?page=tampil_menu'>";
    }
  }
  ?>