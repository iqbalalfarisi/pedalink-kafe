<div class="col-md-12">
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">PESANAN ANDA SUDAH DI PROSES</h3><BR><BR>

        </div>

        <?php
        class Item
        {
            var $kode;
            var $nama;
            var $harga;
            var $tanggal;
            var $quantity;
        }
        ?>
        <?php
        session_start();
        error_reporting(0);
        $cbpesanan = mysqli_real_escape_string($konek, $_POST['cbpesanan']);
        $cart = unserialize(serialize($_SESSION['cart']));
        for ($i = 0; $i < count($cart); $i++) {
            $sql2 = 'INSERT INTO detail_pesanan (id_menu, id_pesanan, harga, jumlah) VALUES (' . $cart[$i]->kode . ', ' . $cbpesanan . ', ' . $cart[$i]->harga . ', ' . $cart[$i]->quantity . ')';
            mysqli_query($konek, $sql2);
        }
        // Clear all product in cart

        unset($_SESSION['cart']);
        ?>

    </div>
</div>
</div>