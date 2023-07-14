<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Stok Produksi</h3>
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
                        <form id="form" action="<?= base_url('Produk/update') ?>" method="POST" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <input type="hidden" name="kodeproduk" value="<?= $data['kode_produk'] ?>">
                            <div class="form-group">
                                <label>Nama Motif</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="kodejenis" value="<?= $data['kode_jenis'] ?>" name="kodejenis">
                                    <input type="text" id="namajenis" value="<?= $data['jenis_motif'] ?>" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl" type="button" id="button-addon2">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" class="form-control" name="namaproduk" value="<?= $data['nama_produk'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"><?= $data['deskripsi'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Harga Produk</label>
                                <input type="number" value="<?= $data['harga_produk'] ?>" name="harga" id="harga" class="form-control">
                            </div>

                    </div>
                    <div class="card-footer">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('/Admin/Produk') ?>')" class="btn btn-outline-danger" title="Kembali">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </button>
                        <button type="submit" id="submit" class="btn btn-outline-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Jenis Motif Modal -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Jenis Tenun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Motif</th>
                            <th>Deskripsi</th>
                            <th width="20">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($jenismotif as $r) {

                        ?>
                            <tr>
                                <td><?= $r['jenis_motif'] ?></td>
                                <td><?= $r['deskripsi'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="return ambil('<?= $r['kode_jenis'] ?>','<?= $r['jenis_motif'] ?>','<?= $r['deskripsi'] ?>')"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
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



<script>
    function ambil(kode, namaproduk, deskripsi) {
        $('#kodejenis').val(kode);
        $('#namajenis').val(namaproduk);
        $('#deskripsi').val(deskripsi);
        $('#modal-xl').modal('hide');
    }
</script>