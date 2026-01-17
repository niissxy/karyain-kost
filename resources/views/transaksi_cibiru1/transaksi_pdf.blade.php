<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 40px;
        }

        .invoice-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: auto;
            border-top: 4px solid #2e3a59;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .brand-image {
            max-width: 60px;
            height: auto;
        }

        .invoice-title {
            font-size: 15px;
            /* font-weight: 600; */
            color: #2e3a59;
            letter-spacing: 1px;
            text-align: left;
            text-transform: uppercase;
        }

        .invoice-info p {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .col-sm-6 {
            margin-bottom: 20px;
        }

        /* .table {
            max-width: 1000px;
            margin-top: 20px;
            border-collapse: collapse;
            width: 50%;
            background: #ffffff;
            font-size: 14px;
        }

        .table th {
            color: #000000;
            text-align: center;
            font-size: 14px;
            padding: 6px;
            text-transform: uppercase;
        }

        .table td {
            text-align: center;
            padding: 6px;
            border: 1px solid #ddd;
            font-size: 13px;
        } */

        .total-section {
            text-align: right;
            margin-top: 25px;
            font-size: 16px;
            font-weight: bold;
        }

        /* Print Styles */
        @media print {
            .btn, .mt-3 {
                display: none;
            }
            .invoice-container {
                border: none;
                padding: 10px;
                box-shadow: none;
            }
            .invoice-title {
                font-size: 10px;
                font-weight: 600;
                color: #2e3a59;
                letter-spacing: 1px;
                text-align: left;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
<div class="invoice-container">
        
        <!-- Header -->
        <div class="header-section">
            <div class="header-section d-flex justify-content-end align-items-center">
                 <div class="invoice-title">
                    INVOICE Transaksi
                </div>
                <div style="font-weight: 600; font-size: 16px; text-align: right;">
                    <strong>Karyain Kost Cibiru 1</strong><br>
                </div>
                <div style="font-weight: 50; font-size: 12px; text-align: right; margin-top: 20px;">
                    <strong>Jalan Sukasari No.30, RT 02/RW 10, Pasir Biru, Kec. Cibiru, Kota Bandung, Jawa Barat 40615</strong>   
                </div>
            </div>
        </div>

        <div class="invoice-info">
            <div class="row">
                <div class="col-sm-6">
                    <strong>Tanggal Pembayaran</strong> <strong> : </strong>  
                    <span>{{ date('d-m-Y', strtotime($transaksi->tgl_pembayaran)) }}</span>
                </div>
                <div class="col-sm-6">
                    <strong>ID Transaksi</strong> <strong style="margin-left: 66px;"> : </strong>
                    <span>{{ $transaksi->id_transaksi }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Nama Penyewa</strong> <strong style="margin-left: 45px;"> : </strong>
                    <span>{{ $transaksi->nama_penyewa }}</span>                   
                </div>
                <div class="col-sm-6">
                    <strong>Total Penyewa</strong> <strong style="margin-left: 50px;"> : </strong>
                    <span>{{ $transaksi->total_penyewa }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>No Kamar</strong> <strong style="margin-left: 85px;"> : </strong>
                    <span>{{ $transaksi->no_kamar }}</span>                    
                </div>
                <div class="col-sm-6">
                    <strong>Nominal</strong> <strong style="margin-left: 98px;"> : </strong>
                    <span>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</span>                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Status</strong> <strong style="margin-left: 113px;"> : </strong>
                    <span>{{ $transaksi->status }}</span>                    
                </div>
                 <div class="col-sm-6">
                    <strong>Metode Pembayaran</strong> <strong style="margin-left: 7px;"> : </strong>
                    <span>{{ $transaksi->metode_pembayaran }}</span>                    
                </div>
            </div>

    </div>
</body>
</html>