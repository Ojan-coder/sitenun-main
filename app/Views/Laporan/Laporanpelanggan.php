<!DOCTYPE>
<html>

<script>
    window.print();
</script>

<head>
    <meta charset="UTF-8">
    <title>Cetak</title>
</head>
<style>
    #tabel {
        font-size: 15px;
        border-collapse: collapse;
    }

    #tabel td {
        padding-left: 5px;
        border: 1px solid black;
    }
</style>

<body onload="window.print();" style='font-family:tahoma; font-size:8pt;'>
    <div align="center">
        <table style="border-collapse: collapse; width: 100%" border="1">
            <tr>
                <td align="center">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <tr>
                            <td><img src="<?= base_url('assets/images/logo/logoSD.png') ?>" width="100px" height="80px" style="align-items:;"></td>
                            <td style="text-align: center;">
                                <span style="font-size: 20pt; font-weight: bold; color: black;">SENTRA TENUN LINTAU BUO</span><br>
                                <span style="font-size: 12pt; font-weight: bold; color: black;">Taluak, Lintau Buo, Tanah Datar Regency, West Sumatra 27292</span><br>
                                <p>
                                    <span style="font-size: 18pt; font-weight: bold; color: black;">Laporan Pelanggan</span><br>
                                    <span style="font-size: 12pt; font-weight: bold; font-style: italic;">
                                    </span>
                                    <hr>
                            </td>
                            <td><img src="<?= base_url('assets/images/logo/logotutwuri.png') ?>" width="100px" height="80px" style="align-items:;"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <br>
                    <table class="table table-bordered" width="100%" border="1">
                        <thead>
                            <tr>
                                <th>Kode Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>No.Telp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $r) {
                                if ($r['kodejenkel'] == 'P') {
                                    $jk = "Perempuan";
                                } else {
                                    $jk = "Laki-Laki";
                                }
                            ?>
                                <tr>
                                    <td><?= $r['kodepelanggan'] ?></td>
                                    <td><?= $r['namapelanggan'] ?></td>
                                    <td><?= $r['tgl_lahir'] ?></td>
                                    <td><?= $jk ?></td>
                                    <td><?= $r['alamat'] ?></td>
                                    <td><?= $r['notelp'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <tr>
                                <td width="50%"></td>
                                <td width="26%">Padang,
                                    <?php echo date('d-M-Y'); ?>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <strong>Yasril, S.Pd</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>