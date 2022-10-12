<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pengguna
      <small>Data Pengguna</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Pengguna</h3>
            <a href="user_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Pengguna Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>LEVEL</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM user");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['user_nama']; ?></td>
                      <td><?php echo $d['user_username']; ?></td>
                      <td><?php echo $d['user_level']; ?></td>
                      <td>
                        <center>
                          <?php if($d['user_foto'] == ""){ ?>
                            <img src="../gambar/sistem/user.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/user/<?php echo $d['user_foto'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="user_edit.php?id=<?php echo $d['user_id'] ?>"><i class="fa fa-cog"></i></a>
                        <?php if($d['user_id'] != 1){ ?>
                          <a class="btn btn-danger btn-sm" href="user_hapus.php?id=<?php echo $d['user_id'] ?>"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php 
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>