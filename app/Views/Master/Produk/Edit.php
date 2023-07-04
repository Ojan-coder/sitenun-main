<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Stok Produksi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('/Admin/Produk') ?>')" class="btn btn-outline-danger" title="Kembali">
                            <i class="fa fa-arrow-left"></i>
                        </button>
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
                            <input type="hidden" name="kodeproduk" value="<?= $data['kode_produksi'] ?>">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <label class="form-control"><?= $data['jenis_motif'] ?></label>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"><?= $data['deskripsi'] ?></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label>Harga Produk</label>
                                <input type="number" value="<?= $data['harga_produk'] ?>" name="harga" id="harga" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <label>Sisa Produk</label>
                                <label class="form-control"><?= $data['jumlah_produk'] ?></label>
                                <input type="hidden" name="jumlahsisa" id="jumlahsisa" value="<?= $data['jumlah_produk'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tambah Produk</label>
                                <input type="number" name="jumlahtambah" id="jumlahtambah" class="form-control">
                            </div>
                            <div class="form-group">
                                <label id="gambar">Upload Foto</label>
                                <input type="hidden" value="<?= $data['gambarproduk'] ?>" name="foto">
                                </br> <?= $data['gambarproduk'] ?>
                                <input type="file" name="gambar" id="gambar" class="form-control">
                            </div>
                            <button type="submit" id="submit" style="width:50px" class="btn btn-outline-primary">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>