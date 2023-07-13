<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-danger alert-dismissible">
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
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i> Success.
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php
                        } ?>
                        <form id="form" action="<?= base_url('/Admin/Store-produk') ?>" method="POST" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <div class="row">
                                <!-- Data Motif -->
                                <div class="col-md-6">
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Motif</h3>
                                        </div>
                                        <div class="card-body">
                                            <table width="100%">
                                                <tr>
                                                    <td colspan="3"><label>Jenis Motif</label></td>
                                                </tr>
                                                <tr>
                                                    <td width="100%">
                                                        <input type="hidden" name="kode_motif" id="kode_motif" class="form-control" required>
                                                        <input type="text" name="namaproduk" id="namaproduk" class="form-control" required>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-outline-success" title="Cari Data Motif" type="button" data-toggle="modal" data-target="#modal-motif" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><label>Deskripsi</label></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Data Produk -->
                                <div class="col-md-6">
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Data Produk</h3>
                                        </div>
                                        <div class="card-body">
                                            <table width="100%">
                                                <tr>
                                                    <td><label>Nama Produk</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="namaproduk" value="<?= old('namaproduk') ?>" id="namaproduk" class="form-control" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Harga Produk</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" name="harga" id="harga" class="form-control" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Jumlah Produk</label></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Produk') ?>')" title="Kembali">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </button>
                        &nbsp;
                        <button type="submit" id="submit" class="btn btn-outline-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>


<!-- Modal Gangguan -->
<div class="modal fade" id="modal-motif">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header outline-primary">
                <h4 class="modal-title">Data Gangguan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered display">
                    <thead>
                        <th>Kode Jenis Motif</th>
                        <th>Motif</th>
                        <th>Deskripsi</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        <?php foreach ($jenismotif as $r) { ?>
                            <tr>
                                <td><?= $r['kode_jenis'] ?></td>
                                <td><?= $r['jenis_motif'] ?></td>
                                <td><?= $r['deskripsi'] ?></td>
                                <td>
                                    <button type="button" onclick="return ambilmotif('<?= $r['kode_jenis'] ?>','<?= $r['jenis_motif'] ?>','<?= $r['deskripsi'] ?>')" class="btn btn-outline-success">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </button>
                                </td>
                            <?php } ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function ambilmotif(kode, keterangan, alamat) {
        $('#kode_jenis').val(kode);
        $('#keterangan').val(keterangan);
        $('#alamat').val(alamat);
        $('#modal-motif').modal('hide')
    }
</script>