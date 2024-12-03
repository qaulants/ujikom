<?php
include "koneksi.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
// mengambil data detail penjualan
$queryPrint = mysqli_query($koneksi, "SELECT 
        type_of_service.service_name, 
        trans_order_detail.id_order, 
        trans_order_detail.id_service, 
        trans_order_detail.subtotal, 
        trans_order.*
    FROM trans_order
    LEFT JOIN trans_order_detail ON trans_order_detail.id_order = trans_order.id
    LEFT JOIN type_of_service ON type_of_service.id = trans_order_detail.id_service");

$row = [];
while ($rowPrint = mysqli_fetch_assoc($queryPrint)) {
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
        
        body{
            margin: 20px;
            /* font-family: "Doto", sans-serif; */
            
        }
        .struk{
            width: 80%;
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
                font-size: 20px;
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
            <table>
                <thead>
                    <tr>
                        <th>No Transaksi</th>
                        <th>Nama Paket</th>
                        <th>Tgl Laundry</th>
                        <th>Tgl Pengembalian</th>
                        <th>Status</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'helper.php' ?>
                    <?php foreach ($row as $key => $rowPrint): ?>
                    <tr>
                        <td><?php echo $rowPrint['order_code'] ?></td>
                        <td><?php echo $rowPrint['service_name'] ?></td>
                        <td><?php echo $rowPrint['order_date'] ?></td>
                        <td><?php echo $rowPrint['order_end_date'] ?></td>
                        <td><?php echo changeStatus($rowPrint['order_status']) ?></td>
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