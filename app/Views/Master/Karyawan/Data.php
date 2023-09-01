<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Karyawan/tambah') ?>')" class="btn btn-outline-primary" title="Tambah Data Karyawan">
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
                                    <th>Kode Karyawan</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>No.Telp</th>
                                    <th width="150px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $r) {
                                    if($r['kodejenkel_karyawan']=='P'){
                                        $jk = "Perempuan";
                                    }else{
                                        $jk="Laki-Laki";
                                    }
                                ?>
                                    <tr>
                                        <td><?= $r['kodekaryawan'] ?></td>
                                        <td><?= $r['namalengkap'] ?></td>
                                        <td><?= $r['tgl_lahir_karyawan'] ?></td>
                                        <td><?= $jk ?></td>
                                        <td><?= $r['alamat_karyawan'] ?></td>
                                        <td><?= $r['nohp_karyawan'] ?></td>
                                        <td>
                                            <button type="button" onclick="location.href=('<?= base_url('Karyawan/edit') . '/' . $r['kodekaryawan'] ?>')" class="btn btn-outline-warning" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" onclick="return ambil('<?= $r['kodekaryawan'] ?>')" data-toggle="modal" data-target="#modal-danger" title="Hapus Data">
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
                <form method="POST" action="<?= base_url('Karyawan/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data Karyawan Ini ?
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
</script>