<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('User-Tambah') ?>')" class="btn btn-outline-primary" title="Tambah Data User">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty(session()->getFlashdata('success'))) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i> Success.
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
                                            <button type="button" onclick="location.href=('<?= base_url('User/edit') . '/' . $r['iduser'] ?>')" class="btn btn-outline-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" onclick="return ambil('<?= $r['iduser'] ?>')" data-toggle="modal" data-target="#modal-danger" title="Hapus Data">
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

<!--Danger theme Modal -->
<div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel120">
                    Delete !!
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form method="POST" action="<?= base_url('User/delete') ?>">
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data User Ini ?
                    <input type="hidden" id="kodejenis" name="kodejenis">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">No</span>
                    </button>
                    <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Yes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Perhatian !</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <form method="POST" action="<?= base_url('User/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data User Ini ?
                        <input type="hidden" id="iduser" name="iduser">
                    </div>
            </div>
            <div class="modal-footer justify-content-between" style="background-color: white;">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-outline-danger">Yes</button>
            </div>
            </form>
        </div>

    </div>

</div>


<script>
    function ambil(id) {
        $('#iduser').val(id);
    }
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