<?php

use Models\Pemasukan;
use Models\Pengeluaran;
use Session\Auth;

if (!Auth::check()) {
  redirect('login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Laporan Keuangan</title>

  <!-- Custom fonts for this template -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
  require 'partials/sidebar.php'; ?>

  <!-- Main Content -->
  <div id="content">

    <?php require 'partials/navbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Jumlah Transaksi </th>
                  <th>Jumlah Total Uang</th>
                  <th>Download</th>
                </tr>
              </thead>
              <tfoot>
              </tfoot>
              <tbody>
                <?php
                $pemasukan = new Pemasukan();
                $pengeluaran = new Pengeluaran();

                $pemasukans = $pemasukan->findByUser(Auth::user()->id_user);
                $pengeluarans = $pengeluaran->findByUser(Auth::user()->id_user);

                $jumlahmasuk = 0;
                $jumlahkeluar = 0;

                foreach ($pemasukans as $masuk) {
                  $jumlahmasuk += $masuk->jumlah;
                }
                
                foreach ($pengeluarans as $keluar) {
                  $jumlahkeluar += $keluar->jumlah;
                }

                $query1 = count($pemasukans);
                $query2 = count($pengeluarans);
                ?>
                <tr>
                  <td>Pemasukan</td>
                  <td><?= $query1 ?></td>
                  <td>Rp. <?= number_format($jumlahmasuk, 2, ',', '.'); ?></td>
                  <td>
                    <!-- Button untuk modal -->
                    <a href="index.php?page=export-pemasukan" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
                  </td>
                </tr>

                <tr>
                  <td>Pengeluaran</td>
                  <td><?= $query2 ?></td>
                  <td>Rp. <?= number_format($jumlahkeluar, 2, ',', '.'); ?></td>
                  <td>
                    <!-- Button untuk modal -->
                    <a href="index.php?page=export-pengeluaran" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
                  </td>
                </tr>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <?php require 'partials/footer.php' ?>

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require 'partials/logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>