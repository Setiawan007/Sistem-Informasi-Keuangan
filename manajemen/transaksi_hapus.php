<?php 
include '../koneksi.php';
$id  = $_GET['id'];


$transaksi = mysqli_query($koneksi,"select * from transaksi where transaksi_id='$id'");
$t = mysqli_fetch_assoc($transaksi);
$bank_lama = $t['transaksi_bank'];

$rekening = mysqli_query($koneksi,"select * from bank where bank_id='$bank_lama'");
$r = mysqli_fetch_assoc($rekening);

$jenis = $t['transaksi_jenis'];
$nominal = $t['transaksi_nominal'];

if($jenis == "Pemasukan"){

	$saldo_sekarang = $r['bank_saldo'];
	$total = $saldo_sekarang-$nominal;
	mysqli_query($koneksi,"update bank set bank_saldo='$total' where bank_id='$bank_lama'");

}elseif($jenis == "Pengeluaran"){

	$saldo_sekarang = $r['bank_saldo'];
	$total = $saldo_sekarang+$nominal;
	mysqli_query($koneksi,"update bank set bank_saldo='$total' where bank_id='$bank_lama'");

}	


mysqli_query($koneksi, "delete from transaksi where transaksi_id='$id'");
header("location:transaksi.php");