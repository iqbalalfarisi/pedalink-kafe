<?php
$id = base64_decode(mysqli_real_escape_string($konek, $_GET["id"]));
$sqlku = mysqli_query($konek, "SELECT * FROM header_reservasi WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>

<div class="col-md-12">
    <div class="box box-success">
        
        <div class="box-header with-border">
            <h3 class="box-title">Ubah Reservasi</h3>
        </div>
        <form class="form-horizontal" method="POST" action="">
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pelanggan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $data['nama_pelanggan'];?>" name="txtnama" placeholder="Nama Pelanggan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="<?php echo $data['no_hp'];?>" name="txthp" placeholder="No Hp" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" value="<?php echo $data['tanggal'];?>" name="txttanggal" placeholder="Input" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pukul</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" value="<?php echo $data['pukul'];?>" name="txtpukul" placeholder="Pulkul : 10:00:00" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="<?php echo $data['kapasitas'];?>" name="txtkapasitas" placeholder="Kapasitas" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Catatan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" placeholder="Catatan"  name="txtcatatan"><?php echo $data['catatan'];?></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <a href="beranda.php?page=daftar_reservasi" button class="btn btn-danger pull-left" data-dismiss="modal"> Batal Edit</button></a>
                <input type="submit" name="btnsimpan" class="btn btn-success pull-right" value="Simpan">
            </div>
    </div>
    </form>

    <?php
    if (isset($_POST["btnsimpan"])) {
        $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
        $txthp = mysqli_real_escape_string($konek, $_POST['txthp']);
        $txttanggal = mysqli_real_escape_string($konek, $_POST['txttanggal']);
        $txtpukul = mysqli_real_escape_string($konek, $_POST['txtpukul']);
        $txtkapasitas = mysqli_real_escape_string($konek, $_POST['txtkapasitas']);
        $txtcatatan = mysqli_real_escape_string($konek, $_POST['txtcatatan']);

        
    $edit = mysqli_query($konek, "UPDATE  header_reservasi SET nama_pelanggan='$txtnama',no_hp='$txthp',tanggal='$txttanggal',pukul='$txtpukul',kapasitas='$txtkapasitas',catatan='$txtcatatan' WHERE kode='$id'");
    if ($edit) {
      ?>
      <script type="text/javascript">
        document.location.href = "beranda.php?page=daftar_reservasi";
      </script>
    <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=daftar_reservasi'>";
    }
  }
  ?>
</div>
</div>