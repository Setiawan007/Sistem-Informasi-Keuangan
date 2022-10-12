<?php 
include '../koneksi.php';
$tanggal  = $_POST['tanggal'];
$jenis  = $_POST['jenis'];
$kategori  = $_POST['kategori'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];
$bank  = $_POST['bank'];

$rand = rand();
$allowed =  array('jpg','jpeg','pdf');
$filename = $_FILES['trnfoto']['name'];

$rekening = mysqli_query($koneksi,"select * from bank where bank_id='$bank'");
$r = mysqli_fetch_assoc($rekening);

if($jenis == "Pemasukan"){

	$saldo_sekarang = $r['bank_saldo'];
	$total = $saldo_sekarang+$nominal;
	mysqli_query($koneksi,"update bank set bank_saldo='$total' where bank_id='$bank'");

}elseif($jenis == "Pengeluaran"){

	$saldo_sekarang = $r['bank_saldo'];
	$total = $saldo_sekarang-$nominal;
	mysqli_query($koneksi,"update bank set bank_saldo='$total' where bank_id='$bank'");

}

if($filename == ""){
	mysqli_query($koneksi, "insert into transaksi values (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan','','$bank')")or die(mysqli_error($koneksi));
	header("location:transaksi.php?alert=berhasil");
}else{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$allowed) ) {
		header("location:transaksi.php?alert=gagal");
	}else{
		move_uploaded_file($_FILES['trnfoto']['tmp_name'], '../gambar/bukti/'.$rand.'_'.$filename);
		$file_gambar = $rand.'_'.$filename;
		mysqli_query($koneksi, "insert into transaksi values (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan','$file_gambar','$bank')");
		header("location:transaksi.php?alert=berhasil");
	}
}

// mysqli_query($koneksi, "insert into transaksi values (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan','$bank')")or die(mysqli_error($koneksi));
// header("location:transaksi.php");