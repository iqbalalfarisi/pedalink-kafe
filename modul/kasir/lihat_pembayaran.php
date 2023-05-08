<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM header_pesanan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>
<div class="col-md-6">
    <div class="box box-success" id="cetak">
        <div class="box-header with-border">
            <h3 class="box-title">No.Invoice : <?php echo $data['kode']; ?></h3>
            <br><BR>
            <H5 class="box-title">Tanggal : <?php echo $data['tanggal']; ?></H5>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <!-- <table id="example3" class="table table-bordered table-striped"> -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th width="7%">Jumlah</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $qry = mysqli_query($konek, "select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) WHERE  id_pesanan LIKE '%$id%'");
                    while ($data = mysqli_fetch_array($qry)) {
                        $jumlah = $data['jumlah'];
                        $harga = $data['harga'];
                        $hasil = $harga * $jumlah;
                        $gred_total += $hasil
                        ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['jumlah']; ?></td>
                        <td>Rp. <?php echo (number_format($data['harga'])); ?></td>
                        <td>Rp. <?php echo (number_format($hasil)); ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total </td>
                        <td>Rp. <?php echo (number_format($gred_total)); ?></td>
                    </tr>
                    <tr>
                        <?php
                        $id = base64_decode($_GET["id"]);
                        $sqlku = mysqli_query($konek, "SELECT * FROM bayar WHERE id_pesanan='$id'");
                        $hasil_data  = mysqli_fetch_array($sqlku);
                        ?>
                        <td colspan="3"></td>
                        <td>Uang Muka </td>
                        <td>Rp. <?php echo (number_format($hasil_data['uang_muka'])); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Diskon </td>
                        <td>Rp. <?php echo (number_format($hasil_data['diskon'])); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Bayar </td>
                        <td>Rp. <?php echo (number_format($hasil_data['bayar'])); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>Kembalian</td>
                        <td>Rp. <?php echo (number_format($hasil_data['kembali'])); ?></td>
                    </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    <a button class="btn btn-danger pull-left " data-dismiss="modal" onclick="printContent('cetak')"> PRINT</button></a>
</div>
</div>