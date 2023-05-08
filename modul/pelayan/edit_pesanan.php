<script LANGUAGE="JavaScript">
    function kali() {
        harga = eval(form.txtharga.value);
        jumlah_masuk = eval(form.txtjumlah.value);

        total = harga * jumlah_masuk
        form.txttotal.value = total;

        bayar = eval(form.txtbayar.value);
        kembali = bayar - total
        form.txtkembali.value = kembali;
    }
</script>

<?php
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM detail_pesanan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>


<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">EDIT PESANAN</h3>
        </div>
        <form class="form-horizontal" method="POST" action="" name="form">
            <div class="modal-body">

                <div class="form-group">
                    <!-- <label for="inputEmail3" class="col-sm-2 control-label">Harga</label> -->
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" value="<?php echo $data['harga']; ?>" id="prd_desc" onchange="kali()" name="txtharga" placeholder="0" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Input Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="<?php echo $data['jumlah']; ?>" id="uraian" onchange="kali()" name="txtjumlah" placeholder="0" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>
                <div class="form-group">
                    <!-- <label for="inputEmail3" class="col-sm-2 control-label">Total</label> -->
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" value="<?php echo $data['subtotal']; ?>" id="uraian" onchange="kali()" name="txttotal" placeholder="0" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Input Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="txtketerangan"><?php echo $data['keterangan']; ?></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <input type="submit" name="btnedit" class="btn btn-danger pull-right" value="Ubah">
            </div>
    </div>
    </form>
    <?php
    if (isset($_POST["btnedit"])) {
        $txtjumlah = mysqli_real_escape_string($konek, $_POST['txtjumlah']);
        $txttotal = mysqli_real_escape_string($konek, $_POST['txttotal']);
        $txtketerangan = mysqli_real_escape_string($konek, $_POST['txtketerangan']);


        $edit = mysqli_query($konek, "UPDATE  detail_pesanan SET jumlah='$txtjumlah',subtotal='$txttotal',keterangan='$txtketerangan' WHERE kode='$id'");
        if ($edit) {
            ?>
            <script type="text/javascript">
                document.location.href = "beranda.php?page=keranjang";
            </script>
        <?php
        } else {
            echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
            echo "<meta http-equiv='refresh' content='0; url=?page=edit_pesanan'>";
        }
    }
    ?>

</div>
</div>