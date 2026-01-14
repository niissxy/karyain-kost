<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Check In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
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
                <div style="font-weight: 600; font-size: 16px; text-align: right;">
                    <strong>Karyain Kost Cibiru 1</strong><br>
                    <strong>Jalan Sukasari No.30, RT 02/RW 10, Pasir Biru, Kec. Cibiru, Kota Bandung, Jawa Barat 40615</strong>   
                </div>
            </div>
            <div class="invoice-title">
                INVOICE Check In
            </div>
        </div>

        <div class="invoice-info">
            <div class="row">
                <div class="col-sm-6">
                    <strong>Tanggal Check In</strong> <strong> : </strong>  
                    <span>{{ date('d-m-Y', strtotime($checkin_regol1->tgl_checkin)) }}</span>
                </div>
                <div class="col-sm-6">
                    <strong>ID Check In</strong> <strong style="margin-left: 45px;"> : </strong>
                    <span>{{ $checkin_regol1->id_checkin }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Nama Penghuni</strong> <strong style="margin-left: 10px;"> : </strong>
                    <span>{{ $checkin_regol1->nama_penghuni }}</span>                   
                </div>
                <div class="col-sm-6">
                    <strong>No Kamar</strong> <strong style="margin-left: 55px;"> : </strong>
                    <span>{{ $checkin_regol1->no_kamar }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Nominal</strong> <strong style="margin-left: 67px;"> : </strong>
                    <span>Rp {{ number_format($checkin_regol1->nominal, 0, ',', '.') }}</span>                   
                </div>
                <div class="col-sm-6">
                    <strong>Status</strong> <strong style="margin-left: 81px;"> : </strong>
                    <span>{{ $checkin_regol1->status }}</span>                    
                </div>
            </div>

    </div>
</body>
</html>