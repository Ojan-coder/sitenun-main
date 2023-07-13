<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Bahan Baku</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Bahanbaku') ?>')" class="btn btn-outline-danger" title="Kembali">
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
                        <form id="form" action="<?= base_url('/Admin/Bahanbaku/Store-Bahanbaku') ?>" method="POST" enctype="multipart/form-data">
                            <?php csrf_field(); ?>
                            <div class="form-group">
                                <label>Nama Bahan Baku</label>
                                <input type="text" name="nama" value="<?= old('nama') ?>" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan Bahan Baku</label>
                                <select class="form-control" id="" name="cbsatuan">
                                    <option>-Pilih-</option>
                                    <option value="Klos">Klos</option>
                                    <option value="Cm">Cm</option>
                                    <option value="m">m</option>
                                    <option value="lbr">Lbr</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Jumlah</label>
                                <input type="numer" name="jumlah" value="<?= old('jumlah') ?>" id="jumlah" class="form-control" required>
                            </div> -->
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

<script>
    $(document).ready(function() {
        // $.validator.setDefaults({
        //     submitHandler: function() {
        //         alert("Form successful submitted!");
        //     }
        // });

        $("#form").validate({
            rules: {
                gambar: {
                    mimes: "image/jpeg,image/png,image/jpg",
                    filesize: 2000
                },
            },
            messages: {
                gambar: {
                    mimes: "Extension gambar harus JPEG,JPG,PNG",
                    filesize: "Ukuran File Maximal 2MB"
                }
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