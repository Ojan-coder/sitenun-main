<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemesanan</h3>
                    </div>
                    <?php if ($imgdp == NULL) { ?>
                        <form action="<?= base_url('Pemesanan/bayardp') ?>" method="POST" enctype="multipart/form-data">
                        <?php } else { ?>
                            <form action="<?= base_url('Pemesanan/bayarsisa') ?>" method="POST" enctype="multipart/form-data">
                            <?php } ?>

                            <!-- <form action="<?= base_url('Pemesanan/simp_detail') ?>" method="POST" enctype="multipart/form-data"> -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label>No. Pemesanan</label>
                                    <input type="text" class="form-control" value="<?= $no_pemesanan ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Pemesanan</label>
                                    <input type="text" class="form-control" value="<?= $tgl_pemesanan ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" class="form-control" value="<?= session()->get('kode_user') . '-' . session()->get('nama') ?>" onkeydown="event.preventDefault()">
                                </div>
                            </div>

                            <div class="row">
                                <div style="padding-left: 30px;padding-right:30px;" class="col-md-12">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Pesanan</h3>
                                        </div>
                                        <?php
                                        if (!empty(session()->getFlashdata('success'))) { ?>
                                            <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                    <div class="alert alert-success alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <i class="icon fas fa-check"></i> Success.
                                                        <?= session()->getFlashdata('success'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else if (!empty(session()->getFlashdata('delete'))) { ?>
                                            <div class="row" style="align-items: center;">
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <i class="fa fa-warning" aria-hidden="true"></i> Delete.
                                                        <?= session()->getFlashdata('delete'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } ?>
                                        <div class="card-body">

                                            <hr>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th width="180px">Kode Produk</th>
                                                    <th>Motif Produk</th>
                                                    <th width="100px">Jumlah</th>
                                                    <th width="200px">Harga</th>
                                                    <td>Total</td>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $totalsemua = 0;
                                                        $imgdp;
                                                        $imgsisa;
                                                        foreach ($detailpesanan as $r) {
                                                            $imgdp = $r['bukti_dp'];
                                                            $imgsisa = $r['bukti_sisa'];
                                                            $total = $r['qty_produk_penjualan_detail'] * $r['harga_produk_penjualan_detail'];
                                                            $totalsemua = $totalsemua + $r['qty_produk_penjualan_detail'] * $r['harga_produk_penjualan_detail'];
                                                        ?>
                                                            <td><?= $r['kode_produk_penjualan_detail'] ?></td>
                                                            <td><?= $r['jenis_motif'] ?></td>
                                                            <td><?= $r['qty_produk_penjualan_detail'] ?></td>
                                                            <td><?= "Rp. " . number_format($r['harga_produk_penjualan_detail']) ?></td>
                                                            <td><?= "Rp. " . number_format($total) ?></td>

                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="4" align="center"><b>Total Semua :</b></td>
                                                    <td colspan="1"><?= "Rp. " . number_format($totalsemua) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Bayar :</td>
                                                    <td colspan="5"><input type="number" class="form-control" name="bayardp"></td>
                                                </tr>
                                                <tr>

                                                    <td>Upload Bukti Bayar 1 :</td>
                                                    <td colspan="5">
                                                        <?php if ($imgdp == NULL) { ?>
                                                            <input type="file" class="form-control" name="gambar" id="gambar">
                                                            <span><i>Untuk Pembayaran Silahkan Ke Rekening BRI : 5418 0101 2437 534 a/n Novi Putri Sesmita</i></span>
                                                        <?php } else { ?>
                                                            <input type="file" class="form-control" name="gambar" id="gambar">
                                                            <span><i>Untuk 2 Pembayaran Silahkan Ke Rekening BRI : 5418 0101 2437 534 a/n Novi Putri Sesmita</i></span>
                                                        <?php } ?>
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Pelanggan/PO') ?>')" class="btn btn-outline-danger" title="Kembali">
                                                <i class="fa fa-arrow-left"></i> Batal
                                            </button>
                                            <button type="submit" id="submit" class="btn btn-outline-primary">
                                                <i class="fas fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var kode = $('#kodeproduk').val();
            var kodem = $('#kodemotif').val();
            var jumlah = $('#jumlahbahanbaku').val();
            var jumlah1 = $('#jumlah1').val();
            var harga = $('#harga').val();
            datanya = "&kodeproduk=" + kode + "&kodemotif=" + kodem + "&jumlahbahanbaku=" + jumlah + "&jumlah1=" + jumlah1 + "&harga=" + harga;
            $.ajax({
                url: "<?php echo site_url('Pemesanan/simp_detail') ?>",
                data: datanya,
                type: "POST",
                cache: false,
                success: function(msg) {}
            })
        });
        $(document).ajaxStop(function() {
            window.location.reload();
        });
    });

    function refreshPage() {
        location.reload(true);
    }

    function ambil(kodeproduk, nama, kodemotif, namamotif, qty, harga) {
        $('#kodeproduk').val(kodeproduk);
        $('#namaproduk').val(nama);
        $('#kodemotif').val(kodemotif);
        $('#namamotif').val(namamotif);
        $('#jumlah1').val(qty);
        $('#harga').val(harga);
        $('#modal-xl').modal('hide');
    }
</script>