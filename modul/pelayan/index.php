<section class="content-header">
  <div class="callout callout-danger">
    <h4>Harap Pilih Meja Pesanan</h4>
  </div>
</section>
</div>
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">PILIH MEJA</h3>
  </div>
  <form class="form-horizontal" method="POST" action="">
    <div class="box-body table-responsive">
      <table id="example3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th width="10%">NO MEJA</th>
            <th>KAPASITAS</th>
            <th width="10%">AKSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;

          $qry = mysqli_query($konek, "select * from meja where status='tersedia'");
          while ($data = mysqli_fetch_array($qry)) {
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['no_meja']; ?></td>
            <td><?php echo $data['kapasitas']; ?></td>
            </td>
            <td align="right">
              <input type="checkbox" name="pilih[]" value="<?= $data['no_meja'] ?>">Pilih Meja
            </td>
          </tr>
          <?php } ?>
          </tfoot>
      </table>

      <input type="submit" name="btnsimpan" class="btn btn-danger pull-right" value="Pilih Meja">
  </form>
</div>
</div>
</section>
<?php
if (isset($_POST["btnsimpan"])) {
  // foreach ($_POST['pilih'] as$value) {
  $data = implode(",", $_POST['pilih']);
  $tgl = date("Y-m-d H:i:s");
  // Simpan Header
  $simpan = mysqli_query($konek, "INSERT INTO header_pesanan (tanggal,id_pengguna,kode_meja) VALUES('$tgl','10','" . $data . "')");
  if ($simpan) {
    foreach ($_POST['pilih'] as $value) {
      $edit = mysqli_query($konek, "UPDATE  meja SET status='berisi' WHERE no_meja='$value'");
    }
    ?>
<script type="text/javascript">
  document.location.href = "beranda.php?page=tambah_menu";
</script>
<?php
  } else {
    echo "<script>alert('Data Anda Gagal di simpan')</script>";
    echo "<meta http-equiv='refresh' content='0; url=?page=tambah_menu'>";
  }
}
?>