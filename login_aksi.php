<?php
session_start();
include 'koneksi.php';
$username = (mysqli_real_escape_string($konek, $_POST['username']));
$password = md5((mysqli_real_escape_string($konek, $_POST['password'])));
$login = mysqli_query($konek, "SELECT * from pengguna where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['level'] == "Pemilik") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Pemilik";
        header("location:beranda.php");
    } else if ($data['level'] == "Dapur") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Dapur";
        header("location:beranda.php");
    } else if ($data['level'] == "Pelayan") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Pelayan";
        header("location:beranda.php");
    } else if ($data['level'] == "Kasir") {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "Kasir";
        header("location:beranda.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
} else {
    header("location:index.php?pesan=gagal");
}
