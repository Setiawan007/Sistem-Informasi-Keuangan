<?php 
include '../koneksi.php';
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "insert into kategori values (NULL,'$kategori')");
header("location:kategori.php");