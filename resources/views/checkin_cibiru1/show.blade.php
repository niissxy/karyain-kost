<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Invoice Check In</title>
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
            font-size: 28px;
            font-weight: 600;
            color: #2e3a59;
            letter-spacing: 1px;
            text-align: right;
            text-transform: uppercase;
        }

        .invoice-info p {
            font-size: 14px;
            margin-bottom: 5px;
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

        .btn {
            border-radius: 6px;
            transition: 0.2s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #2e3a59;
            border-color: #2e3a59;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
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
                font-size: 20px;
                font-weight: 600;
                color: #2e3a59;
                letter-spacing: 1px;
                text-align: right;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
<div class="invoice-container">
        
        <!-- Header -->
        <div class="header-section">
            <div class="d-flex align-items-center">
                <!-- <img alt="AdminLTE Logo" class="brand-image" src="{{ asset('lte/src/assets/img/AdminLTELogo.png') }}"> -->
                <div style="font-weight: 600; margin-left: 15px; font-size: 16px;">
                    <strong>Karyain Kost</strong><br>
                </div>
            </div>
            <div class="invoice-title">
                INVOICE Check In
            </div>
        </div>

        <div class="invoice-info">
            <div class="row">
                <div class="col-sm-6">
                    <strong>Tanggal Check In :</strong>   
                    <p>{{ date('d-m-Y', strtotime($checkin_cibiru1->tgl_checkin)) }}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Kode Check In :</strong>
                    <p>{{ $checkin_cibiru1->id_checkin }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Nama Penghuni :</strong>
                    <p>{{ $checkin_cibiru1->nama_penghuni }}</p>                   
                </div>
                <div class="col-sm-6">
                    <strong>No Kamar :</strong>
                    <p>{{ $checkin_cibiru1->no_kamar }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <strong>Nominal :</strong>
                    <p>Rp {{ number_format($checkin_cibiru1->nominal, 0, ',', '.') }}</p>                    
                </div>
                <div class="col-sm-6">
                    <strong>Status :</strong>
                    <p>{{ $checkin_cibiru1->status }}</p>                    
                </div>
            </div>
      
        <div class="text-center mt-4">     
        <button class="btn btn-primary mt-3" onclick="window.print()">Print</button>
        <a href="{{ route('checkin_cibiru1.index') }}" class="btn btn-secondary mt-3">Back</a>
        </div>
    </div>
</body>
</html>