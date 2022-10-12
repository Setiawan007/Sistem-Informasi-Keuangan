<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update transaksi set transaksi_bank='1' where transaksi_bank='$id'");

mysqli_query($koneksi, "delete from bank where bank_id='$id'");
header("location:bank.php");