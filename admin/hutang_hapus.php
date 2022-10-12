<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from hutang where hutang_id='$id'");
header("location:hutang.php");