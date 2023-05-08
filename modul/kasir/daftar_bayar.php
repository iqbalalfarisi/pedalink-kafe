<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">DAFTAR PESANAN</h3>
        </div>
        <div class="box-body table-responsive">
            <!-- <table class="table table-bordered table-striped"> -->
            <table id="example3" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="15%">No. PESANAN</th>
                        <th>Tanggal</th>
                        <th width="8%">AKSI</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    session_start();
                    $total = NULL;
                    $_SESSION['cart'] = array(
                        $qry = mysqli_query($konek, "select * from header_pesanan where status='Proses'")
                    );
                    while ($data = mysqli_fetch_array($qry)) {
                        ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['kode']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td> <a href="beranda.php?page=detail_pembayaran&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-random btn btn-danger"> Bayar</a>

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