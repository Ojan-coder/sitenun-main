<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">History Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered display">
                            <thead>
                                <th>Kode Pemesanan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Tenun</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($datapesanan as $r) { ?>
                                        <td><?= $r['kode_pemesanan'] ?></td>
                                        <td><?= $r['tgl_pemesanan'] ?></td>
                                        <td><?= $r['nama_produk'] ?></td>
                                        <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk_penjualan_detail']) ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>