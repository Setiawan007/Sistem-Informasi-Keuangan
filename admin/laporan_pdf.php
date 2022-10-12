 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan Sistem Informasi Keuangan</title>

</head>
<body>

  <style type="text/css">
   
  </style>

  <center>
    <h4>LAPORAN <br/> Sistem Informasi Keuangan</h4>
  </center>

  <?php 
  include '../koneksi.php';
  // error_reporting(0);
  error_reporting(E_ALL ^ E_DEPRECATED);
  if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])){
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    $kategori = $_GET['kategori'];
    ?>

    <table>
      <tr>
        <th width="25%">DARI TANGGAL</th>
        <th width="5%">:</th>
        <td><?php echo date('d-m-Y',strtotime($tgl_dari)); ?></td>
      </tr>
      <tr>
        <th>SAMPAI TANGGAL</th>
        <th>:</th>
        <td><?php echo date('d-m-Y',strtotime($tgl_sampai)); ?></td>
      </tr>
      <tr>
        <th>KATEGORI</th>
        <th>:</th>
        <td><?php 
        if($kategori == "semua"){
          echo "SEMUA KATEGORI";
        }else{
          $k = mysqli_query($koneksi,"select * from kategori where kategori_id='$kategori'");
          $kk = mysqli_fetch_assoc($k);
          echo $kk['kategori'];
        }
        ?></td>
      </tr>
    </table>

    <br/>

    <table border="1">
      <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">TANGGAL</th>
        <th rowspan="2">KATEGORI</th>
        <th rowspan="2">KETERANGAN</th>
        <th colspan="2">JENIS</th>
      </tr>
      <tr>
        <th>PEMASUKAN</th>
        <th>PENGELUARAN</th>
      </tr>
      <?php 
      
      $no=1;
      $total_pemasukan=0;
      $total_pengeluaran=0;
       if($kategori == "semua"){
                      $data = mysqli_query($koneksi,"SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
                    }else{
                      $data = mysqli_query($koneksi,"SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and kategori_id='$kategori' and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
                    }
      while($d = mysqli_fetch_array($data)){

        if($d['transaksi_jenis'] == "Pemasukan"){
          $total_pemasukan += $d['transaksi_nominal'];
        }elseif($d['transaksi_jenis'] == "Pengeluaran"){
          $total_pengeluaran += $d['transaksi_nominal'];
        }
        ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
          <td><?php echo $d['kategori']; ?></td>
          <td><?php echo $d['transaksi_keterangan']; ?></td>
          <td><?php 
          if($d['transaksi_jenis'] == "Pemasukan"){
            echo "Rp. ".number_format($d['transaksi_nominal'])." ,-";
          }else{
            echo "-";
          }
          ?></td>
          <td><?php 
          if($d['transaksi_jenis'] == "Pengeluaran"){
            echo "Rp. ".number_format($d['transaksi_nominal'])." ,-";
          }else{
            echo "-";
          }
          ?></td>
        </tr>
        <?php 
      }
      ?>
      <tr>
        <th colspan="4">TOTAL</th>
        <td><?php echo "Rp. ".number_format($total_pemasukan)." ,-"; ?></td>
        <td><?php echo "Rp. ".number_format($total_pengeluaran)." ,-"; ?></td>
      </tr>
      <tr>
        <th colspan="4">SALDO</th>
        <td colspan="2"><?php echo "Rp. ".number_format($total_pemasukan - $total_pengeluaran)." ,-"; ?></td>
      </tr>
    </table>

    <?php 
  }else{
    ?>

    <div class="alert alert-info text-center">
      Silahkan Filter Laporan Terlebih Dulu.
    </div>

    <?php
  }
  ?>

  <?php 
  require_once("../library/dompdf/dompdf_config.inc.php");
  $dompdf = new DOMPDF();
  $dompdf->load_html(ob_get_clean());
  $dompdf->set_paper("A4", 'portrait');
  $dompdf->render();
  $dompdf->stream("Laporan.pdf");    
  ?>

</body>
</html>
