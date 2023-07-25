<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Karyawan') ?>')" class="btn btn-outline-danger" title="Kembali">
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
                        <form id="form" action="<?= base_url('Admin/Store-karyawan') ?>" method="POST" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="namapelanggan" id="namapelanggan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgllahir" id="tgllahir" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="cbjenkel" class="form-control">
                                    <option>-Pilih-</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label>No.Telp/Hp</label>
                                <input type="number" name="notelp" id="notelp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select name="cblevel" class="form-control">
                                    <option>Pilih</option>
                                    <?php foreach($level as $r){ ?>
                                    <option value="<?= $r['id_level'] ?>"><?= $r['nama_level'] ?></option>
                                    <?php } ?>
                                </select>
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