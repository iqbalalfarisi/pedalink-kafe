<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM header_pesanan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>
<div class="col-md-6">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">Lihat Pesanan </h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                <thead>
                    <tr>
                        <th width="20%">Nama Menu</th>
                        <th width="7%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qry = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) WHERE  id_pesanan LIKE '%$id%'");
                    while ($data = mysqli_fetch_array($qry)) {
                        ?>
                    <tr>

                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jumlah']; ?></td>
                    </tr>
                    <?php } ?>

                    </tfoot>
            </table>

        </div>
    </div>
</div>
</div>