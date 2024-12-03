<?php
session_start();
include 'koneksi.php';

$queryCustomer = mysqli_query($koneksi, "SELECT * FROM customer");

$id = isset($_GET['detail_ambil']) ? $_GET['detail_ambil'] : '';
$queryTransDetail = mysqli_query($koneksi, "SELECT customer.customer_name, customer.phone, customer.address, 
trans_order.order_code, trans_order.order_date, trans_order.order_end_date, trans_order.order_payment, trans_order.order_change, trans_order.order_status, trans_order.id_customer, 
type_of_service.service_name, type_of_service.price, trans_order_detail.* FROM trans_order_detail 
LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service 
LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order 
LEFT JOIN customer ON customer.id = trans_order.id_customer
WHERE trans_order_detail.id_order='$id' ");

$id_dua = isset($_GET['detail_laporan']) ? $_GET['detail_laporan'] : '';
$queryTransDetail1 = mysqli_query($koneksi, "SELECT customer.customer_name, customer.phone, customer.address, 
trans_order.order_code, trans_order.order_date, trans_order.order_end_date, trans_order.order_payment, trans_order.order_change, trans_order.order_status, trans_order.id_customer, 
type_of_service.service_name, type_of_service.price, trans_order_detail.* FROM trans_order_detail 
LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service 
LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order 
LEFT JOIN customer ON customer.id = trans_order.id_customer
WHERE trans_order_detail.id_order='$id_dua' ");

$row_dua = [];
while ($dataTrans1 = mysqli_fetch_assoc($queryTransDetail1)) {
    $row_dua[] = $dataTrans1;
}

$row = [];
while ($dataTrans = mysqli_fetch_assoc($queryTransDetail)) {
    $row[] = $dataTrans;
}

$queryPaket = mysqli_query($koneksi, "SELECT * FROM type_of_service");
$rowPaket = [];
while ($data = mysqli_fetch_assoc($queryPaket)) {
    $rowPaket[] = $data;
}


// $queryTrans = mysqli_query($koneksi, "SELECT * FROM trans_order WHERE id_order = '$id' ");
$queryTransPickUp = mysqli_query($koneksi, "SELECT * FROM trans_laundry_pickup WHERE id_order = '$id'");


// jika button simpan ditekan/klik 
if (isset($_POST['simpan_transaksi'])) {

    // mengambil nilai dari input dengan atribute name
    $id_customer = $_POST['id_customer'];
    $id_order = $_POST['id_order'];

    $order_payment = $_POST['order_payment'];
    $order_change = $_POST['order_change'];
    $total = $_POST['total'];

    $pickup_date = date('Y-m-d');

    // insert ke table trans_laundry_pickup
    $insert =  mysqli_query($koneksi, "INSERT INTO trans_laundry_pickup (id_order, id_customer, pickup_date) 
    VALUES ('$id_order','$id_customer','$pickup_date')");


    $updateTransOrder = mysqli_query($koneksi, "UPDATE trans_order SET order_payment = '$order_payment', order_change = '$order_change', total='$total', order_status = 1 WHERE id = '$id_order'");


    header("location:transaksi.php?tambah=berhasil");
}


// no invoice code 
// 001, jika ada auto increment id + 1 = 002, selain itu 001
// SELECT MAX yang terbesar, MIN terkecil
$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS no_invoice FROM trans_order");
// jika di dalam table trans order ada datanya
$str_unique = "QT";
$date_now = date("dmy");
if (mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = $rowInvoice['no_invoice'] + 1;
    $code = $str_unique . "/" . $date_now . "/" . "000" . $incrementPlus;
} else {
    $code = $str_unique . "/" . $date_now . "/" . "0001";
}

if (isset($_POST['']))

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

                    <div class="content-wrapper mt-5">
                        <?php if (isset($_GET['detail_ambil'])): ?>
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>Pengambilan Laundry <?php echo $row[0]['customer_name'] ?></h5>
                                                    </div>

                                                    <div class="col-sm-6" align="right">
                                                        <a href="trans-pickup.php" class="btn btn-secondary">Kembali</a>
                                                        <a href="print-laporan.php?id=<?php echo $row[0]['id'] ?>" class="btn btn-success">Print</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Transaksi</h5>
                                            </div>
                                            <?php include 'helper.php' ?>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>No Invoice</th>
                                                        <td><?php echo $row[0]['order_code'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Loundry</th>
                                                        <td><?php echo $row[0]['order_date'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><?php echo changeStatus($row[0]['order_status']) ?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Pelanggan</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?php echo $row[0]['customer_name'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Telp</th>
                                                        <td><?php echo $row[0]['phone'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo $row[0]['address'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Transaksi Detail</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="" method="post">

                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Paket</th>
                                                                <th>Harga</th>
                                                                <th>Qty</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1;
                                                            $total = 0;
                                                            foreach ($row as $key => $value): ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $value['service_name'] ?></td>
                                                                    <td><?php echo $value['price'] ?></td>
                                                                    <td><?php echo $value['qty'] ?></td>
                                                                    <td><?php echo $value['subtotal'] ?></td>
                                                                </tr>
                                                                <?php
                                                                $total = $total + $value['subtotal'];
                                                                ?>
                                                            <?php endforeach ?>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Total Keseluruhan</strong>
                                                                </td>
                                                                <td>
                                                                    
                                                                    <input type="hiden" name="total" class="form-control" value="<?php echo "Rp". number_format($total) ?>" readonly>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Dibayar</strong>
                                                                </td>
                                                                <td>
                                                                    
                                                                    <strong>
                                                                    <?php if (isset($row[0]['order_payment']) && $row[0]['order_payment'] == 0): ?>
                                                                        <input type="text" name="order_payment" placeholder="nominal bayar" class="form-control" value="<?php echo isset($_POST['order_payment']) ? $_POST['order_payment'] : '' ?>">

                                                                    <?php else: ?>
                                                                        <input type="text" placeholder="Dibayar" class="form-control" value="<?php echo "Rp". number_format($row[0]['order_payment']) ?>" readonly>
                                                                    <?php endif; ?>

                                                                    </strong>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Kembalian</strong>
                                                                </td>
                                                                <?php
                                                                if (isset($_POST['proses_kembalian'])) {
                                                                    // $total = $_POST['total'];
                                                                    $dibayar = $_POST['order_payment'];

                                                                    $kembalian = 0;
                                                                    $kembalian = (int)$dibayar - (int)$total;
                                                                }
                                                                ?>
                                                                <td>
                                                                    <input type="hidden" name="total" value="<?php echo $total ?>">
                                                                    <input type="hidden" name="id_customer" value="<?php echo $row[0]['id_customer'] ?>">
                                                                    <input type="hidden" name="id_order" value="<?php echo $row[0]['id_order'] ?>">

                                                                    <strong>
                                                                        <!-- sudah ada di table trans_laundry_pickup -->
                                                                        <?php if (mysqli_num_rows($queryTransPickUp) > 0): ?>
                                                                            <input type="text" name="order_change" placeholder="Kembalian" class="form-control" readonly
                                                                                value="<?php echo "Rp" . number_format($row[0]['order_change']) ?>">
                                                                        <?php else: ?>
                                                                            <!-- belum ada di table trans_laundry_pickup -->
                                                                            <input type="text" name="order_change" placeholder="Kembalian" class="form-control" value="<?php echo isset($kembalian) ? $kembalian : 0 ?>">
                                                                        <?php endif ?>
                                                                    </strong>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <?php if ($row[0]['order_status'] == 0): ?>
                                                                <tr>
                                                                    <td colspan="5">
                                                                        <button class="btn btn-primary" name="proses_kembalian">Proses Kembalian</button>
                                                                        <button class="btn btn-success" name="simpan_transaksi">Simpan Transaksi</button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif (isset($_GET['detail_laporan'])): ?>
                            <div class="container-xxl flex-grow-1 container-p-y">
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h5>Pengambilan Laundry <?php echo $row_dua[0]['customer_name'] ?></h5>
                                                    </div>

                                                    <div class="col-sm-6" align="right">
                                                        <a href="laporan.php" class="btn btn-secondary">Kembali</a>
                                                        <a href="print.php?id=<?php echo $id ?>" class="btn btn-success">Print</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Transaksi</h5>
                                            </div>
                                            <?php include 'helper.php' ?>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>No Invoice</th>
                                                        <td><?php echo $row_dua[0]['order_code'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Loundry</th>
                                                        <td><?php echo $row_dua[0]['order_date'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td><?php echo changeStatus($row_dua[0]['order_status']) ?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Data Pelanggan</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered table-striped">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td><?php echo $row_dua[0]['customer_name'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Telp</th>
                                                        <td><?php echo $row_dua[0]['phone'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo $row_dua[0]['address'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Transaksi Detail</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="" method="post">

                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Paket</th>
                                                                <th>Harga</th>
                                                                <th>Qty</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1;
                                                            $total = 0;
                                                            foreach ($row_dua as $key => $value): ?>
                                                                <tr>
                                                                    <td><?php echo $no++ ?></td>
                                                                    <td><?php echo $value['service_name'] ?></td>
                                                                    <td><?php echo $value['price'] ?></td>
                                                                    <td><?php echo $value['qty'] ?></td>
                                                                    <td><?php echo $value['subtotal'] ?></td>
                                                                </tr>
                                                                <?php
                                                                $total = $total + $value['subtotal'];
                                                                ?>
                                                            <?php endforeach ?>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Total Keseluruhan</strong>
                                                                </td>
                                                                <td>
                                                                    <strong><?php echo "Rp" . number_format($total) ?></strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Dibayar</strong>
                                                                </td>
                                                                <td>
                                                                    
                                                                    <strong>
                                                                    <?php if (isset($row_dua[0]['order_payment']) && $row_dua[0]['order_payment'] == 0): ?>
                                                                        <input type="text" name="order_payment" placeholder="nominal bayar" class="form-control" value="<?php echo isset($_POST['order_payment']) ? $_POST['order_payment'] : '' ?>">

                                                                    <?php else: ?>
                                                                        <input type="text" placeholder="Dibayar" class="form-control" value="<?php echo "Rp". number_format($row_dua[0]['order_payment']) ?>" readonly>
                                                                    <?php endif; ?>

                                                                </strong>
                                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" align="right">
                                                                    <strong>Kembalian</strong>
                                                                </td>
                                                                <?php
                                                                if (isset($_POST['proses_kembalian'])) {
                                                                    // $total = $_POST['total'];
                                                                    $dibayar = $_POST['order_payment'];

                                                                    $kembalian = 0;
                                                                    $kembalian = (int)$dibayar - (int)$total;
                                                                }
                                                                ?>
                                                                <td>
                                                                    <input type="hidden" name="total" value="<?php echo $total ?>">
                                                                    <input type="hidden" name="id_customer" value="<?php echo $row_dua[0]['id_customer'] ?>">
                                                                    <input type="hidden" name="id_order" value="<?php echo $row_dua[0]['id_order'] ?>">

                                                                    <strong>
                                                                        <!-- sudah ada di table trans_laundry_pickup -->
                                                                        <?php if (isset($row_dua[0]['order_change']) && $row_dua[0]['order_change'] == 0): ?>
                                                                        <input type="text" name="order_change" placeholder="Kembalian" class="form-control" value="<?php echo isset($_POST['order_change']) ? $_POST['order_change'] : '' ?>">

                                                                        <?php else: ?>
                                                                            <input type="text" class="form-control" value="<?php echo "Rp". number_format($row_dua[0]['order_change']) ?>" readonly>
                                                                        <?php endif; ?>
                                                                    </strong>
                                                                    <!-- <strong>
                                                                        <input type="text" name="order_change" placeholder="Kembalian" class="form-control" value="<?php echo isset($kembalian) ? $kembalian : 0 ?>">
                                                                    </strong> -->
                                                                </td>
                                                            </tr>
                                                            <?php if ($row_dua[0]['order_status'] == 0): ?>
                                                                <tr>
                                                                    <td colspan="5">
                                                                        <button class="btn btn-primary" name="proses_kembalian">Proses Kembalian</button>
                                                                        <button class="btn btn-success" name="simpan_transaksi">Simpan Transaksi</button>
                                                                    </td>
                                                                </tr>
                                                            <?php endif ?>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>

                            <div class="container-xxl flex-grow-1 container-p-y">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</div>
                                                <div class="card-body">
                                                    <div class="mb-3 row">

                                                        <div class="col-sm-12 mb-3">
                                                            <label for="" class="form-label">Pelanggan</label>
                                                            <select name="id_customer" class="form-control" id="">
                                                                <option value="">Pilih Pelanggan</option>
                                                                <?php while ($rowCustomer = mysqli_fetch_assoc($queryCustomer)): ?>
                                                                    <option value="<?php echo $rowCustomer['id'] ?>">
                                                                        <?php echo $rowCustomer['customer_name'] ?>
                                                                    </option>
                                                                <?php endwhile ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">No invoice</label>
                                                            <input type="text" class="form-control" id="" name="order_code" readonly
                                                                value="#<?php echo $code ?>">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Tanggal Laundry</label>
                                                            <input type="date" name="order_date" class="form-control" id="">
                                                        </div>

                                                    </div>



                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-header">Detail Transaksi</div>
                                                <div class="card-body">
                                                    <div class="mb-3 row">

                                                        <div class="col-sm-3 mb-4">
                                                            <label for="" class="form-label">Paket</label>
                                                        </div>
                                                        <div class="col-9 mb-4">
                                                            <select name="id_service[]" class="form-control" id="">
                                                                <option value="">Pilih Paket</option>
                                                                <?php
                                                                foreach ($rowPaket as $key => $value) {
                                                                ?>
                                                                    <option value="<?php echo $value['id'] ?>">
                                                                        <?php echo $value['service_name'] ?>
                                                                    </option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <label for="" class="form-label">Quantity</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="number" class="form-control" id="" name="qty[]"
                                                                value="" placeholder="Qty">
                                                        </div>

                                                    </div>
                                                    <div class="mb-3 row">

                                                        <div class="col-sm-3 mb-4">
                                                            <label for="" class="form-label">Paket</label>
                                                        </div>
                                                        <div class="col-9 mb-4">
                                                            <select name="id_service[]" class="form-control" id="">
                                                                <option value="">Pilih Paket</option>
                                                                <?php
                                                                foreach ($rowPaket as $key => $value) {
                                                                ?>
                                                                    <option value="<?php echo $value['id'] ?>">
                                                                        <?php echo $value['service_name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3 mb-3">
                                                            <label for="" class="form-label">Quantity</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="number" class="form-control" id="" name="qty[]"
                                                                value="" placeholder="Qty">
                                                        </div>

                                                    </div>

                                                    <div class="mb-3">
                                                        <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php endif ?>
                    </div>
                    <!-- Content Row -->


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