<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $customer_name = $_POST['customer_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $insert =  mysqli_query($koneksi, "INSERT INTO customer (	customer_name, phone, address) VALUES ('$customer_name', '$phone', '$address')");
  header("location:customer.php?tambah=berhasil");
}

$id  = isset($_GET['edit']) ?  $_GET['edit'] : '';
$editCustomer = mysqli_query($koneksi, "SELECT * FROM customer WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($editCustomer);

if (isset($_POST['edit'])) {
  $customer_name = $_POST['customer_name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];


  $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$customer_name', phone='$phone', address='$address' WHERE id = '$id'");
  header("location:customer.php?ubah=berhasil");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Customer</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                  <div class="mb-3 row">
                        <div class="col-sm-6 mb-3">
                          <label for="" class="form-label">Nama Pelanggan</label>
                          <input type="text" class="form-control" id="" name="customer_name" placeholder="Masukkan Nama customer" required
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>">
                        </div>

                        <div class="col-sm-6">
                          <label for="" class="form-label">Nomor Telepon</label>
                          <input type="number" class="form-control" id="" name="phone" placeholder="Masukkan no tlp customer" required
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>">
                        </div>
                        <div class="col-sm-6">
                          <label for="" class="form-label">Alamat</label>
                          <textarea type="text" placeholder="masukkan alamat" name="address" class="form-control" id="" col="15" rows="5"><?php echo isset($_GET['edit']) ? $rowEdit['address'] : '' ?></textarea>
                        </div>

                      </div>


                      <div class="mb-3">
                        <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                      </div>
                  </form>
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