<div class="modal-header">
  

  <div class="callout callout-warning">
                <h4>SELAMAT DATANG DI PEDALINK COFFE</h4>
                <p>Selamat Bekerja</p>
              </div>
</div>
<div class="col-lg-3 col-xs-6">
  <div class="small-box bg-red">
    <?php
    $menu = mysqli_query($konek, "SELECT * from menu");
    $total_menu = mysqli_num_rows($menu);
    ?>
    <div class="inner">
      <h3><?php echo $total_menu; ?></h3>
      <p>JUMLAH MENU</p>
    </div>
    <div class="icon">
      <i class="fa fa-cart-arrow-down"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <?php
  $pengguna = mysqli_query($konek, "SELECT * FROM pengguna");
  $user_login = mysqli_num_rows($pengguna);
  ?>
  <div class="small-box bg-orange">
    <div class="inner">
      <h3><?php echo $user_login; ?> </h3>
      <p>JUMLAH PENGGUNA</p>
    </div>
    <div class="icon">
      <i class="fa fa-user-plus"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <?php
  $jumlah_meja = mysqli_query($konek, "SELECT * FROM meja");
  $meja = mysqli_num_rows($jumlah_meja);
  ?>
  <div class="small-box bg-green">
    <div class="inner">
      <h3><?php echo $meja; ?> </h3>
      <p>JUMLAH MEJA</p>
    </div>
    <div class="icon">
      <i class="fa fa-cutlery"></i>
    </div>
  </div>
</div>
<div class="col-lg-3 col-xs-6">
  <?php
  $kategori = mysqli_query($konek, "SELECT * from kategori");
  $jumlah_kategori = mysqli_num_rows($kategori);
  ?>
  <div class="small-box bg-blue">
    <div class="inner">
      <h3><?php echo $jumlah_kategori; ?> </h3>

      <p>JUMLAH KATEGORI</p>
    </div>
    <div class="icon">
      <i class="fa fa-users"></i>
    </div>
  </div>
</div>
</div>

<!-- <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-user-plus"></i>Hallo. Selamat Datang</h4> <br>
    <p> SISTEM INFORMASI KAFE </p>
  </div> -->

  