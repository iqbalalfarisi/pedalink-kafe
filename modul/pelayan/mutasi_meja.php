       <div class="col-md-12">
           <div class="box box-success">

               <div class="box-header with-border">
                   <center>
                       <h3 class="box-title">DAFTAR MEJA</h3>
                   </center>
               </div>
              
               <div class="box-body table-responsive">
                   <table class="table table-bordered table-striped">
                       <table id="example2" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th width="5%">NO</th>
                                   <th>NO MEJA</th>
                                   <th>KAPASITAS</th>
                                   <th>STATUS</th>
                                   <th width="8%">TERSEDIA</th>
                                   <th width="8%">BERISI</th>
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
                                       <td><?php echo $data['status']; ?></td>
                                       <td>
                                           <a href="beranda.php?page=mutasi_meja&mutasi=<?php echo $data['kode']; ?>" class="fa fa-home btn btn-danger"> TERSEDIA</a>
                                       </td>
                                       <td>
                                           <a href="beranda.php?page=mutasi_meja&berisi=<?php echo $data['kode']; ?>" class="fa fa-user-plus btn btn-warning"> BERISI</a>
                                       </td>
                                   </tr>
                               <?php } ?>
                               </tfoot>


                       </table>

                           
                        
       <tr>
           <center>
           <form  method="POST" action="#">   

               <td colspan="4">
                   <div class="form-group">

                       <div class="col-sm-3">
                           <select name="cbmeja1" class="form-control select2" style="width: 100%;">
                               <?php
                                $qry = mysqli_query($konek, "SELECT * from meja where status='berisi'");
                                while ($d = mysqli_fetch_array($qry)) { ?>
                                                                                                                                                                                                                                                                                                                                                                       <option class="form-control" value="<?php echo $d["no_meja"]; ?>"><?php echo $d['no_meja']; ?>
                                                                                                                                                                                                                                                                                                                                                                       </option>
                               <?php } ?>
                           </select>
                       </div>


                       <div class="col-sm-3">
                           <select name="cbmeja2" class="form-control select2" style="width: 100%;">
                               <?php
                                $qry = mysqli_query($konek, "SELECT * from meja where status='tersedia'");
                                while ($d = mysqli_fetch_array($qry)) { ?>
                                                                                                                                                                                                                                                                                                                                                                       <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['no_meja']; ?>
                                                                                                                                                                                                                                                                                                                                                                       </option>
                               <?php } ?>
                           </select>
                       </div>



                   </div>
               </td>
               <input type="submit" name="btnedit" class="btn btn-success pull-left" value="Pindah">
           </center>
       </tr>
                                                     


   


               </div>
           </div>
       </div>
       </div>
       </form>     
       <?php
  if (isset($_POST["btnedit"])) {
    $cbmeja1 = mysqli_real_escape_string($konek, $_POST['cbmeja1']);
    $cbmeja2 = mysqli_real_escape_string($konek, $_POST['cbmeja2']);
    $edit = mysqli_query($konek, "UPDATE  meja SET status='tersedia' WHERE no_meja='$cbmeja1'");
    $edit2 = mysqli_query($konek, "UPDATE  meja SET status='berisi' WHERE kode='$cbmeja2'");
    if ($edit) {
      ?>
      <script type="text/javascript">
        document.location.href = "beranda.php?page=mutasi_meja";
      </script>
    <?php
    } else {
      echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=mutasi_meja'>";
    }
  }
  ?>

  

       <?php
        if (isset($_GET[mutasi])) {
            $qry = mysqli_query($konek, "UPDATE  meja SET status='tersedia' where kode='" . $_GET["mutasi"] . "'");
            if ($qry) {
                echo "<script>alert('Data Berhasil diupdate')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=mutasi_meja'>";
            } else {
                echo "Gagal di mutasi";
                echo "<meta http-equiv='refresh' content='0; url=?page=mutasi_meja'>";
            }
        }
        ?>

       <?php
        if (isset($_GET[berisi])) {
            $qry = mysqli_query($konek, "UPDATE  meja SET status='berisi' where kode='" . $_GET["berisi"] . "'");
            if ($qry) {
                echo "<script>alert('Data Berhasil diupdate')</script>";
                echo "<meta http-equiv='refresh' content='0; url=?page=mutasi_meja'>";
            } else {
                echo "Gagal di mutasi";
                echo "<meta http-equiv='refresh' content='0; url=?page=mutasi_meja'>";
            }
        }
        ?>

      