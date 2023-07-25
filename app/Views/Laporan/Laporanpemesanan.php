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
                                    <span style="font-size: 18pt; font-weight: bold; color: black;">Laporan Pemesanan</span><br>
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
                                <th>Kode Pesanan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Nama Produk</th>
                                <th>Nama Pelanggan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Dp</th>
                                <th>Sisa</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <?php
                                $totalsemua = 0;
                                foreach ($data as $r) {
                                    $totalbayar = $r['qty_produk_penjualan_detail'] * $r['harga_produk'];
                                    $totalsemua = $totalsemua + $r['qty_produk_penjualan_detail'] * $r['harga_produk'];
                                    $sisa = $r['harga_produk'] * $r['qty_produk_penjualan_detail'] - $r['dp_pemesanan'];
                                ?>
                                    <td><?= $r['kode_pemesanan'] ?></td>
                                    <td><?= $r['tgl_pemesanan'] ?></td>
                                    <td><?= $r['nama_produk'] . ' (' . $r['jenis_motif'] . ')' ?></td>
                                    <td><?= $r['namapelanggan'] ?></td>
                                    <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                    <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                    <td><?= "Rp. " . number_format($r['dp_pemesanan']) ?></td>
                                    <td><?= "Rp. " . number_format($sisa) ?></td>
                                    <td><?= "Rp. " . number_format($totalbayar) ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tr>
                            <td colspan="8">Total Semua</td>
                            <td><?= "Rp. " . number_format($totalsemua) ?></td>
                        </tr>
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