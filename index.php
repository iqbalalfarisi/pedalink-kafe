<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KAFE</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="bower_components/DataTables/datatables.min.css" />
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>PEDALINK COFFE</a>
    </div>
    <div class="login-box-body">
      <!-- <p class="login-box-msg">LOGIN</p> -->
      <form action="login_aksi.php" method="post">
        <label>User</label>
        <input type="text" name="username" class="form-control" placeholder="User Name" required="required">
        <br>
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password ***" required="required">

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary "> LOGIN</button>
        </div>
      </form>
      <?php
      if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
          echo "<div class='alert alert-danger'>User Untuk Login di sistem Tidak ditemukan</div>";
        } else if ($_GET['pesan'] == "login") {
          echo "<div class='alert alert-warning'>Anda Harus Login ke database</div>";
        } else if ($_GET['pesan'] == "keluar") {
          echo "<div class='alert alert-success'>Terimakasih Anda Berhasil Keluar</div>";
        }
      }
      ?>
    </div>

  </div>

</body>

</html>