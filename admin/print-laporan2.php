<?php
include "koneksi.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
// mengambil data detail penjualan
$queryPrint = mysqli_query($koneksi, "SELECT trans_order.id, trans_order.order_code, trans_order.order_payment,trans_order.order_change, trans_order.total ,type_of_service.service_name, type_of_service.price, customer.customer_name, trans_order_detail.* FROM trans_order_detail 
LEFT JOIN trans_order ON trans_order.id = trans_order_detail.id_order 
LEFT JOIN customer ON customer.id = trans_order.id_customer
LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service WHERE trans_order_detail.id_order= '$id'");

$row = [];
while($rowPrint = mysqli_fetch_assoc($queryPrint)) {
    $row[] = $rowPrint;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Transaksi : </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Doto:wght@100..900&display=swap');
        body{
            margin: 20px;
            font-family: "Doto", sans-serif;
            font-weight: 800;
        }
        .struk{
            width: 100mm;
            max-width: 100%;
            border: 1px solid #000;
            padding: 10px;
            margin: 0 auto;
        }
        .struk-header, .struk-footer{
            text-align: center;
            margin-bottom: 10px;

        }
        .struk-header h1{
            font-size: 18px;
            margin: 0;
        }
        .struk-body {
            margin-bottom: 10px;
        }

        .struk-body table{
            border-collapse: collapse;
            width: 100%;
        }
        .struk-body table th, .struk-body table td {
            padding: 5px;
            text-align: left;
        }
        .struk-body table th{
            border-bottom: 1px solid #000;
        }
        .total, .payment, .change{
            display: flex;
            justify-content: space-evenly;
            padding: 5px 0;
            font-weight: bold;
        }
        .total{
            margin-top: 10px;
            border-top: 1px solid #000;
        }

        @media print {
            body{
                margin: 0;
                padding: 0;
            }
            .struk{
                width: auto;
                border: none;
                margin: 0;
                padding: 0;
            }

            .struk-header h1, 
            .struk-footer{
                font-size: 14px;
            }

            .struk-body table th, 
            .struk-body table td{
                padding: 2px;
            }

            .total, 
            .payment, 
            .change{
                padding: 2px 0;
            }
        }
    </style>
</head>
<body>


    <div class="struk">
        <div class="struk-header">
            <h1>Laundry Qaulan</h1>
            <p>Jl. Anggrek Jakarta Barat</p>
            <p>081285968650</p>
        </div>
        <div class="struk-body">
            <div class="container-md">
                <p>No Invoice    : <?php echo $row[0]['order_code'] ?></p>
                <p>Nama Pelanggan: <?php echo $row[0]['customer_name'] ?></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row as $key => $rowPrint): ?>
                    <tr>
                        <td><?php echo $rowPrint['service_name'] ?></td>
                        <td><?php echo "Rp. " . number_format($rowPrint['price']) ?></td>
                        <td><?php echo $rowPrint['qty'] ?></td>
                        <td><?php echo "Rp. " . number_format($rowPrint['subtotal']) ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
           
        </div>
    </div>    

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>