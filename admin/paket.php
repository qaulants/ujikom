<?php 
session_start();
include "koneksi.php";

$queryPaket = mysqli_query($koneksi,  "SELECT * FROM type_of_service ORDER BY id DESC"); //paket
// pake mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $dataUser = mysqli_fetch_assoc($queryUser);
// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
  $id =  $_GET['delete']; // untuk mengambil nilai parameter
  //masukin $query untuk melakukan perintah yg diinginkan
  $delete  = mysqli_query($koneksi, "DELETE FROM type_of_service WHERE id = '$id'");
  header("location:paket.php?hapus=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <?php include 'inc/head.php' ?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'inc/navbar.php' ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-primary">Paket</h3></div>
                    <div class="card-body">
                    <?php if (isset($_GET['hapus'])): ?>
                      <div class="alert alert-success" role="alert">
                        Data berhasil dihapus
                      </div>
                    <?php endif ?>
                    <div align="right" class="mb-3">
                      <a href="tambah-paket.php" class="btn btn-primary">Tambah</a>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Paket</th>
                          <th>Harga</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        while ($rowPaket = mysqli_fetch_assoc($queryPaket)) { ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $rowPaket['service_name'] ?></td>
                            <td><?php echo "Rp" . number_format($rowPaket['price']) ?></td>
                            <td><?php echo $rowPaket['description'] ?></td>
                            <td>
                              <a href="tambah-paket.php?edit=<?php echo $rowPaket['id'] ?>" class="btn btn-success btn-sm">
                              <i class="fa-solid fa-pen-to-square"></i></a>
                              <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                href="paket.php?delete=<?php echo $rowPaket['id'] ?>" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include 'inc/footer.php' ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- js -->
  <?php include 'inc/js.php' ?>
</body>

</html>