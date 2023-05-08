        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> <BR>
                <h4 class="modal-title">FORM PENGGUNA</h4>
              </div>


              <form class="form-horizontal" method="POST" action="">
                <div class="modal-body">

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uraian" name="txtnama" placeholder="Nama " required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="uraian" name="txturaian" placeholder="User Name " required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
                    </div>
                  </div>




                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Password </label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="uraian" name="txtpassword" placeholder="Password " required oninvalid="this.setCustomValidity('Text Box ini tidak boleh kosong')" oninput="setCustomValidity('')" />
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
                  <button type="button" class="btn btn-primary" data-dismiss="modal"> Tutup</button>
                  <input type="submit" name="btnsimpan" class="btn btn-primary pull-right" value="Simpan">
                </div>
            </div>
            </form>
          </div>
        </div>
        <?php
        if (isset($_POST["btnsimpan"])) {
          $txtnama = mysqli_real_escape_string($konek, $_POST['txtnama']);
          $cblevel = mysqli_real_escape_string($konek, $_POST['cblevel']);
          $txturaian = mysqli_real_escape_string($konek, $_POST['txturaian']);
          $txtpassword = md5(mysqli_real_escape_string($konek, $_POST['txtpassword']));
          $cek_user = mysqli_num_rows(mysqli_query($konek, "select * from pengguna where username = '$txturaian'"));
          if ($cek_user > 0) {
            echo "<script>alert('Maaf, Sudah ada didatabase, Harap Cek Kembali')</script>";
          } else {
            $simpan = mysqli_query($konek, "INSERT INTO pengguna (username,password,level,nama_pengguna) VALUES ('$txturaian','$txtpassword','$cblevel','$txtnama')");
            if ($simpan) {
              ?>

              <script type="text/javascript">
                document.location.href = "beranda.php?page=user";
              </script>

            <?php
            } else {
              echo "<script>alert('Data Anda Gagal di simpan')</script>";
              echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
            }
          }
        }
        ?>

        <section class="content-header">
          <div class="callout callout-info">
            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Tambah Pengguna</button>
            <!-- <p> Berikut ini Daftar Pengguna</p> -->
          </div>
        </section>
        
        <div class="col-md-12">
          
          <div class="box box-success">
          <div class="box-header with-border">
      <h3 class="box-title">DAFTAR PENGGUNA</h3>
    </div>
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">NO</th>
                      <th>USER NAME</th>
                      <th>NAMA PENGGUNA</th>
                      <th>LEVEL</th>
                      <th width="8%">-</th>
                      <th width="8%">-</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $no = 1;
                    $qry = mysqli_query($konek, "SELECT * FROM pengguna order by kode desc");
                    while ($data = mysqli_fetch_array($qry)) {
                      ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['nama_pengguna']; ?></td>
                        <td><?php echo $data['level']; ?></td>

                        <td> <a href="beranda.php?page=edit_user&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-retweet btn btn-success"> Edit</a></td>
                        <td> <a onClick="return confirm('Data ini akan di hapus.?')" href="beranda.php?page=user&hapus=<?php echo $data['kode']; ?>" class="fa fa-trash btn btn-danger"> Hapus </a></td>
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
          $qry = mysqli_query($konek, "delete from pengguna where kode='" . $_GET["hapus"] . "'");
          if ($qry) {
            echo "<script>alert('Data Berhasil di Hapus')</script>";
            echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
          } else {
            echo "Gagal di Hapus";
            echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
          }
        }
        ?>