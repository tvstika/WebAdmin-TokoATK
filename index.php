<?php
session_start();

if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}

require'functions.php';

$produk=query("SELECT * FROM produk");

//tombol cari diklik
if(isset($_POST["cari"])){
    $produk=cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TOKO ATK | Daftar Produk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form action="" method="post" class="from-inline">
              <div class="input-group input-group-sm">
              <input class="form-control form-control-lg" type="text" name="keyword" autofocus placeholder="Cari produk" autocomplete="off" aria-label="Search">
                <div class="input-group-append">
                <button type="submit" name="cari" class="btn btn-lg btn-default">
                <i class="fa fa-search"></i>
                </button>
                </div>
            </div>
          </form>
        </div>
      </li>

      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="assets/index3.html" class="brand-link">
      <span class="brand-text font-weight-light">TOKO <br> ALAT TULIS KANTOR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="gambar/blankprofile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TOKO ALAT TULIS KANTOR</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Produk</h3>
                <div class="card-tools">
                <ul class="pagination pagination-center"></ul>
                </div>
                <div class="card-tools">
                  <form action="" method="post">
                  <div class="input-group input-group-sm" style="width: 550px;">
                  <input type="text" name="keyword" class="form-control float-right" placeholder="Cari Produk" autofocus>
                    <div class="input-group-append">
                    <button type="submit" name="cari" class="btn btn-default" style="height: 31px; vertical-align: middle;" >
                    <i class="fas fa-search"></i>
                    </button>
                  </div>
                  </form>
                    <div>
                    <a type="button" class="btn btn-primary float-right" href="tambah.php" style="margin-left: 10px;" >
                    <i class="fas fa-plus"></i>
                    Tambah Data Produk</a>
                    </div>
                  </div>
                </div> 
                </div>
                <div>

             
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Id Produk</th>
                      <th>Nama Produk</th>
                      <th>Harga Produk</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i =1;?>
                    <?php foreach($produk as $row):?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?= $row["id_produk"]; ?></td>
                        <td><?= $row["nama_produk"]; ?></td>
                        <td><?= $row["harga_produk"]; ?></td>
                        <td><img src="gambar/<?= $row["gambar_produk"]; ?>" width="50"></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="ubah.php?id_produk=<?= $row["id_produk"]; ?>">
                            <i class="fas fa-pencil-alt"></i>
                            ubah</a>
                            <a class="btn btn-danger btn-sm" href="hapus.php?id_produk=<?= $row["id_produk"]; ?>" onclick="return confirm('Hapus produk ini?');">
                            <i class="fas fa-trash"></i>
                            hapus</a>
                        </td>
                    </tr>
                    <?php $i++;?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
