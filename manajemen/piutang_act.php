<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "insert into piutang values (NULL,'$tanggal','$nominal','$keterangan')")or die(mysqli_error($koneksi));
header("location:piutang.php");