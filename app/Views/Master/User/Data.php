<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" data-target="#modal-lg" class="btn btn-outline-primary" title="Tambah Data User">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <?php
                        $errors = session()->getFlashdata('errors');
                        if (!empty($errors)) { ?>
                            <div class="alert alert-light-danger color-danger">
                                <h5><i class="bi bi-exclamation-circle"></i> Error.</h5>
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
                            <div class="alert alert-light-success color-success">
                                <i class="bi bi-check-circle"></i> Success.
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php
                        } ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama User</th>
                                    <th>Usesrname</th>
                                    <th width="50px">Status</th>
                                    <th width="150px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $r) {
                                    if ($r['status'] == 'Y') {
                                        $stt = "<span class='right badge badge-success'>Aktif</span>";
                                    } else {
                                        $stt = "<span class='right badge badge-danger'>Tidak Aktif</span>";
                                    }
                                ?>
                                    <tr>
                                        <td><?= $r['namauser'] ?></td>
                                        <td><?= $r['username'] ?></td>
                                        <td class="text-center"><?= $stt ?></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <?php
                                            if ($r['status'] == 'Y') {
                                            ?>
                                                <button type="button" class="btn btn-outline-success" title="Non-Aktifkan Akun">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-outline-success" title="Aktifkan Akun">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="Form" action="<?= base_url('Store') ?>" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="namalengkap">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="namalengkap" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="custom-control-label" for="exampleCheck1" style="font-size: 14px;">Saya Setuju <a href="#">dengan persyaratan yang diajukan !</a>.</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                alert("Form successful submitted!");
            }
        });

        $("#Form").validate({
            rules: {
                username: {
                    required: true,
                },
                nama: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                terms: {
                    required: true
                },
            },
            messages: {
                username: {
                    required: "Please enter a username",
                },
                nama: {
                    required: "Please enter a Nama Lengkap"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>