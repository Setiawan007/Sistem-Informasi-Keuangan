<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from user where user_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['user_foto'];
unlink("../gambar/user/$foto");
mysqli_query($koneksi, "delete from user where user_id='$id'");
header("location:user.php");
