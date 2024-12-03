<?php
session_start();
include "koneksi.php";

function loginQuery($koneksi, $kolom, $params)
{
  $query = mysqli_query($koneksi,"SELECT * FROM user WHERE $kolom = '$params' ");
  if(mysqli_num_rows($query) > 0)
  {
    return $query;
  } else {
    return false;
  }
}

if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $queryLogin = loginQuery($koneksi, 'username', $email);
  $queryEmail = loginQuery($koneksi, 'email', $email);

  // jika login dengan username
  if($queryLogin){
    $rowLogin = mysqli_fetch_assoc($queryLogin);
    if($password == $rowLogin['password']){
      $_SESSION['nama'] = $rowLogin['name'];
      $_SESSION['id'] = $rowLogin['id'];
      $_SESSION['id_level'] = $rowLogin['id_level'];
      header("location:index.php");
    } else{
      header("location:login.php?login=gagal");
    }
  }elseif($queryEmail) {
    $rowLogin = mysqli_fetch_assoc($queryEmail);
    if($password == $rowLogin['password']){
      $_SESSION['nama'] = $rowLogin['name'];
      $_SESSION['id'] = $rowLogin['id'];
      $_SESSION['id_level'] = $rowLogin['id_level'];
      header("location:index.php");
    } else {
      header("location:login.php?login=gagal");
    }
  }

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

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-size: cover; background-color:#191f36; ">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">

              <div class="col-lg-7">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user"
                        name="email" aria-describedby="emailHelp"
                        placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user"
                        name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    <!-- <a href="index.php" name="masuk" class="btn btn-primary btn-user btn-block mb-4">
                      Login
                    </a> -->
                    <button class="btn btn-user btn-block mb-4" name="login" type="submit" style="background-color:#191f36; ">
                      <h6 style="color: white;">Login</h6></button>


                  </form>

                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>