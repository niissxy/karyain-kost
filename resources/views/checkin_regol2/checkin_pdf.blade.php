<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Check In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f9;
            padding: 30px;
            color: #333;
        }

        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-top: 5px solid #2e3a59;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .invoice-title {
            font-size: 22px;
            font-weight: 700;
            color: #2e3a59;
        }

        .company-info {
            text-align: right;
            font-size: 12px;
        }

        .info-table td {
            padding: 6px 0;
            font-size: 14px;
        }

        .info-table td:first-child {
            font-weight: 600;
            width: 180px;
        }

        .total-box {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #ccc;
            text-align: right;
            font-size: 16px;
            font-weight: 700;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            .invoice-container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>

<div class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">
        <div>
            <div class="invoice-title">INVOICE CHECK IN</div>
            <small>ID: {{ $checkin_regol2->id_checkin }}</small>
        </div>

        <div class="company-info">
            <strong>Karyain Kost Regol 2</strong><br>
            <!-- Jalan Babakan Priangan 2 Gg. IV No. 12<br>
            Regol - Ciseureuh<br> -->
        </div>
    </div>

    <!-- INFO -->
    <table class="table table-borderless info-table">
        <tr>
            <td>Tanggal Check In</td>
            <td>: {{ date('d-m-Y', strtotime($checkin_regol2->tgl_checkin)) }}</td>
        </tr>
        <tr>
            <td>Nama Penghuni</td>
            <td>: {{ $checkin_regol2->nama_penghuni }}</td>
        </tr>
        <tr>
            <td>No Kamar</td>
            <td>: {{ $checkin_regol2->no_kamar }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>: {{ $checkin_regol2->status }}</td>
        </tr>
        <tr>
            <td>Total Penyewa</td>
            <td>: {{ $checkin_regol2->total_penyewa }}</td>
        </tr>
        <tr>
            <td>Metode Pembayaran</td>
            <td>: {{ $checkin_regol2->metode_pembayaran }}</td>
        </tr>
        <tr>
            <td>Nominal</td>
            <td>: <strong>Rp {{ number_format($checkin_regol1->nominal, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <!-- TOTAL -->
    <div class="total-box">
        Total Pembayaran: Rp {{ number_format($checkin_regol2->nominal, 0, ',', '.') }}
    </div>

</div>

</body>
</html>
