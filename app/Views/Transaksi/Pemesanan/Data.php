<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <?php if (session()->get('akses1') == '4') { ?>
                            <button type="button" onclick="location.href=('<?= base_url('Pemesanan/tambah') ?>')" class="btn btn-outline-success" title="Tambah Data PO">
                                <i class="fa fa-cart-plus"></i>
                            </button>
                        <?php } else if (session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                            <button type="button" onclick="location.href=('<?= base_url('/Admin/Pemesanan/tambah') ?>')" class="btn btn-outline-success" title="Tambah Data PO">
                                <i class="fa fa-cart-plus"></i>
                            </button>
                        <?php } ?>
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
                                    <th>Kode Pesanan</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Nama Produk</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Dp</th>
                                    <th>Sisa</th>
                                    <th>Status Pemesanan</th>
                                    <th width="80px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($datapesanan as $r) {
                                        $sisa = $r['harga_produk'] * $r['qty_produk_penjualan_detail'] - $r['dp_pemesanan']
                                    ?>
                                        <td><?= $r['kode_pemesanan'] ?></td>
                                        <td><?= $r['tgl_pemesanan'] ?></td>
                                        <td><?= $r['nama_produk'] . ' (' . $r['jenis_motif'] . ')' ?></td>
                                        <td><?= $r['namapelanggan'] ?></td>
                                        <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                        <td><?= "Rp. " . number_format($r['dp_pemesanan']) ?></td>
                                        <td><?= "Rp. " . number_format($sisa) ?></td>
                                        <td><?= $r['nama_status'] ?></td>
                                        <td>
                                            <?php if ($r['status_pemesanan'] == '2' && session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                                                <button class="btn btn-outline-success" data-toggle="modal" data_target="#modal-danger" title="Silahkan Bayar Sisanya">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } else if ($r['status_pemesanan'] == '2') { ?>
                                                <button class="btn btn-outline-success" title="Silahkan Bayar Sisanya">
                                                    <i class="fas fa-money-bill"></i>
                                                </button>
                                            <?php } else if ($sisa == 0) { ?>
                                                <button class="btn btn-outline-success" title="Silahkan Bayar Sisanya">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } ?>
                                            <?php if (session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                                                <button class="btn btn-outline-warning" data_target="_blank" onclick="location.href=('<?= base_url('fotobukti/') . $r['bukti_dp'] ?>')">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            <?php } ?>
                                            <button class="btn btn-outline-primary" title="Cetak Faktur Pemesanan" onclick="location.href=('<?= base_url('Laporan/CetakFaktur/' . $r['kode_pemesanan'] . '/' . $r['kode_pelanggan']) ?>')">
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

<!--Danger theme Modal -->
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Perhatian !</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <form method="POST" action="<?= base_url('Pelanggan/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data Pelanggan Ini ?
                        <input type="hidden" id="iduser" name="iduser">
                    </div>
            </div>
            <div class="modal-footer justify-content-between" style="background-color: white;">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-outline-danger">Yes</button>
            </div>
            </form>
        </div>

    </div>

</div>


<script>
    function ambil(id) {
        $('#iduser').val(id);
    }
</script>