<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Pelanggan</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Pelanggan') ?>')" class="btn btn-outline-danger" title="Kembali">
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
                        <form id="form" action="<?= base_url('Pelanggan/update') ?>" method="POST" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" value="<?= $data['kodepelanggan'] ?>" name="kodepelanggan">
                                <input type="text" name="namapelanggan" value="<?= $data['namapelanggan'] ?>" id="namapelanggan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgllahir" value="<?= $data['tgl_lahir'] ?>" id="tgllahir" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="cbjenkel" class="form-control">
                                    <option>-Pilih-</option>
                                    <?php
                                    foreach ($jenkel as $r) {
                                    ?>
                                        <option value="<?= $r['kode_jenkel'] ?>" <?php if ($data['kodejenkel'] == $r['kode_jenkel']) echo "selected"; ?>><?= $r['jenis_kelamin'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat"><?= $data['alamat'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No.Telp/Hp</label>
                                <input type="number" name="notelp" id="notelp" class="form-control" value="<?= $data['notelp'] ?>" required>
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