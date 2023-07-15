<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pemesanan</h3>
                    </div>
                    <form action="<?= base_url('Pemesanan/Store') ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>No. Pemesanan</label>
                                <input type="text" class="form-control" value="<?= $no_pemesanan ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pemesanan</label>
                                <input type="text" class="form-control" value="<?= $tgl_pemesanan ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div style="padding-left: 30px;padding-right:30px;" class="col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Produksi</h3>
                                    </div>
                                    <?php
                                    if (!empty(session()->getFlashdata('successbahanbaku'))) { ?>
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
                                    } else if (!empty(session()->getFlashdata('deletebahanbaku'))) { ?>
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
                                        <table width="100%">
                                            <tr>
                                                <th>
                                                    Nama Produk
                                                </th>
                                                <th>
                                                    Nama Motif
                                                </th>
                                                <th>
                                                    Qty
                                                </th>
                                                <th>
                                                    Harga
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="hidden" class="form-control kodeproduk" name="kodeproduk" id="kodeproduk">
                                                    <input type="text" class="form-control" id="namaproduk">
                                                </td>
                                                <td>
                                                    <input type="hidden" class="form-control kodemotif" name="kodemotif" id="kodemotif">
                                                    <input type="text" class="form-control namamotif" name="namamotif" id="namamotif">
                                                </td>
                                                <td>
                                                    <input type="hidden" class="form-control jumlah1" name="jumlah1" id="jumlah1">
                                                    <input type="text" class="form-control jumlahbahanbaku" name="jumlahbahanbaku" id="jumlahbahanbaku">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control harga" name="harga" id="harga">
                                                </td>
                                                <td width="100px">
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-xl" title="Cari Data Bahan Baku">
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
                                                <th width="200px">Kode Produk</th>
                                                <th>Motif Produk</th>
                                                <th width="100px">Jumlah</th>
                                                <th width="100px">Harga</th>
                                                <th width="10px">#</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Produk') ?>')" class="btn btn-outline-danger" title="Kembali">
                                    <i class="fa fa-arrow-left"></i> Batal
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



<!--Produk Modal -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel130">
                    Data Produk
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Motif</th>
                            <th>Harga</th>
                            <th width="20">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($dataproduk as $r) { ?>
                                <td><?= $r['nama_produk'] ?></td>
                                <td><?= $r['jenis_motif'] ?></td>
                                <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                <td>
                                    <button class="btn btn-outline-success" onclick="return ambil('<?= $r['kode_produk'] ?>','<?= $r['nama_produk'] ?>','<?= $r['kode_jenis_motif'] ?>','<?= $r['jenis_motif'] ?>','<?= $r['jumlah_produk'] ?>','<?= $r['harga_produk'] ?>')">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </button>
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
            var kode = $('#kodeproduk').val();
            var jumlah = $('#jumlahbahanbaku').val();
            var jumlah1 = $('#jumlah1').val();
            datanya = "&kodeproduk=" + kode + "&jumlahbahanbaku=" + jumlah + "&jumlah1=" + jumlah1;
            $.ajax({
                url: "<?php echo site_url('Produk/simp_detail') ?>",
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