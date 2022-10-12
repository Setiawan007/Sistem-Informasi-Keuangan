<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$pemilik  = $_POST['pemilik'];
$nomor  = $_POST['nomor'];
$saldo  = $_POST['saldo'];

mysqli_query($koneksi, "update bank set bank_nama='$nama', bank_pemilik='$pemilik', bank_nomor='$nomor', bank_saldo='$saldo' where bank_id='$id'") or die(mysqli_error($koneksi));
header("location:bank.php");