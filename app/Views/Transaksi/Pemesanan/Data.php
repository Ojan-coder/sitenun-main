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
                                    <th width="130px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($datapesanan as $r) {
                                        $sisa = ($r['harga_produk'] * $r['qty_produk_penjualan_detail']) - $r['dp_pemesanan'] - $r['bayar_sisa'];
                                        $dp = $r['dp_pemesanan'] + $r['bayar_sisa'];
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
                                            <?php if ($r['status_pemesanan'] == '1' && $r['bukti_dp'] != NULL && session()->get('akses1') == '1') { ?>
                                                <button class="btn btn-outline-secondary" title="Check Status Pembayaran 1" onclick="location.href=('<?= base_url('Pemesanan/gantistatus/') . $r['status_pemesanan'] . '/' . $r['kode_pemesanan'] ?>')">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } else if ($r['bukti_dp'] != NULL && $r['bukti_sisa'] != NULL && session()->get('akses1') == '1' && $r['status_pemesanan'] == "3") { ?>
                                                <button class="btn btn-outline-secondary" title="Selesaikan Produk" onclick="location.href=('<?= base_url('Pemesanan/gantistatus/') . $r['status_pemesanan'] . '/' . $r['kode_pemesanan'] ?>')">
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                            <?php } else if ($r['bukti_dp'] != NULL && $r['bukti_sisa'] != NULL && session()->get('akses1') == '1' && $r['status_pemesanan'] == "5") { ?>
                                                <button class="btn btn-outline-danger" title="Produk Sudah Di Ambil" onclick="location.href=('<?= base_url('Pemesanan/gantistatus/') . $r['status_pemesanan'] . '/' . $r['kode_pemesanan'] ?>')">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </button>
                                            <?php } else if ($sisa > 0 && session()->get('akses1') == '4') { ?>
                                                <button type="button" class="btn btn-outline-success" onclick="location.href=('<?= base_url('Pemesanan/bayar/') . $r['kode_pemesanan'] ?>')" title="Silahkan Lunasi Pembayaran">
                                                    <i class="fas fa-money-bill"></i>
                                                </button>
                                            <?php } ?>
                                            <?php if (session()->get('akses1') == '1' || session()->get('akses1') == '3') { ?>
                                                <?php if ($r['bukti_dp'] != NULL) { ?>
                                                    <a class="btn btn-outline-success" target="_blank" href="<?= base_url('fotobukti/') . $r['bukti_dp'] ?>" title="Check Bukti Pembayaran 1">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($r['bukti_sisa'] != NULL) { ?>
                                                    <a class="btn btn-outline-primary" target="_blank" href="<?= base_url('fotobukti2/') . $r['bukti_sisa'] ?>" title="Check Bukti Pembayaran 2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                <?php } ?>
                                            <?php } ?>
                                            <a type="button" class="btn btn-outline-primary" target="_blank" title="Cetak Faktur Pemesanan" href="<?= base_url('Laporan/CetakFaktur/' . $r['kode_pemesanan'] . '/' . $r['kode_pelanggan'] . '/' . $r['tgl_pemesanan']) ?>">
                                                <i class="fas fa-print"></i>
                                            </a>
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

<!-- Modal Ganti Status -->
<div class="modal fade text-left" id="modal-check" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="myModalLabel130">
                    Check Pembayaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Pemesanan/gantistatus') ?>" enctype="multipart/form-data" method="POST">
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
                            <td><label>Status Proses</label></td>
                            <td>
                                <select class="form-control" name="cbstt">
                                    <option value="">- Pilih Proses -</option>
                                    <?php foreach ($datastatus as $r) { ?>
                                        <option value="<?= $r['kode_status'] ?>"><?= $r['nama_status'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
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