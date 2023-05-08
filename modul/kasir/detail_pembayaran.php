<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM header_pesanan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>

<div class="rows" id="cetak">
    <div class="col-md-12">
        <div class="box box-success">

            <div class="box-header with-border">
                <h3 class="box-title">No.Invoice <?php echo $data['kode']; ?></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <!-- <table id="example1" class="table table-bordered table-striped"> -->
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



                        </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-success">
            <form class="form-horizontal" method="POST" action="" name="form">
                <div class="modal-body">
                    <?php
                    $id = base64_decode($_GET["id"]);
                    $sqlku = mysqli_query($konek, "SELECT * FROM header_pesanan WHERE kode='$id'");
                    $data  = mysqli_fetch_array($sqlku);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Uang Muka</label>
                        <div class="col-sm-3">
                            <p>Rp. <?php echo (number_format($data['uang_muka'])); ?></p>
                            <input type="hidden" class="form-control" id="meja" name="txtuangmuka" onchange="kali()" value="<?php echo $data['uang_muka']; ?>" placeholder="Uang Muka" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" readonly value="" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Total Rp.</label>
                        <div class="col-sm-3">
                            <p>Rp. <?php echo (number_format($gred_total)); ?></p>
                            <input type="hidden" class="form-control" id="xq" name="txttotal" onchange="kali()" value="<?php echo ($gred_total); ?>" />
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Diskon</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" value="0" id="meja" name="txtdiskon" onchange="kali()" placeholder="Diskon" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                        </div>
                    </div>






                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Bayar</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="meja" name="txtbayar" onchange="kali()" placeholder="Bayar" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Kembalian</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" value="0" id="meja" name="txtkembali" onchange="kali()" placeholder="Kembali" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" readonly value="" />
                        </div>
                    </div>



                    <div class="form-group">
                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Bersih</label> -->
                        <div class="col-sm-3">
                            <input type="hidden" class="form-control" id="meja" name="txtbersih" onchange="kali()" placeholder="Diskon" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Sisa</label> -->
                        <div class="col-sm-3">
                            <input type="hidden" class="form-control" id="meja" name="txtsisa" onchange="kali()" placeholder="Diskon" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                        </div>
                    </div>


                    <div class="form-group">
                        <!-- <label for="inputEmail3" class="col-sm-2 control-label">Sisa</label> -->
                        <div class="col-sm-3">
                            <input type="hidden" class="form-control" id="meja" name="txtkodemeja" placeholder="Diskon" value="<?php echo $data['kode_meja']; ?>" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>


</div>

<div class="modal-footer">
    <input type="submit" name="btnedit" class="btn btn-success pull-right" value="SELESAI">
    <!-- <a button class="btn btn-danger pull-left " data-dismiss="modal" onclick="printContent('cetak')"> CETAK</button></a> -->
</div>


</form>



<?php
if (isset($_POST["btnedit"])) {
    $txttotal = mysqli_real_escape_string($konek, $_POST['txttotal']);
    $txtdiskon = mysqli_real_escape_string($konek, $_POST['txtdiskon']);
    $txtkodemeja = mysqli_real_escape_string($konek, $_POST['txtkodemeja']);

    $txtuangmuka = mysqli_real_escape_string($konek, $_POST['txtuangmuka']);
    $txtbayar = mysqli_real_escape_string($konek, $_POST['txtbayar']);
    $txtkembali = mysqli_real_escape_string($konek, $_POST['txtkembali']);


    $edit = mysqli_query($konek, "UPDATE  header_pesanan SET total='$txttotal',status='Selesai' WHERE kode='$id'");


    $edit_meja = mysqli_query($konek, "UPDATE  meja SET status='tersedia' WHERE kode='$txtkodemeja'");

    $simpan = mysqli_query($konek, "INSERT INTO bayar (id_pesanan,id_pengguna,total,diskon,uang_muka,bayar,kembali) VALUES ('$id','1','$txttotal','$txtdiskon','$txtuangmuka','$txtbayar','$txtkembali')");
    if ($edit) {
        ?>
<script type="text/javascript">
    document.location.href = "beranda.php?page=detail_transaksi";
</script>
<?php
    } else {
        echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=daftar_bayar'>";
    }
}
?>




<script LANGUAGE="JavaScript">
    function kali() {
        total = eval(form.txttotal.value);
        sisa = eval(form.txtsisa.value);
        bayar = eval(form.txtbayar.value);

        diskon = eval(form.txtdiskon.value);
        uang_muka = eval(form.txtuangmuka.value);
        bersih = eval(form.txtbersih.value);
        sisa = uang_muka + diskon
        form.txtsisa.value = sisa
        form.txttotal.value = total
        bersih = total - sisa
        form.txtbersih.value = bersih
        form.txtkembali.value = bayar
        kembali = bayar - bersih
        form.txtkembali.value = kembali;
    }
</script>