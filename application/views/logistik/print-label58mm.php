<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pengiriman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 4pt;
            margin: 0;
            padding: 5px;
            transform:rotate(270deg);
        }
        th {
        font-size: 14px; /* Set font size for table header cells */
        font-weight: bold; /* Optionally make header text bold */
        }
        td {
        font-size: 14px; /* Set font size for table header cells */
        font-weight: bold; /* Optionally make header text bold */
        
        }
        .resi-container {
            width: 45mm;
            height: 30mm;
            margin: auto;
            padding: 5px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .resi-header {
            text-align: left;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .resi-header h1 {
            margin: 0;
        }
        .resi-details {
            margin-bottom: 10px;
        }
        .resi-details p {
            margin: 5px 0;
        }
        .resi-footer {
            text-align: center;
            margin-top: 0px;
        }

        table{
            border: 1px solid black;
            width: auto;
            height: auto;
            margin-left: 180px;
            border-radius: 5px;
        }

        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 4pt;
                margin: 0;
                padding: 0px;
                transform:rotate(270deg);
            }
            .resi-container {
                width: 85mm;
                height: 17mm;
                margin-top: -2px;
                margin-right: 15px;
                margin-left: -260px;
                padding: 5px;
                border: 0px solid #000;
                border-radius: 5px;
            }
            .resi-header {
                text-align: left;
                margin-bottom: 10px;
                margin-top: 10px;
            }
            .resi-header h1 {
                margin: 0;
            }
            .resi-details {
                margin-top: -6.5px;
                margin-bottom: 0px;
                margin-right: 15px;
            }
            .resi-details p {
                margin: 5px 0;
            }
            .resi-footer {
                text-align: center;
                margin-top: 0px;
            }
            table{
            border: 1px solid black;
            width: auto;
            height: auto;
            margin-left: -180px;
            border-radius: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- <div class="resi-container">
        <div class="resi-details"> -->
            <table border="1">
              <tbody>
                <?php 
                foreach ($barang as $key => $value) { ?>
                <tr>
                    <td align="center" rowspan="3" width="75px">
                        <img src=" <?= base_url('/assets/img/logo_mr.png') ?>" width="70px" height="35px">
                    </td>
                    <td align="center" rowspan="3" valign ="bottom">
                        <img src=" <?= base_url('/assets/gambar_barang/qrcode/'.$value->qr_code) ?>" width="60px" height="60px">
                    </td>
                    <td align="center">
                        Label Barang
                    </td>
                    
                </tr>
                <tr>
                    <td align="center" valign="top">
                    <?= $value->kode_barang  ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top"><?= $value->nama_barang  ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        <!-- </div>
    </div> -->
</body>
</html>

<script>
  window.addEventListener("load", window.print());
</script>