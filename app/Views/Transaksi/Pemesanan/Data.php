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
                                        $sisa = ($r['harga_produk'] * $r['qty_produk_penjualan_detail']) - $r['dp_pemesanan'] - $r['bayar_sisa'];
                                        $dp = $r['dp_pemesanan']+$r['bayar_sisa'];
                                    ?>
                                        <td><?= $r['kode_pemesanan'] ?></td>
                                        <td><?= $r['tgl_pemesanan'] ?></td>
                                        <td><?= $r['nama_produk'] . ' (' . $r['jenis_motif'] . ')' ?></td>
                                        <td><?= $r['namapelanggan'] ?></td>
                                        <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                        <td><?= "Rp. " . number_format($dp) ?></td>
                                        <td><?= "Rp. " . number_format($sisa) ?></td>
                                        <td><?= $r['nama_status'] ?></td>
                                        <td>
                                            <?php if ($r['status_pemesanan'] == '2' && session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                                                <button class="btn btn-outline-success" title="Silahkan Bayar Sisanya">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } else if ($r['status_pemesanan'] == '2') { ?>
                                                <button class="btn btn-outline-success" onclick="return ambil('<?= $r['kode_pemesanan'] ?>','<?= $r['dp_pemesanan'] ?>','<?= $sisa ?>')" data-toggle="modal" data-target="#modal-bahanbaku" title="Silahkan Bayar Sisanya Pelanggan">
                                                    <i class="fas fa-money-bill"></i>
                                                </button>
                                            <?php } else if ($sisa < 0) { ?>
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-bahanbaku" title="Silahkan Bayar Sisanya">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } ?>
                                            <?php if (session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                                                <button class="btn btn-outline-warning" data_target="_blank" onclick="location.href=('<?= base_url('fotobukti/') . $r['bukti_dp'] ?>')">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn btn-outline-warning" data_target="_blank" onclick="location.href=('<?= base_url('fotobukti2/') . $r['bukti_sisa'] ?>')">
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

<!-- Modal Pembayaran -->
<div class="modal fade text-left" id="modal-bahanbaku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel130">
                    Lunasi Pembayaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Pemesanan/bayarsisa') ?>" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <table width="100%">
                        <input type="hidden" name="kodepemesanan" id="kodepemesanan">
                        <tr>
                            <td><label>Pembayaran Sebelumnya</label></td>
                            <td><input type="text" class="form-control" name="pembayaran_sebelumnya" id="pembayaran_sebelumnya"></td>
                        </tr>
                        <tr>
                            <td><label>Sisa Pembayaran</label></td>
                            <td><input type="text" name="sisa_pembayaran" class="form-control" id="sisa_pembayaran"></td>
                        </tr>
                        <tr>
                            <td><label>Bayar Sisa</label></td>
                            <td><input type="text" name="bayar_sisa" id="bayar_sisa" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><label>Upload Bukti Pembayaran</label></td>
                            <td><input type="file" id="gambar" name="gambar" class="form-control"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function ambil(id, bayar1, sisa1) {
        $('#kodepemesanan').val(id);
        $('#pembayaran_sebelumnya').val(bayar1);
        $('#sisa_pembayaran').val(sisa1);
    }
</script>