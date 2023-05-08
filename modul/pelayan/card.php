<?php
class Item
{
	var $kode;
	var $nama;
	var $harga;

	var $quantity;
}
?>
<?php
session_start();
if (isset($_GET['id']) && !isset($_POST['update'])) {
	$sql = "SELECT * FROM menu WHERE kode=" . $_GET['id'];
	$result = mysqli_query($konek, $sql);
	$data = mysqli_fetch_object($result);
	$item = new Item();
	$item->kode = $data->kode;
	$item->nama = $data->nama;
	$item->harga = $data->harga;

	$item->quantity = 1;

	$index = -1;
	$cart = unserialize(serialize($_SESSION['cart'])); //  array
	for ($i = 0; $i < count($cart); $i++)
		if ($cart[$i]->kode == $_GET['id']) {
			$index = $i;
			break;
		}
	if ($index == -1)
		$_SESSION['cart'][] = $item;
	else {

		if (($cart[$index]->quantity) < $iteminstock)
			$cart[$index]->quantity++;
		$_SESSION['cart'] = $cart;
	}
}
if (isset($_GET['index']) && !isset($_POST['update'])) {
	$cart = unserialize(serialize($_SESSION['cart']));
	unset($cart[$_GET['index']]);
	$cart = array_values($cart);
	$_SESSION['cart'] = $cart;
}
// Update quantity in cart
if (isset($_POST['update'])) {
	$arrQuantity = $_POST['quantity'];
	$cart = unserialize(serialize($_SESSION['cart']));
	for ($i = 0; $i < count($cart); $i++) {
		$cart[$i]->quantity = $arrQuantity[$i];
	}
	$_SESSION['cart'] = $cart;
}
?>
<div class="col-md-12">
	<div class="box box-success">
		<form method="POST">
			<div class="box-header with-border">
				<h3 class="box-title">KERANJANGAN PESANAN</h3>
				<br><br>



				<div class="form-group">
					<select name="cbpesanan" class="form-control select2" style="width: 100%;">
						<?php
						$qry = mysqli_query($konek, "select `header_pesanan`.`kode` AS `kode`,`header_pesanan`.`id_pengguna` AS `id_pengguna`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status`,`header_pesanan`.`total` AS `total`,`pengguna`.`nama_pengguna` AS `nama_pengguna` from (`header_pesanan` join `pengguna` on((`pengguna`.`kode` = `header_pesanan`.`id_pengguna`))) where (`header_pesanan`.`status` = 'Proses')");
						while ($d = mysqli_fetch_array($qry)) { ?>
						<option class="form-control" value="<?php echo $d["kode"]; ?>"> No Meja : <?php echo $d['kode_meja']; ?>
						</option>
						<?php } ?>
					</select>
				</div>




				<a href="beranda.php?page=tambah_menu" class="btn btn-warning fa fa-shopping-cart"> Tambah Menu</a>
			</div>

			<div class="box-body table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
						<tr>
							<th>KODE</th>
							<th>NAMA</th>
							<th>HARGA</th>
							<th>JUMLAH</th>
							<th>TOTAL</th>
							<th>AKSI</th>
						</tr>
						<?php
						$cart = unserialize(serialize($_SESSION['cart']));
						$s = 0;
						$index = 0;
						for ($i = 0; $i < count($cart); $i++) {
							$s += $cart[$i]->harga * $cart[$i]->quantity;
							?>
						<tr>
							<td>MN-<?php echo $cart[$i]->kode; ?> </td>
							<td> <?php echo $cart[$i]->nama; ?> </td>

							<td>Rp. <?php echo (number_format($cart[$i]->harga)); ?> </td>
							<td width="8%"> <input type="number" class="form-control" min="1" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]"> </td>
							<td> Rp.<?php echo (number_format($cart[$i]->harga * $cart[$i]->quantity)); ?> </td>
							<td>
								<a href="beranda.php?page=card_1&index=<?php echo $index; ?>" class="btn btn-danger fa fa-close"> Hapus</a>
							</td>
						</tr>
						<?php
							$index++;
						} ?>
						<tr>
							<td class="3" style="text-align:right; font-weight:bold"> Total</td>
							<td></td>
							<td></td>
							<td>
								<input id="saveimg" type="image" src="gambar/edit.jpg" width="50px" height="50px" name="update" alt="Save Button">
								<input type="hidden" name="update">
							</td>
							<td> Rp.<?php echo (number_format($s)); ?> </td>
							<td></td>
						</tr>
						</tfoot>
				</table>
		</form>
		<br>
		<input type="submit" name="btnsimpan" class="btn btn-success pull-right fa fa-sign-out" value="Check Out">
		<!-- <p align="right"><a href="beranda.php?page=chekout" class="btn btn-danger fa fa-sign-out"> Check Out</a> </p> -->
		<?php
		if (isset($_POST["btnsimpan"])) {
			session_start();
			$cbpesanan = mysqli_real_escape_string($konek, $_POST['cbpesanan']);
			$cart = unserialize(serialize($_SESSION['cart']));
			for ($i = 0; $i < count($cart); $i++) {

				$sql2 = 'INSERT INTO detail_pesanan (id_menu, id_pesanan, harga, jumlah) VALUES (' . $cart[$i]->kode . ', ' . $cbpesanan . ', ' . $cart[$i]->harga . ', ' . $cart[$i]->quantity . ')';
				mysqli_query($konek, $sql2);
			}
			if ($sql2) {
				?>
		<script type="text/javascript">
			document.location.href = "beranda.php?page=daftar_pesanan";
		</script>
		<?php
			} else {
				echo "<script>alert('Data Anda Gagal di simpan')</script>";
				echo "<meta http-equiv='refresh' content='0; url=?page=card_1'>";
			}


			unset($_SESSION['cart']);
		}
		?>
	</div>
</div>
</div>
</div>