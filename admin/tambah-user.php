<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $id_level = $_POST['id_level'];
  $nama = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $insert = mysqli_query($koneksi, "INSERT INTO user (id_level, name, email, password) VALUES ('$id_level','$nama','$email','$password')");
  header("location:user.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id' ");
$rowEdit = mysqli_fetch_assoc($editUser);
if (isset($_POST['edit'])) {
  $id_level = $_POST['id_level'];
  $nama = $_POST['name'];
  $email = $_POST['email'];

  if (isset($_POST['edit'])) {
    $password = $_POST['password'];
  } else {
    $password = $rowEdit['password'];
  }
  $update = mysqli_query($koneksi, "UPDATE user set id_level='$id_level', name='$nama', email='$email', password='$password' WHERE id = '$id'");
  header("location:user.php?ubah=berhasil");
}

$queryLevel = mysqli_query($koneksi, "SELECT * FROM level");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah User</title>

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
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> User</h4>
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                      <div class="col-sm-6">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="" name="name" placeholder="Masukkan Nama Anda" required
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['name'] : '' ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="" class="form-label">Nama Level</label>
                          <select name="id_level" class="form-control" id="">
                            <option value="">Pilih Level</option>
                            <?php while ($rowLevel = mysqli_fetch_assoc($queryLevel)): ?>
                              <option <?php echo isset($_GET['edit']) ? ($rowLevel['id'] == $rowEdit['id_level'] ? 'selected' : '') : '' ?> value="<?php echo $rowLevel['id'] ?>">
                                <?php echo $rowLevel['level_name'] ?>
                              </option>
                            <?php endwhile ?>
                          </select>
                      </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                          <label for="" class="form-label">Email</label>
                          <input type="email" class="form-control" id="" name="email" placeholder="Masukkan Email Anda" required
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                        </div>
                        <div class="col-sm-6">
                          <label for="" class="form-label">Username</label>
                          <input type="text" name="username" value="<?php echo isset($_GET['edit']) ? $rowEdit['username'] : '' ?>" class="form-control" id="">
                        </div>
                        
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                          <label for="" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="">
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