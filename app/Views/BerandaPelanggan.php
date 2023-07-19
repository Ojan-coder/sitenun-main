<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">History Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <table  class="table table-bordered display">
                            <thead>
                                <th>Kode Pemesanan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Tenun</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $totalsemua= 0; 
                                    foreach ($datapesanan as $r) { 
                                    $total = $r['qty_produk_penjualan_detail'] *  $r['harga_produk_penjualan_detail'];
                                    $totalsemua = $totalsemua+$total;
                                    ?>
                                        <td><?= $r['kode_pemesanan'] ?></td>
                                        <td><?= $r['tgl_pemesanan'] ?></td>
                                        <td><?= $r['nama_produk'] ?></td>
                                        <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk_penjualan_detail']) ?></td>
                                        <td><?= "Rp. " . number_format($total) ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="5">Total  Semua :</td>
                                <td><?= "Rp. " . number_format($totalsemua) ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>