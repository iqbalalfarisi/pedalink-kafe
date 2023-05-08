<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM pengguna WHERE kode='$id'");
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
      <h3 class="box-title">EDIT PENGGUNA</h3>
    </div>
    <form class="form-horizontal" method="POST" action="">
      <div class="modal-body">

      <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="uraian" name="txtnama" value="<?php echo $data['nama_pengguna']; ?>" placeholder="User" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="uraian" name="txtusername" value="<?php echo $data['username']; ?>" placeholder="User" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
          </div>
        </div>
        <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" name="cblevel" style="width: 100%;">
                        <option selected="selected">Pemilik</option>
                        <option>Kasir</option>
                        <option>Dapur</option>
                        <option>Pelayan</option>
                      </select>
                    </div>
                  </div>

      </div>
      <div class="modal-footer">
        <a href="beranda.php?page=user" button class="btn btn-danger pull-left" data-dismiss="modal"> BATAL</button></a>
        <input type="submit" name="btnedit" class="btn btn-success pull-right" value="UPDATE">
      </div>
  </div>
  </form>
  <?php
  if (isset($_POST["btnedit"])) {
    $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
    $cblevel = mysqli_real_escape_string($konek, $_POST['cblevel']);
    $txtusername = mysqli_real_escape_string($konek, $_POST['txtusername']);
    $edit = mysqli_query($konek, "UPDATE  pengguna SET username='$txtusername',nama_pengguna='$txtnama',level='$cblevel' WHERE kode='$id'");
    if ($edit) {
      ?>
      <script type="text/javascript">
        document.location.href = "beranda.php?page=user";
      </script>
    <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
    }
  }
  ?>
</div>
</div>