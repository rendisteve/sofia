<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8pt;
            margin: 0;
            padding: 5px;
        }
        .resi-container {
            max-width: 100mm;
            max-height: 30mm;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .resi-header {
            text-align: center;
            margin-bottom: 10px;
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
            margin-top: 20px;
        }

        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 8pt;
                margin: 0;
                padding: 5px;
            }
            .resi-container {
                max-width: 100mm;
                max-height: 30mm;
                margin: auto;
                padding: 20px;
                border: 1px solid #000;
                border-radius: 5px;
            }
            .resi-header {
                text-align: center;
                margin-bottom: 10px;
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
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="resi-container">
        <div class="resi-header">
            <h1>Label Barang</h1>
        </div>
        <div class="resi-details">
          <table align="center">
                <?php 
                foreach ($barang as $key => $value) { ?>
                <thead>
                    <tr>
                        <td align="center">
                            <img src=" <?= base_url('/assets/img/logo_mr.png') ?>" width="100px" height="30px">
                        </td>
                        <td align="center">
                        <?= $value->kode_barang  ?><br>
                            <img src=" <?= base_url('/assets/gambar_barang/qrcode/'.$value->qr_code) ?>" width="50px" height="50px">
                        </td>
                    </tr>
                    <tr align="center" border="1">
                        <th colspan="2"><?= $value->nama_barang  ?></th>
                        <th> </th>
                    </tr>
                <?php } ?>
              </thead>
            </table>
        </div>
    </div>
</body>
</html>

<script>
  window.addEventListener("load", window.print());
</script>