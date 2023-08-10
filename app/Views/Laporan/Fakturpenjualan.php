<!DOCTYPE>
<html>

<script>
    window.print();
</script>

<head>
    <meta charset="UTF-8">
    <title>Cetak Faktur</title>
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

<body onload="window.print();" style='font-family:monospace; font-size:8pt;'>
    <div align="center">
        <table style="border-collapse: collapse; width: 100%" border="0">
            <tr>
                <td align="center">
                    <table style="border-collapse: collapse; width: 90%;" border="0">
                        <tr>
                            <!-- <td><img src="<?= base_url('img/logotenun.png') ?>" width="100px" height="100px" style="align-items:;"></td> -->
                            <td style="text-align: center;">
                                <span style="font-size: 20pt; font-weight: bold; color: black;">SENTRA TENUN LINTAU BUO</span><br>
                                <span style="font-size: 12pt; font-weight: bold; color: black;">Taluak, Lintau Buo, Tanah Datar Regency, West Sumatra 27292</span><br>
                                <p>
                                    <span style="font-size: 18pt; font-weight: bold; color: black;">Faktur Pembayaran</span><br>
                                    <span style="font-size: 12pt; font-weight: bold; font-style: italic;">
                                    </span>
                                    <hr>
                            </td>
                            <!-- <td><img src="<?= base_url('img/tanahdatar.png') ?>" width="100px" height="100px" style="align-items:;"></td> -->
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <br>
                    <table style="border-collapse: collapse; width: 95%; font-weight: bold;" align="center" border="0">
                        <tr>
                            <td width="180px">No. Pelanggan</td>
                            <td width="50px">:</td>
                            <td><?= $pelanggan['kodepelanggan'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>:</td>
                            <td><?= $pelanggan['namapelanggan'] ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <br>
                    <table style="border-collapse: collapse; width: 95%;" border="1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No.Transaki</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga Produk</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            foreach ($detail as $r) {
                                $total = $r['qty_produk_penjualan_detail'] * $r['harga_produk_penjualan_detail'];

                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $r['no_transaksi_penjualan_detail'] ?></td>
                                    <td><?= $r['tgl_penjualan'] ?></td>
                                    <td><?= $r['nama_produk'] ?></td>
                                    <td><?= $r['qty_produk_penjualan_detail']?></td>
                                    <td><?= "Rp. " . number_format($r['harga_produk_penjualan_detail']) ?></td>
                                    <td><?= "Rp. " . number_format($total) ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">Total Semua</td>
                                <td><?= "Rp. " . number_format($total) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <div align="center">
                        <table style="border-collapse: collapse; width: 90%;" border="0">
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