<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h6>Tambah Produksi</h6>
                    </div>
                    <div class="row">
                        <!-- Form Produksi -->
                        <div class="col-md-6" style="align-items: center;padding-right:20px;padding-left:20px;padding-top:20px;">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Data Produk</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $errors = session()->getFlashdata('errors');
                                    if (!empty($errors)) { ?>
                                        <div class="alert alert-danger alert-dismissible" style="align-items: center;padding-right:20px;padding-left:20px;padding-top:20px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                            <h6><b>!! Ada Kesalahan Input Data :</b></h6>
                                            <ul>
                                                <?php foreach ($errors as $key => $error) { ?>
                                                    <li><?= esc($error) ?></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    if (!empty(session()->getFlashdata('success'))) { ?>
                                        <div class="alert alert-success alert-dismissible" style="align-items: center;padding-right:20px;padding-left:20px;padding-top:20px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="icon fas fa-check"></i> Success.
                                            <?= session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php
                                    } ?>
                                    <form id="form" action="<?= base_url('/Admin/Store-produksi') ?>" method="POST" enctype="multipart/form-data">
                                        <!-- <form id="form" action="<?= base_url('Produksi/simp_detail') ?>" method="POST" enctype="multipart/form-data"> -->
                                        <?php csrf_field(); ?>


                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" id="kodejenis" name="kodeproduk">
                                                <input type="text" class="form-control" name="namaproduk" id="namaproduk" aria-describedby="button-addon2" onkeydown="event.preventDefault()">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl" type="button" id="button-addon2">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Motif</label>
                                            <input type="text" id="motif" class="form-control" onkeydown="event.preventDefault()">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Produk</label>
                                            <input type="number" name="harga" id="harga" class="form-control" onkeydown="event.preventDefault()">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Produk</label>
                                            <input type="hidden" name="jumlahlama" id="jumlahlama" class="form-control">
                                            <input type="number" name="jumlahbaru" id="jumlahbaru" class="form-control">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form Data Bahan Baku Dipakai -->
                        <div class="col-md-6" style="padding-top:20px;padding-right:30px;">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Data Bahan</h3>
                                </div>
                                <br>
                                <?php
                                if (!empty(session()->getFlashdata('successbahanbaku'))) { ?>
                                    <div class="row" style="align-items: center;padding-right:20px;padding-left:20px;padding-top:20px;">
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
                                    <div class="row" style="align-items: center;padding-right:20px;padding-left:20px;padding-top:20px;">
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
                                                Jumlah Terpakai
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control kodebahanbaku" name="kodebahanbaku" id="kodebahanbaku">
                                                <input type="text" class="form-control" id="nama_bahan_baku" onkeydown="event.preventDefault()">
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control jumlah1" name="jumlah1" id="jumlah1">
                                                <input type="text" class="form-control jumlahbahanbaku" name="jumlahbahanbaku" id="jumlahbahanbaku">
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
                                            <th width="200px">Kode Bahan Baku</th>
                                            <th>Bahan Baku</th>
                                            <th width="100px">Jumlah</th>
                                            <th width="10px">#</th>
                                        </thead>
                                        <tbody id="showdata">
                                            <?php
                                            foreach ($detailbahanbaku as $r) {
                                            ?>
                                                <tr>
                                                    <td><?= $r['kode_bahan_baku_detail'] ?></td>
                                                    <td><?= $r['nama_bahan_baku'] ?></td>
                                                    <td><?= $r['qty_bahan_baku_produksi'] ?> </td>
                                                    <td>
                                                        <a class="btn btn-outline-danger" id="hapus" href="<?= base_url('Produksi/delete_bahanbaku/' . $r['kode_bahan_baku_detail']) . '/' . $r['qty_bahan_baku_produksi'] . '/' . $r['jumlah_bahan_baku'] . '/' . $r['id'] ?>" title="Hapus Data Bahan Baku">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    <?php } ?>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Produksi') ?>')" class="btn btn-outline-danger" title="Kembali">
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

<!--Produk Modal -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Motif Produk</th>
                            <th>Harga Produk</th>
                            <th>Jumlah Produk</th>
                            <th width="20">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($produk as $r) {

                        ?>
                            <tr>
                                <td><?= $r['nama_produk'] ?></td>
                                <td><?= $r['jenis_motif'] ?></td>
                                <td><?= "Rp. " . number_format($r['harga_produk']) ?></td>
                                <td><?= $r['jumlah_produk'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return ambil('<?= $r['kode_produk'] ?>','<?= $r['nama_produk'] ?>','<?= $r['jenis_motif'] ?>','<?= $r['harga_produk'] ?>','<?= $r['jumlah_produk'] ?>')"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>

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
                        <th width="20">#</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($bahanbaku as $r) {
                        ?>
                            <tr>
                                <td><?= $r['nama_bahan_baku'] ?></td>
                                <td><?= $r['jumlah_bahan_baku'] ?>/<?= $r['satuan_bahan_baku'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return ambil1('<?= $r['kode_bahan_baku'] ?>','<?= $r['nama_bahan_baku'] ?>','<?= $r['jumlah_bahan_baku'] ?>')"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
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
            var id = 1;
            var kode = $('#kodebahanbaku').val();
            var jumlah = $('#jumlahbahanbaku').val();
            var jumlah1 = $('#jumlah1').val();

            var kodeproduk = $('#kodeproduk').val();
            var namaproduk = $('#namaproduk').val();
            var motif = $('#motif').val();
            var harga = $('#harga').val();
            var jumlahbaru = $('#jumlahbaru').val();
            var jumlahlama = $('#jumlahlama').val();
            datanya = "&kodebahanbaku=" + kode + "&jumlahbahanbaku=" + jumlah + "&jumlah1=" + jumlah1 + "&kodeproduk=" + kodeproduk + "&namaproduk=" + namaproduk + "&motif=" + motif + "&harga=" + harga + "&jumlahbaru=" + jumlahbaru + "&jumlahlama=" + jumlahlama;
            $.ajax({
                url: "<?php echo site_url('Produksi/simp_detail') ?>",
                data: datanya,
                dataType: 'json',
                type: "POST",
                cache: false,
                success: function(msg) {

                    // $("#showdata").ajax.reload();
                    // $('#showdata').DataTable().ajax.reload();
                    // $('#kodeproduk').val(kodeproduk);
                    // $('#namaproduk').val(namaproduk);
                    // $('#motif').val(motif);
                    // $('#jumlahbaru').val(jumlahbaru);
                    // $('#jumlahlama').val(jumlahlama);
                    // $('#showdata').refreshPage();
                }
            })
        });
        $(document).ajaxStop(function() {
            window.location.reload();
        });
    });

    function refreshTable() {
        $('.showdata').each(function() {
            dt = $(this).dataTable();
            dt.fnDraw();
        })
    }

    // function refreshPage() {
    //     location.reload(true);
    // }

    function ambil(kode, namaproduk, motif, harga, jumlah) {
        $('#kodejenis').val(kode);
        $('#namaproduk').val(namaproduk);
        $('#motif').val(motif);
        $('#harga').val(harga);
        $('#jumlahlama').val(jumlah);
        $('#modal-xl').modal('hide');
    }

    function ambil1(kode, nama, jumlah) {
        $('#kodebahanbaku').val(kode);
        $('#nama_bahan_baku').val(nama);
        $('#jumlah1').val(jumlah);
        $('#modal-bahanbaku').modal('hide');
    }
</script>