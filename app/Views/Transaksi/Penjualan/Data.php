<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" onclick="location.href=('<?= base_url('Penjualan/tambah') ?>')" class="btn btn-outline-success" title="Tambah Data PO">
                            <i class="fa fa-cart-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty(session()->getFlashdata('success'))) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i> <b>Success.</b>
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php
                        } ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th width="80px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($datapesanan as $r) {
                                        $sisa = $r['harga_produk'] * $r['qty_produk_penjualan_detail'];
                                    ?>
                                        <td><?= $r['no_transaksi_penjualan'] ?></td>
                                        <td><?= $r['tgl_penjualan'] ?></td>
                                        <td><?= $r['nama_produk'] . ' (' . $r['jenis_motif'] . ')' ?></td>
                                        <td><?= $r['namapelanggan'] ?></td>
                                        <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                        <td><?= "Rp. " . number_format($sisa) ?></td>
                                        <td>
                                            <button class="btn btn-outline-primary" title="Cetak Faktur Pemesanan" onclick="location.href=('<?= base_url('Laporan/CetakFakturPenjualan/' . $r['no_transaksi_penjualan'] . '/' . $r['kode_pelanggan']) ?>')">
                                                <i class="fas fa-print"></i>
                                            </button>
                                        </td>
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