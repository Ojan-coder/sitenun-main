<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h6>Tambah Data Pembelian Bahan Baku</h6>
                    </div>
                    <form action="<?= base_url('/Admin/PembelianBahanBaku/Store-Bahanbaku') ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>No.Pembelian Bahan Baku</label>
                                <input type="text" id="notransaksi" class="form-control" value="<?= $kodepembelian ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pembelian Bahan Baku</label>
                                <input type="text" class="form-control" value="<?= $tanggalpembelian ?>">
                            </div>
                        </div>

                        <!-- <form action="<?= base_url('PembelianBahanBaku/simp_detail') ?>" method="POST" enctype="multipart/form-data"> -->
                        <!-- Form Data Bahan Baku Dipakai -->
                        <div class="col-md-12" style="padding-left:20px;padding-right:20px;">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Bahan Baku</h3>
                                </div>
                                <br>

                                <?php
                                if (!empty(session()->getFlashdata('successbahanbaku'))) { ?>
                                    <div class="row" style="padding-right:20px;padding-left:20px; align-items: center;">
                                        <div class="col-md-12">
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <i class="icon fas fa-check"></i> Success.
                                                <?= session()->getFlashdata('successbahanbaku'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if (!empty(session()->getFlashdata('deletebahanbaku'))) { ?>
                                    <div class="row" style="padding-right:20px;padding-left:20px;align-items: center;">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <i class="fa fa-warning" aria-hidden="true"></i> Delete.
                                                <?= session()->getFlashdata('deletebahanbaku'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>

                                <div class="card-body">
                                    <table width="100%">
                                        <tr>
                                            <th>
                                                Nama Bahan Baku
                                            </th>
                                            <th>
                                                Jumlah
                                            </th>
                                            <th>
                                                Harga
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control kodebahanbaku" name="kodebahanbaku" id="kodebahanbaku">
                                                <input type="text" class="form-control" id="nama_bahan_baku">
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control jumlah1" name="jumlah1" id="jumlah1">
                                                <input type="number" class="form-control jumlahbahanbaku" name="jumlahbahanbaku" id="jumlahbahanbaku">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control harga" name="harga" id="harga">
                                            </td>
                                            <td width="100px">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-bahanbaku" title="Cari Data Bahan Baku">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-success tambah" id="tambah" title="Tambah Bahan Baku">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th width="100px">Kode Bahan Baku</th>
                                            <th width="200px">Bahan Baku</th>
                                            <th width="50px">Jumlah</th>
                                            <th width="50px">Harga</th>
                                            <th width="5px">#</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($detailbahanbaku as $r) {
                                                $total = $total + $r['harga_bahan_baku_masuk_detail'] * $r['qty_bahan_baku_masuk_detail'];
                                            ?>
                                                <tr>
                                                    <td><?= $r['kode_bahan_baku_detail'] ?></td>
                                                    <td><?= $r['nama_bahan_baku'] ?></td>
                                                    <td><?= $r['qty_bahan_baku_masuk_detail'] ?> </td>
                                                    <td><?= "Rp. " . number_format($r['harga_bahan_baku_masuk_detail']) ?> </td>
                                                    <td>
                                                        <a class="btn btn-outline-danger" id="hapus" href="<?= base_url('PembelianBahanBaku/delete_bahanbaku/' . $r['kode_bahan_baku_detail']) . '/' . $r['qty_bahan_baku_masuk_detail'] . '/' . $r['jumlah_bahan_baku'] . '/' . $r['id'] ?>" title="Hapus Data Bahan Baku">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    <?php } ?>
                                    <tr>
                                        <th>Total Harga</th>
                                        <td colspan="4">
                                            <input type="hidden" id="totalbayar" name="total" value="<?= $total ?>" class="form-control" />
                                            <span>Rp. <?= number_format($total) ?></span>
                                        </td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/PembelianBahanBaku') ?>')" class="btn btn-outline-danger" title="Kembali">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </button>
                            <button type="submit" id="submit" class="btn btn-outline-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<!--Bahan Baku Modal -->
<div class="modal fade text-left" id="modal-bahanbaku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel130">
                    Data Bahan Baku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <th>Bahan Baku</th>
                        <th>Jumlah / Satuan</th>
                        <th>Harga</th>
                        <th width="20">#</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bahanbaku as $r) {
                        ?>
                            <tr>
                                <td><?= $r['nama_bahan_baku'] ?></td>
                                <td><?= $r['jumlah_bahan_baku'] ?>/<?= $r['satuan_bahan_baku'] ?></td>
                                <td><?= $r['nama_bahan_baku'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return ambil1('<?= $r['kode_bahan_baku'] ?>','<?= $r['nama_bahan_baku'] ?>','<?= $r['jumlah_bahan_baku'] ?>','<?= $r['harga_bahan_baku'] ?>')"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var kode = $('#kodebahanbaku').val();
            var jumlah = $('#jumlahbahanbaku').val();
            var jumlah1 = $('#jumlah1').val();
            var harga = $('#harga').val();
            datanya = "&kodebahanbaku=" + kode + "&jumlahbahanbaku=" + jumlah + "&jumlah1=" + jumlah1 + "&harga=" + harga;
            $.ajax({
                url: "<?php echo site_url('PembelianBahanBaku/simp_detail') ?>",
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


    function ambil1(kode, nama, jumlah, harga) {
        $('#kodebahanbaku').val(kode);
        $('#nama_bahan_baku').val(nama);
        $('#jumlah1').val(jumlah);
        $('#harga').val(harga);
        $('#modal-bahanbaku').modal('hide');
    }
</script>