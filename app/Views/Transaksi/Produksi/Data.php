<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Produksi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('/Admin/Produksi/Tambah') ?>')" class="btn btn-outline-primary" title="Tambah Data Produk">
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
                                    <th>Kode Produksi</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th width="70px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $r) {

                                ?>
                                    <tr>
                                        <td><?= $r['kode_produksi'] ?></td>
                                        <td><?= $r['jenis_motif'] ?></td>
                                        <td><?= $r['jumlah_produksi'] ?></td>
                                        <td><?= "Rp. " . number_format($r['harga_produk'])  ?></td>
                                        <td><img src="<?= base_url('fotojenismotif/') . $r['gambar_motif'] ?>" width="250px" height="150px"></td>
                                        <td>
                                            <!-- <button type="button" onclick="location.href=('<?= base_url('Produk/edit') . '/' . $r['kode_produksi'] ?>')" class="btn btn-outline-warning" title="Edit Data">
                                                <i class="fas fa-plus"></i>
                                            </button> -->
                                            <button type="button" class="btn btn-outline-danger" onclick="return ambil('<?= $r['kode_produksi'] ?>','<?= $r['gambar_motif'] ?>')" data-toggle="modal" data-target="#modal-danger" title="Hapus Data">
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
                <form method="POST" action="<?= base_url('Produk/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data Produk Ini ?
                        <input type="hidden" id="iduser" name="iduser">
                        <input type="text" id="foto" name="foto">
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
        $('#modal-danger').modal('hide');
    }
</script>