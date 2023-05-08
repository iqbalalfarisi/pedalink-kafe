<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM meja WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>

<section class="content-header">
  <div class="callout callout-info">
    <h4>Edit Data</h4>
    <p> Berikut ini Form Update data (Ubah Data) </p>
  </div>
</section>

<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">EDIT MEJA</h3>
    </div>
    <form class="form-horizontal" method="POST" action="">
      <div class="modal-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">No. Meja</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="meja" name="txtkodemeja" value="<?php echo $data['no_meja']; ?>" placeholder="NO MEJA" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="meja" name="txtkapasitas" value="<?php echo $data['kapasitas']; ?>" placeholder="kapasitas" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="beranda.php?page=meja" button class="btn btn-danger pull-left" data-dismiss="modal"> BATAL</button></a>
        <input type="submit" name="btnedit" class="btn btn-success pull-right" value="UPDATE">
      </div>
  </div>
  </form>

  <?php
  if (isset($_POST["btnedit"])) {
    $txtkodemeja = mysqli_real_escape_string($konek, $_POST['txtkodemeja']);
    $txtkapasitas = mysqli_real_escape_string($konek, $_POST['txtkapasitas']);


    $edit = mysqli_query($konek, "UPDATE  meja SET no_meja='$txtkodemeja',kapasitas='$txtkapasitas' WHERE kode='$id'");
    if ($edit) {
      ?>
      <script type="text/javascript">
        document.location.href = "beranda.php?page=meja";
      </script>
    <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=meja'>";
    }
  }
  ?>
</div>
</div>