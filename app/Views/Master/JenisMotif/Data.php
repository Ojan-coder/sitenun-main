<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Jenis Motif</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('/Admin/JenisMotif/Tambah') ?>')" class="btn btn-outline-primary" title="Tambah Data Jenis Motif">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty(session()->getFlashdata('success'))) { ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i> <b>Success.</b>
                                <?= session()->getFlashdata('success'); ?>
                            </div>
                        <?php
                        } ?>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th width="70px">Kode Jenis Motif</th> -->
                                    <th width="70px">Nama Motif</th>
                                    <th width="400px">Deskripsi</th>
                                    <th width="100px">Foto</th>
                                    <th width="10px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $r) {

                                ?>
                                    <tr>
                                        <!-- <td><?= $r['kode_jenis'] ?></td> -->
                                        <td><?= $r['jenis_motif'] ?></td>
                                        <td><?= $r['deskripsi'] ?></td>
                                        <td><img src="<?= base_url('fotojenismotif/') . $r['gambar_motif'] ?>" width="350px" height="150px"></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger" onclick="return ambil('<?= $r['kode_jenis'] ?>','<?= $r['gambar_motif'] ?>')" data-toggle="modal" data-target="#modal-danger" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>

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
                <form method="POST" action="<?= base_url('JenisMotif/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data Motif Ini ?
                        <input type="hidden" id="iduser" name="iduser">
                        <input type="hidden" id="foto" name="foto">
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
    function ambil(id, foto) {
        $('#iduser').val(id);
        $('#foto').val(foto);
    }
</script>