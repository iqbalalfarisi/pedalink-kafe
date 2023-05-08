        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> <BR>
                <h4 class="modal-title">FORM INPUT MEJA</h4>
              </div>
              <form class="form-horizontal" method="POST" action="">
                <div class="modal-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">No. Meja</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uraian" name="txtkodemeja" placeholder="No Meja " required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kapasitas</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="uraian" name="txtkapasitas" placeholder="kapasitas" required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
                    </div>
                  </div>





                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal"> Tutup</button>
                  <input type="submit" name="btnsimpan" class="btn btn-primary pull-right" value="Simpan">
                </div>
            </div>
            </form>
          </div>
        </div>
        <?php
        if (isset($_POST["btnsimpan"])) {
          $txtkodemeja = mysqli_real_escape_string($konek, $_POST['txtkodemeja']);
          $txtkapasitas = mysqli_real_escape_string($konek, $_POST['txtkapasitas']);
          $cek_user = mysqli_num_rows(mysqli_query($konek, "select * from meja where no_meja = '$txtkodemeja'"));
          if ($cek_user > 0) {
            echo "<script>alert('Maaf, Sudah ada didatabase, Harap Cek Kembali')</script>";
          } else {
            $simpan = mysqli_query($konek, "INSERT INTO meja (no_meja,kapasitas,status) VALUES ('$txtkodemeja','$txtkapasitas','Tersedia')");
            if ($simpan) {
              ?>

              <script type="text/javascript">
                document.location.href = "beranda.php?page=meja";
              </script>

            <?php
            } else {
              echo "<script>alert('Data Anda Gagal di simpan')</script>";
              echo "<meta http-equiv='refresh' content='0; url=?page=meja'>";
            }
          }
        }
        ?>

        <section class="content-header">
          <div class="callout callout-info">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Tambah Meja</button>
            <!-- <p> Berikut ini Daftar Meja</p> -->
          </div>
        </section>


        <div class="col-md-12">
          <div class="box box-success">

            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR MEJA</h3>
            </div>

            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">NO</th>
                      <th>NO MEJA</th>
                      <th>KAPASITAS</th>
                      <th width="8%">AKSI</th>
                      <th width="8%">-</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $no = 1;

                    $qry = mysqli_query($konek, "SELECT * FROM meja order by kode desc");
                    while ($data = mysqli_fetch_array($qry)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['no_meja']; ?></td>
                        <td><?php echo $data['kapasitas']; ?></td>

                        <td> <a href="beranda.php?page=edit_meja&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-edit btn btn-success"> Edit</a></td>
                        <td> <a onClick="return confirm('Data ini akan di hapus.?')" href="beranda.php?page=meja&hapus=<?php echo $data['kode']; ?>" class="fa fa-trash btn btn-danger"> Hapus </a></td>
                      </tr>
                    <?php } ?>
                    </tfoot>
                </table>
            </div>
          </div>

        </div>
        </div>
        <?php
        if (isset($_GET[hapus])) {
          $qry = mysqli_query($konek, "delete from meja where kode='" . $_GET["hapus"] . "'");
          if ($qry) {
            echo "<script>alert('Data Berhasil di Hapus')</script>";
            echo "<meta http-equiv='refresh' content='0; url=?page=meja'>";
          } else {
            echo "Gagal di Hapus";
            echo "<meta http-equiv='refresh' content='0; url=?page=meja'>";
          }
        }
        ?>