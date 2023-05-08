<section class="content-header">
    <div class="callout callout-danger">
        <h4>Tambah Menu</h4>
        <p> Berikut ini Form Tambah data Menu </p>
    </div>
</section>

<div class="col-md-12">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">FORM INPUT MENU</h3>
        </div>
        <form class="form-horizontal" method="POST" action="">
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="uraian" name="txtnama" placeholder="Nama Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Dekripsi Menu</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="txtdeskripsi"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kategori Menu</label>
                    <div class="col-sm-10">
                        <select name="cbkategori" class="form-control select2" style="width: 100%;">
                            <?php
                            $qry = mysqli_query($konek, "select * from kategori");
                            while ($d = mysqli_fetch_array($qry)) { ?>
                            <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['uraian']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="uraian" name="txtharga" placeholder="Harga Menu" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>


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
          UPLOAD GAMBAR
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
            <div class="modal-footer">
                <a href="beranda.php?page=tampil_menu" button class="btn btn-danger pull-left" data-dismiss="modal"> BATAL</button></a>
                <input type="submit" name="btnsimpan" class="btn btn-success pull-right" value="Simpan">
            </div>
    </div>
    </form>
    

    <?php
    if (isset($_POST["btnsimpan"])) {

        $txtkode = mysqli_real_escape_string($konek, $_POST['txtkode']);
        $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
        $cbkategori = mysqli_real_escape_string($konek, $_POST['cbkategori']);
        $txtharga = mysqli_real_escape_string($konek, $_POST['txtharga']);
        $txtdeskripsi = mysqli_real_escape_string($konek, $_POST['txtdeskripsi']);
        $tgl = date("Y-m-d H:i:s");
        $cek_user = mysqli_num_rows(mysqli_query($konek, "select * from menu where kode = '$txtkode'"));
        if ($cek_user > 0) {
            echo "<script>alert('Maaf, Kode Barang Sudah ada di Database, Harap Cek Kembali')</script>";
        } else {
            $simpan = mysqli_query($konek, "INSERT INTO menu (kode,kode_kategori,nama,harga,deskripsi,tanggal,gambar) VALUES ('$txtkode','$cbkategori','$txtnama','$txtharga','$txtdeskripsi','$tgl','xxx.jpg')");
            if ($simpan) {
                ?>
    <script type="text/javascript">
        document.location.href = "beranda.php?page=tampil_menu";
    </script>
    <?php
            } else {
                echo "<script>alert('Data Anda Gagal di simpan')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=menu'>";
            }
        }
    }
    ?>
</div>
</div>