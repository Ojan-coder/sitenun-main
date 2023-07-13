<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/User-Tambah') ?>')" class="btn btn-outline-primary" title="Tambah Data User">
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
                                    <th>Username</th>
                                    <th width="50px">Status</th>
                                    <th width="150px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $status;
                                foreach ($data as $r) {
                                    $status = $r['status'];
                                    if ($r['status'] == 'Y') {
                                        $stt = "<span class='right badge badge-success'>Aktif</span>";
                                    } else {
                                        $stt = "<span class='right badge badge-danger'>Tidak Aktif</span>";
                                    }
                                ?>
                                    <tr>
                                        <td><?= $r['fullname'] ?></td>
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
                                                <button type="button" onclick="return gantin('<?= $r['iduser'] ?>','<?= $r['status'] ?>')" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-status-n" title="Non-Aktifkan Akun">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-outline-success" onclick="return gantiy('<?= $r['iduser'] ?>','<?= $r['status'] ?>')" data-toggle="modal" data-target="#modal-status-y" title="Aktifkan Akun">
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
                        Apakah Anda Yakin Ingin Menghapus Data User Ini ?
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

<!-- Modal Ganti Status User -->

?>
<div class="modal fade" id="modal-status-n">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">Perhatian !!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <form method="POST" action="<?= base_url('User/changestatusn') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Anda Yakin Ingin Non-Aktifkan Akun Ini ?
                        <input type="hidden" id="idusern" name="idusern">
                    </div>
            </div>
            <div class="modal-footer justify-content-between" style="background-color: white;">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-outline-primary">Yes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-status-y">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">Perhatian !!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <form method="POST" action="<?= base_url('User/changestatusy') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Anda Yakin Ingin Aktifkan Akun Ini ?
                        <input type="text" id="idusery" name="idusery">
                    </div>
            </div>
            <div class="modal-footer justify-content-between" style="background-color: white;">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-outline-primary">Yes</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    function ambil(id) {
        $('#iduser').val(id);
    }

    function gantiy(id,stt) {
        $('#idusery').val(id);
    }
    function gantin(id,stt) {
        $('#idusern').val(id);
    }

    // $(document).ready(function() {
    //     $.validator.setDefaults({
    //         submitHandler: function() {
    //             alert("Form successful submitted!");
    //         }
    //     });

    //     $("#Form").validate({
    //         rules: {
    //             username: {
    //                 required: true,
    //             },
    //             nama: {
    //                 required: true,
    //             },
    //             password: {
    //                 required: true,
    //                 minlength: 8
    //             },
    //             terms: {
    //                 required: true
    //             },
    //         },
    //         messages: {
    //             username: {
    //                 required: "Please enter a username",
    //             },
    //             nama: {
    //                 required: "Please enter a Nama Lengkap"
    //             },
    //             password: {
    //                 required: "Please provide a password",
    //                 minlength: "Your password must be at least 5 characters long"
    //             },
    //             terms: "Please accept our terms"
    //         },
    //         errorElement: 'span',
    //         errorPlacement: function(error, element) {
    //             error.addClass('invalid-feedback');
    //             element.closest('.form-group').append(error);
    //         },
    //         highlight: function(element, errorClass, validClass) {
    //             $(element).addClass('is-invalid');
    //         },
    //         unhighlight: function(element, errorClass, validClass) {
    //             $(element).removeClass('is-invalid');
    //         }
    //     });
    // });
</script>