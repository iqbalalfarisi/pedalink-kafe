<?php
error_reporting(0);
$carikode = mysqli_query($konek, "select max(kode) from header_reservasi") or die(mysql_error());
$datakode = mysqli_fetch_array($carikode);
if ($datakode) {
    $nilaikode = substr($datakode[0], 1);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $kode_otomatis = "1" . str_pad($kode, 5, "0", STR_PAD_LEFT);
} else {
    $kode_otomatis = "100001";
}
?>

<div class="col-md-12">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">Tambah Reservasi</h3>
        </div>
        <form class="form-horizontal" method="POST" action="">
            <div class="modal-body">


                <div class="form-group">
                    <!-- <label for="inputEmail3" class="col-sm-2 control-label">Kode</label> -->
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" value="<?php echo $kode_otomatis ?>" id="reservasi" name="txtkode" placeholder="Nama Pelanggan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Pelanggan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="reservasi" name="txtnama" placeholder="Nama Pelanggan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="reservasi" name="txthp" placeholder="No Hp" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="reservasi" name="txttanggal" placeholder="Input" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pukul</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="reservasi" name="txtpukul" placeholder="Pulkul : 10:00:00" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="reservasi" name="txtkapasitas" placeholder="Kapasitas" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Catatan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" placeholder="Catatan" name="txtcatatan"></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
               



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
        $txtkode = mysqli_real_escape_string($konek, $_POST['txtkode']);
        $tanggal = date("Y-m-d H:i:s");
        $cek_user = mysqli_num_rows(mysqli_query($konek, "select * from header_reservasi where nama = '$txtnama'"));
        if ($cek_user > 0) {
            echo "<script>alert('Reservasi Sudah Ada')</script>";
        } else {
            $simpan = mysqli_query($konek, "INSERT INTO header_reservasi (kode,nama_pelanggan,no_hp,tanggal,pukul,kapasitas,catatan,status) VALUES ('$txtkode','$txtnama','$txthp','$txttanggal','$txtpukul','$txtkapasitas','$txtcatatan','Proses')");


            $simpan_header_pesanan = mysqli_query($konek, "INSERT INTO header_pesanan (id_pengguna,kode_reservasi,tanggal,status) VALUES ('9','$txtkode','$txttanggal','Proses')");



            if ($simpan) {
                ?>
    <script type="text/javascript">
        document.location.href = "beranda.php?page=daftar_reservasi";
    </script>
    <?php
            } else {
                echo "<script>alert('Data Anda Gagal di simpan')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=tambah_reservasi'>";
            }
        }
    }
    ?>
</div>
</div>