<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM kategori WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>

<section class="content-header">
  <div class="callout callout-warning">
    <h4>Edit Data</h4>
    <p> Berikut ini Form Update data (Ubah Data) </p>
  </div>
</section>

<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Kategori</h3>
    </div>
    <form class="form-horizontal" method="POST" action="">
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="uraian" name="txturaian" value="<?php echo $data['uraian']; ?>" placeholder="Uraian" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="beranda.php?page=kategori" button class="btn btn-danger pull-left" data-dismiss="modal"> BATAL</button></a>
        <input type="submit" name="btnedit" class="btn btn-success pull-right" value="UPDATE">
      </div>
  </div>
  </form>

  <?php
  if (isset($_POST["btnedit"])) {
    $txturaian = $_POST['txturaian'];
    $edit = mysqli_query($konek, "UPDATE  kategori SET uraian='$txturaian' WHERE kode='$id'");
    if ($edit) {
      ?>
      <script type="text/javascript">
        document.location.href = "beranda.php?page=kategori";
      </script>
    <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=kategori'>";
    }
  }
  ?>
</div>
</div>