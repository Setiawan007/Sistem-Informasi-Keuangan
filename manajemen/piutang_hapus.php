<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from piutang where piutang_id='$id'");
header("location:piutang.php");