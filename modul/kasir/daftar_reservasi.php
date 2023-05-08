  <?php
  error_reporting(0);
  ?>
  <section class="content-header">
    <div class="callout callout-info">
      <a href="beranda.php?page=tambah_reservasi"><button class="btn btn-danger">TAMBAH RESERVASI</button></a>
    </div>
  </section>

  </div>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">DAFTAR RESERVASI</h3>
    </div>
    <div class="box-body table-responsive">
      <!-- <div class="box-body table-responsive no-padding"> -->
      <table id="example3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th width="30%">NAMA PELANGGAN</th>
            <th>NO HP</th>
            <th>TANGGAL</th>
            <th>PUKUL</th>
            <th>KAPASITAS</th>
            <th>DETAIL</th>
            <th>TOTAL</th>
            <th>UANG MUKA</th>
            <th>CATATAN</th>
            <th></th>
            <th>AKSI</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;

          $qry = mysqli_query($konek, "SELECT * from header_reservasi where status='Proses'");
          while ($data = mysqli_fetch_array($qry)) {
            ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td><?php echo $data['no_hp']; ?></td>
            <td><?php echo $data['tanggal']; ?></td>
            <td><?php echo $data['pukul']; ?></td>
            <td><?php echo $data['kapasitas']; ?></td>
            <td> <a href="beranda.php?page=detail_reservasi&id=<?php echo base64_encode($data['kode']); ?>"><button class="btn btn-success fa fa-eye"></button>

              </a>
            </td>
            <td>Rp. <?php echo (number_format($data['total'])); ?></td>
            <td>Rp. <?php echo (number_format($data['dp'])); ?></td>
            <td><?php echo $data['catatan']; ?></td>
            <td>
              <a href="beranda.php?page=filter_reservasi&id=<?php echo base64_encode($data['kode']); ?>"><button class="btn btn-danger fa fa-mail-reply-all"> Proses</button>
            </td>
            <td>
              <a href="beranda.php?page=edit_reservasi&id=<?php echo base64_encode($data['kode']); ?>"><button class="btn btn-success fa fa-edit"> Ubah</button>

              </a>

            </td>
            <td>
              <a onClick="return confirm('Apakah Reservasi ini di Batalkan.?')" href="beranda.php?page=daftar_reservasi&batal=<?php echo $data['kode']; ?>" class="fa fa-send btn btn-primary"> Batal </a>
            </td>
          </tr>
          <?php } ?>
          </tfoot>
      </table>
      <a href="beranda.php?page=pilih_menu" button class="btn btn-warning pull-left fa fa-download" data-dismiss="modal"> Order Menu</button></a>

    </div>


  </div>
  </section>

  <?php
  if (isset($_GET[batal])) {
    // $qry = mysqli_query($konek, "DELETE from header_reservasi where kode='" . $_GET["batal"] . "'");
    $qry = mysqli_query($konek, "UPDATE  header_reservasi SET status='Batal Reservasi' where kode='" . $_GET["batal"] . "'");
    $edit_pesanan = mysqli_query($konek, "UPDATE  header_pesanan SET status='Batal Reservasi' where kode_reservasi='" . $_GET["batal"] . "'");

    if ($qry) {
      echo "<script>alert('Reservasi Berhasil di Batalkan')</script>";
      echo "<meta http-equiv='refresh' content='0; url=?page=daftar_reservasi'>";
    } else {
      echo "Gagal di Hapus";
      echo "<meta http-equiv='refresh' content='0; url=?page=daftar_reservasi'>";
    }
  }
  ?>