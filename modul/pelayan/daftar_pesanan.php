<div class="col-md-12">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">DAFTAR PESANAN</h3>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="15%">No. PESANAN</th>
                        <th>NO MEJA</th>
                        <th width="8%"></th>
                        <!-- <th width="8%"></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    session_start();
                    $total = NULL;
                    $_SESSION['cart'] = array(
                        $qry = mysqli_query($konek, "select `header_pesanan`.`kode` AS `kode`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status`,`header_pesanan`.`total` AS `total`,`pengguna`.`nama_pengguna` AS `nama_pengguna` from (`header_pesanan` join `pengguna` on((`pengguna`.`kode` = `header_pesanan`.`id_pengguna`))) where (`header_pesanan`.`status` = 'Proses')")
                    );
                    while ($data = mysqli_fetch_array($qry)) {
                        ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['kode']; ?></td>
                        <td><?php echo $data['kode_meja']; ?></td>
                        <td> <a href="beranda.php?page=lihat_pesanan&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-eye btn btn-warning"> Lihat</a>
                        </td>
                        <!-- <td> <a href="beranda.php?page=tambah_menu" class="fa fa-send btn btn-danger"> Tambah</a>
                        </td> -->
                    </tr>
                    <?php } ?>

                    </tfoot>
            </table>
        </div>
        <a href="beranda.php?page=keranjang" class="btn btn-app">
            <span class="badge bg-yellow">++</span>
            <i class="fa fa-bullhorn"></i> Lihat Pesanan
        </a>

    </div>
</div>
</div>
<?php
if (isset($_GET[hapus])) {
    $qry = mysqli_query($konek, "delete from header_pesanan where kode='" . $_GET["hapus"] . "'");
    if ($qry) {
        echo "<script>alert('Data Berhasil di Hapus')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=order_meja'>";
    } else {
        echo "Gagal di Hapus";
        echo "<meta http-equiv='refresh' content='0; url=?page=order_meja'>";
    }
}
?>