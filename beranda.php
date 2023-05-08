<?php include 'koneksi.php';
error_reporting(0);
?>
<?php
session_start();
if ($_SESSION['level'] == "") {
  header("location:index.php?pesan=login");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PEDALINK COFFE </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <script>
    function printContent(el) {
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
    }
  </script>
</head>

<body class="hold-transition skin-green sidebar-mini"></body>
<div class="wrapper">
  <header class="main-header">
    <a href="beranda.php?page=beranda" class="logo">
      <span class="logo-mini"><b>P</b>C</span>
      <span class="logo-lg"><b></b> PEDALINK COFFE</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- PEMBERITAHUAN -->
          <li class="dropdown notifications-menu">

          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="gambar/dll/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['level']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="gambar/dll/user.png" class="img-circle" alt="User Image">
                <h4>KAFE</h4>
                <H5>Login : <?php echo $_SESSION['level'] ?></H5>
              </li>
              <li class="user-body">
                <div class="row">
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="keluar_admin.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="gambar/dll/user.png" class="img-circle" alt="All">
        </div>
        <div class="pull-left info">
          <p>Status Anda</p>
          <p><?php echo $_SESSION['level'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i></a>
        </div>
      </div>
      <br>
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="beranda.php?page=beranda"><i class="fa fa-chevron-circle-right"></i> <span>BERANDA</span></a></li>


        <?php
        session_start();
        if ($_SESSION['level'] == "Pemilik") {
          echo "

          <li><a href='beranda.php?page=tampil_menu'><i class='fa fa-send'></i> <span>Daftar Menu</span></a></li>

          <li><a href='beranda.php?page=kategori'><i class='fa fa-chevron-circle-right'></i> <span>Data Kategori</span></a></li>
        
        <li><a href='beranda.php?page=user'><i class='fa fa-expeditedssl'></i> <span>Data Pengguna</span></a></li>
        <li><a href='beranda.php?page=meja'><i class='fa fa-hourglass-2 '></i> <span>Data Meja</span></a></li>
        

        <li><a href='beranda.php?page=laporan_transaksi'><i class='fa fa-database'></i> <span>Laporan Penjualan</span></a></li> ";
        } else if ($_SESSION['level'] == "Dapur") {
          echo "
          <li><a href='beranda.php?page=update_menu'><i class='fa fa-chevron-circle-right'></i> <span>Update Menu</span></a></li> 
          <li><a href='beranda.php?page=pesanan_dapur'><i class='fa fa-chevron-circle-right'></i> <span>Pesanan</span></a></li>
          ";
        } else if ($_SESSION['level'] == "Pelayan") {
          echo "
          <li><a href='beranda.php?page=mutasi_meja'><i class='fa fa-coffee '></i> <span>Meja</span></a></li>
          <li><a href='beranda.php?page=order_meja'><i class='fa fa-hourglass '></i> <span>Pesanan</span></a></li>
          <li><a href='beranda.php?page=daftar_pesanan'><i class='fa fa-briefcase '></i> <span>Daftar Pesanan</span></a></li>
          <li><a href='beranda.php?page=detail_pesanan'><i class='fa fa-beer '></i> <span>Detail Pesanan</span></a></li>



          ";
        } else if ($_SESSION['level'] == "Kasir") {
          echo "
          <li><a href='beranda.php?page=daftar_bayar'><i class='fa fa-check-circle '></i> <span>Pembayaran</span></a></li>
          <li><a href='beranda.php?page=detail_transaksi'><i class='fa fa-calendar-check-o '></i> <span>Transaksi</span></a></li>


          
          ";
        }
        ?>

        <li><a href="keluar_admin.php"><i class="fa fa-chevron-circle-right"></i> <span>Keluar</span></a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <!-- Akses Halaman Lain -->

        <?php
        if (isset($_GET['page'])) {
          $page = $_GET['page'];
          switch ($page) {

              // Untuk Pemilik
            case 'meja':
              include "modul/meja/index.php";
              break;
            case 'edit_meja':
              include "modul/meja/edit.php";
              break;

            case 'kategori':
              include "modul/kategori/index.php";
              break;
            case 'edit_kategori':
              include "modul/kategori/edit.php";
              break;

            case 'user':
              include "modul/pengguna/index.php";
              break;
            case 'edit_user':
              include "modul/pengguna/edit.php";
              break;

            case 'menu':
              include "modul/menu/index.php";
              break;

            case 'edit_menu':
              include "modul/menu/edit.php";
              break;
            case 'tampil_menu':
              include "modul/menu/daftar_menu.php";
              break;

            case 'laporan_menu':
              include "modul/menu/laporan_menu.php";
              break;

            case 'laporan_reservasi':
              include "modul/laporan/laporan_reservasi.php";
              break;
            case 'laporan_transaksi':
              include "modul/laporan/laporan_transaksi.php";
              break;

            case 'laporan_favorit':
              include "modul/laporan/laporan_barang.php";
              break;
              // Untuk Dapur
            case 'update_menu':
              include "modul/dapur/update_menu.php";
              break;
            case 'pesanan_dapur':
              include "modul/dapur/pesanan.php";
              break;
              // Akhir

              // Untuk Pelayan
            case 'order_meja':
              include "modul/pelayan/index.php";
              break;
            case 'tambah_menu':
              include "modul/pelayan/tambah_menu.php";
              break;
            case 'keranjang':
              include "modul/pelayan/keranjang.php";
              break;

            case 'edit_pesanan':
              include "modul/pelayan/edit_pesanan.php";
              break;

            case 'daftar_pesanan':
              include "modul/pelayan/daftar_pesanan.php";
              break;

            case 'lihat_pesanan':
              include "modul/pelayan/lihat_pesanan.php";
              break;
            case 'detail_pesanan':
              include "modul/pelayan/detail_pesanan.php";
              break;

            case 'mutasi_meja':
              include "modul/pelayan/mutasi_meja.php";
              break;


              // Baru
            case 'card_1':
              include "modul/pelayan/card.php";
              break;

            case 'card_2':
              include "modul/kasir/card2.php";
              break;


            case 'chekout':
              include "modul/pelayan/chekout.php";
              break;



              // Akhir

              // BAYAR
            case 'daftar_bayar':
              include "modul/kasir/daftar_bayar.php";
              break;
            case 'detail_pembayaran':
              include "modul/kasir/detail_pembayaran.php";
              break;
            case 'pilih_menu':
              include "modul/kasir/pilih_menu.php";
              break;
            case 'lihat_pembayaran':
              include "modul/kasir/lihat_pembayaran.php";
              break;

            case 'detail_transaksi':
              include "modul/kasir/detail_transaksi.php";
              break;


              // AKHIR
            case 'beranda':
              include "modul/halaman_utama/index.php";
              break;
            default:
              include "modul/gagal/index.php";
              break;
          }
        } else {
          include "modul/halaman_utama/index.php";
        }
        ?>

      </div>

    </section>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">

      </div>
      <strong>2021 <a href="#"> PEDALINK COFFE </a></strong>
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script src="bower_components/ckeditor/ckeditor.js"></script>

  <script type="text/javascript">
    CKEDITOR.replace('alamat', {
      height: 150
    });
  </script>
  <script>
    $(function() {
      $('.select2').select2()
     
    })
  </script>
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script>
    $(function() {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': false,
        'ordering': false,
        'info': false,
        'autoWidth': false
      })

      $('#example3').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': false,
        'autoWidth': false
      })

    })
  </script>

  </body>

</html>