<?php
session_start();
include 'koneksi.php';
// munculkan atau pilih  sebuah atau semua kolom dari table user
$tanggal_dari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
$tanggal_sampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$query = "SELECT customer.customer_name, trans_order.* FROM trans_order LEFT JOIN customer ON customer.id=trans_order.id_customer WHERE 1";

if ($tanggal_dari != '') {
    $query .= " AND order_date >= '$tanggal_dari'";
}

if ($tanggal_sampai != '') {
    $query .= " AND order_date <= '$tanggal_sampai'";
}

// jika status tidak kosong
if ($status != '') {
    $query .= " AND order_status = '$status'";
}


$query .= " ORDER BY trans_order.id DESC";

$queryTrans = mysqli_query($koneksi, $query);

// pake mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object, array)
// $dataUser = mysqli_fetch_assoc($queryUser);
// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
    $id =  $_GET['delete']; // untuk mengambil nilai parameter
    //masukin $query untuk melakukan perintah yg diinginkan
    $delete  = mysqli_query($koneksi, "DELETE FROM trans_order WHERE id = '$id'");
    header("location:laporan.php?hapus=berhasil");
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
                                    <h3 class="card-header m-0 font-weight-bold text-primary">Laporan</h3>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>
                                       <!-- filter data transaksi -->
                                        <form action="" method="get">
                                            <div class="mb-4 row">
                                                <div class="col-sm-3">
                                                    <label for="">Tanggal dari</label>
                                                    <input type="date" name="tanggal_dari" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Tanggal sampai</label>
                                                    <input type="date" name="tanggal_sampai" class="form-control">
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="">--Pilih Status--</option>
                                                        <option value="0">Baru</option>
                                                        <option value="1">Sudah Dikembalikan</option>
                                                    </select>
                                                </div>

                                                
                                                <div class="col-sm-3" style="margin-top: 30px;">
                                                    <button name="filter" class="btn btn-primary">Tampilkan Laporan</button>
                                                    <a href="print-pimpinan.php" class="btn btn-warning ml-3">Print Laporan</a>
                                                </div>
                                                
                                            </div>
                                        </form>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Invoice</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tanggal Laundry</th>
                                                    <th>Status</th>

                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($rowTrans = mysqli_fetch_assoc($queryTrans)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $rowTrans['order_code'] ?></td>
                                                        <td><?php echo $rowTrans['customer_name'] ?></td>
                                                        <td><?php echo $rowTrans['order_date'] ?></td>
                                                        <td>
                                                            <?php
                                                            switch ($rowTrans['order_status']) {
                                                                case '1':
                                                                    $badge = "<span class='badge bg-success'>Sudah dikembalikan</span>";
                                                                    break;
                                                                default:
                                                                    $badge = "<span class='badge bg-warning'>Baru</span>";
                                                                    break;
                                                            }
                                                            echo $badge;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            
                                                            <?php
                                                            if ($rowTrans['order_status'] == '1') { // Order status = 1
                                                                echo '<a href="tambah-trans-pickup.php?detail_laporan=' . $rowTrans['id'] . '" class="btn btn-primary btn-sm">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                    </a>';
                                                            } else { // Order status = 0
                                                                echo '<a href="tambah-transaksi.php?detail=' . $rowTrans['id'] . '" class="btn btn-primary btn-sm">
                                                                <i class="fa-solid fa-eye"></i>
                                                                </a>';
                                                            }
                                                            ?>
                                                            <a target="_blank" href="print-laporan2.php?id=<?php echo $rowTrans['id'] ?>" class="btn btn-success btn-sm">
                                                            <i class="fa-solid fa-print"></i>
                                                            </a>
                                                            
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