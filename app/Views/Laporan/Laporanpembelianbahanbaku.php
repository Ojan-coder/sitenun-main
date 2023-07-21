<!DOCTYPE>
<html>

<script>
    window.print();
</script>

<head>
    <meta charset="UTF-8">
    <title>Cetak Bahan Baku</title>
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
                        <td><img src="<?= base_url('img/logotenun.png') ?>" width="100px" height="100px" style="align-items:;"></td>
                            <td style="text-align: center;">
                                <span style="font-size: 20pt; font-weight: bold; color: black;">SENTRA TENUN LINTAU BUO</span><br>
                                <span style="font-size: 12pt; font-weight: bold; color: black;">Taluak, Lintau Buo, Tanah Datar Regency, West Sumatra 27292</span><br>
                                <p>
                                    <span style="font-size: 18pt; font-weight: bold; color: black;">Laporan Pembelian Bahan Baku</span><br>
                                    <span style="font-size: 12pt; font-weight: bold; font-style: italic;">
                                    </span>
                                    <hr>
                            </td>
                            <td><img src="<?= base_url('img/tanahdatar.png') ?>" width="100px" height="100px" style="align-items:;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Periode : <?= $tglawal ?> s/d <?= $tglakhir ?></td>
            </tr>
            <tr>
                <td align="center">
                    <br>
                    <table class="table table-bordered" width="100%" border="1">
                        <thead>
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Tanggal Pembelian Bahan Baku</th>
                                <th>Nama Bahan Baku</th>
                                <th>Stok</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $r) {
                            ?>

                                <tr>
                                    <td><?= $r['kode_bahan_baku_masuk'] ?></td>
                                    <td><?= $r['tgl_bahan_baku_masuk'] ?></td>
                                    <td><?= $r['nama_bahan_baku'] ?></td>
                                    <td><?= $r['jumlah_bahan_baku'] ?></td>
                                    <td><?= "Rp. " . number_format($r['total_harga_bahan_baku_masuk']) ?></td>

                                </tr>
                            <?php } ?>
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