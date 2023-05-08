<section class="content-header">
  <div class="callout callout-warning">
    <h4>Edit Menu</h4>

  </div>
</section>
<?php
$id = base64_decode(mysqli_real_escape_string($konek, $_GET["id"]));
$sqlku = mysqli_query($konek, "SELECT * FROM menu WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
$kategori = $data['kode_kategori'];
?>
<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Form Menu / Edit Menu</h3>
    </div>
    <form class="form-horizontal" method="POST" action="">
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kode Menu</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" readonly="true" id="uraian" name="txtkode" value="<?php echo $data['kode']; ?>" placeholder="Kode Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama Menu</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="uraian" name="txtnama" value="<?php echo $data['nama']; ?>" placeholder="Nama Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="uraian" name="txtharga" value="<?php echo $data['harga']; ?>" placeholder="Harga Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Dekripsi Menu</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="txtdeskripsi"><?php echo $data['deskripsi']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
          <div class="col-sm-10">
            <select name="cbkategori" class="form-control select2" style="width: 100%;">
              <?php
              $qry = mysqli_query($konek, "SELECT * from kategori");
              while ($data = mysqli_fetch_array($qry)) {
                ?>
              <option class="form-control" value="<?php echo $data["kode"]; ?>" <?php
                                                                                  if ($kategori == $data['kode']) {
                                                                                    echo "selected";
                                                                                  } ?>> <?php echo $data['uraian']; ?></option><?php
                                                                                                                                }
                                                                                                                                ?>
            </select>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <a href="beranda.php?page=tampil_menu" button class="btn btn-danger pull-left" data-dismiss="modal"> BATAL</button></a>
        <input type="submit" name="btnedit" class="btn btn-success pull-right" value="Edit">
      </div>
  </div>
  </form>

  <?php
  if (isset($_POST["btnedit"])) {
    $txtkode = mysqli_real_escape_string($konek, $_POST['txtkode']);
    $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
    $cbsatuan = mysqli_real_escape_string($konek, $_POST['cbsatuan']);
    $cbkategori = mysqli_real_escape_string($konek, $_POST['cbkategori']);
    $txtharga = mysqli_real_escape_string($konek, $_POST['txtharga']);
    $txtdeskripsi = mysqli_real_escape_string($konek, $_POST['txtdeskripsi']);


    $edit = mysqli_query($konek, "UPDATE  menu SET nama='$txtnama',kode_kategori='$cbkategori',harga='$txtharga',deskripsi='$txtdeskripsi' WHERE kode='$id'");
    if ($edit) {
      ?>
  <script type="text/javascript">
    document.location.href = "beranda.php?page=tampil_menu";
  </script>
  <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan pada saat update, harap coba lagi')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=edit_menu'>";
    }
  }
  ?>

  <!-- Upload Gambar -->



  <div class="row">
    <div class="col-md-12">
      <div class="box box-default collapsed-box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Upload Gambar </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          Edit Gambar
          <?php echo $data["gambar"]; ?>
          <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="">
            <div class="form-group">

              <label for="inputEmail3" class="col-sm-2 control-label">Input Gambar</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" id="uraian" name="txtgambar" required oninvalid="this.setCustomValidity('Gambar Wajib di Isi')" oninput="setCustomValidity('')" />
              </div>
            </div>

            <input type="submit" name="btnuplad" class="btn btn-primary btn-block" value="Kirim Gambar">
          </form>
          <?php
          if (isset($_POST["btnuplad"])) {
            $nama_file   = strtolower($_FILES['txtgambar']['name']);
            $lokasi_file = $_FILES['txtgambar']['tmp_name'];
            $upoadgambar = mysqli_query($konek, "UPDATE  menu SET gambar='$nama_file' WHERE kode='$id'");
            if ($upoadgambar) {
              if (!empty($lokasi_file)) {
                move_uploaded_file($lokasi_file, "gambar/barang/$nama_file");
                ?>
          <script type="text/javascript">
            document.location.href = "beranda.php?page=tampil_menu";
          </script>
          <?php
              } else {
                echo "Terjadi kesalahan";
              }
            }
          }
          ?>

        </div>

        <!-- AKHIR UPLOAD GAMBAR -->

      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

</div>
</section>