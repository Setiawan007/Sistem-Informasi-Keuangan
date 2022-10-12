<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "update hutang set hutang_tanggal='$tanggal', hutang_nominal='$nominal', hutang_keterangan='$keterangan' where hutang_id='$id'") or die(mysqli_error($koneksi));
header("location:hutang.php");