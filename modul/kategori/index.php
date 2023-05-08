        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> <BR>
                <h4 class="modal-title">FORM KATEGORI</h4>
              </div>
              <form class="form-horizontal" method="POST" action="">
                <div class="modal-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uraian" name="txturaian" placeholder="Uraian " required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
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
          $txturaian = mysqli_real_escape_string($konek, $_POST['txturaian']);
          $cek_user = mysqli_num_rows(mysqli_query($konek, "select * from kategori where uraian = '$txturaian'"));
          if ($cek_user > 0) {
            echo "<script>alert('Maaf, Sudah ada di database, Harap Cek Kembali')</script>";
          } else {

            $simpan = mysqli_query($konek, "INSERT INTO kategori (uraian) VALUES ('$txturaian')");
            if ($simpan) {
              ?>

              <script type="text/javascript">
                document.location.href = "beranda.php?page=kategori";
              </script>

            <?php
            } else {
              echo "<script>alert('Data Anda Gagal di simpan')</script>";
              echo "<meta http-equiv='refresh' content='0; url=?page=kategori'>";
            }
          }
        }
        ?>

        <section class="content-header">
          <div class="callout callout-info">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Tambah Kategori</button>

          </div>
        </section>


        <div class=" col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR KATEGORI</h3>
            </div>
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">NO</th>
                      <th>KATEGORI</th>
                      <th width="8%">-</th>
                      <th width="8%">-</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $no = 1;
                    $qry = mysqli_query($konek, "SELECT * FROM kategori order by kode desc");
                    while ($data = mysqli_fetch_array($qry)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['uraian']; ?></td>

                        <td> <a href="beranda.php?page=edit_kategori&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-retweet btn btn-success"> Edit</a></td>
                        <td> <a onClick="return confirm('Data ini akan di hapus.?')" href="beranda.php?page=kategori&hapus=<?php echo $data['kode']; ?>" class="fa fa-trash btn btn-danger"> Hapus </a></td>
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
          $qry = mysqli_query($konek, "delete from kategori where kode='" . $_GET["hapus"] . "'");
          if ($qry) {
            echo "<script>alert('Data Berhasil di Hapus')</script>";
            echo "<meta http-equiv='refresh' content='0; url=?page=kategori'>";
          } else {
            echo "Gagal di Hapus";
            echo "<meta http-equiv='refresh' content='0; url=?page=kategori'>";
          }
        }
        ?>