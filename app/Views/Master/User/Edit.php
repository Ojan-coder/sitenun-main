<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('User') ?>')" class="btn btn-outline-danger" title="Kembali">
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
                        <form action="<?= base_url('User/Update') ?>" method="POST">
                            <?php csrf_field(); ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="hidden" name="iduser" value="<?= $data['iduser'] ?>" class="form-control">
                                <input type="text" name="username" value="<?= $data['username'] ?>" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" value="<?= $data['fullname'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Akses</label>
                                <select name="cbakses" class="form-control">
                                    <option>-Pilih-</option>
                                    <?php
                                    foreach ($level as $r) {
                                    ?>
                                        <option value="<?= $r['id_level']?>"<?php if($r['id_level'] == $data['level_user'])echo "selected"; ?>><?= $r['nama_level'] ?></option>
                                    <?php } ?>
                                </select>
                                <script>
                                    document.getElementById('cbakses').value = '<?= $data['level_user'] ?>'
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Akses</label>
                                <select name="cbstatus" id="cbstatus" class="form-control">
                                    <option>-Pilih-</option>
                                    <option value="Y">Aktif</option>
                                    <option value="N">Non-Aktifr</option>
                                </select>
                                <script>
                                    document.getElementById('cbstatus').value = '<?= $data['status'] ?>'
                                </script>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" id="pass" class="form-control">
                            </div>
                            <button type="submit" style="width:50px" class="btn btn-outline-primary">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>