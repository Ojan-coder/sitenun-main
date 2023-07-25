<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Detail Produksi</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Produksi') ?>')" class="btn btn-outline-danger" title="Data Produksi">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
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
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td width="200px">Nama Produk</td>
                                <td><input type="text" value="<?= $produk['nama_produk'] ?>" class="form-control" onkeydown="event.preventDefault()"></td>
                            </tr>
                            <tr>
                                <td width="200px">Jenis Motif</td>
                                <td><input type="text" value="<?= $produk['jenis_motif'] ?>" class="form-control" onkeydown="event.preventDefault()"></td>
                            </tr>
                        </table>
                        <br>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. Produksi</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Nama Bahan Baku</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalsemua = 0;
                                foreach ($data as $r) {
                                ?>

                                    <tr>
                                        <td><?= $r['kode_produksi_detail'] ?></td>
                                        <td><?= date('d F Y', strtotime($r['created_at'])) ?></td>
                                        <td><?= $r['nama_bahan_baku'] ?></td>
                                        <td><?= $r['qty_bahan_baku_produksi'] ?></td>
                                    </tr>
                                <?php } ?>
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
                <form method="POST" action="<?= base_url('Bahanbaku/delete') ?>">
                    <div class="modal-body" style="color: black;">
                        Apakah Yakin Ingin Menghapus Data Pembelian Bahan Baku Ini ?
                        <input type="text" id="iduser" name="idmasuk">
                        <input type="text" id="idbahan" name="idbahan">
                        <input type="text" id="jumlahsekarang" name="sekarang">
                        <input type="text" id="beli" name="jumlahbeli">
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
    function ambil(id, idbahan, beli) {
        $('#iduser').val(id);
        $('#idbahan').val(idbahan);
        $('#jumlahsekarang').val(skrng);
        $('#beli').val(skrng);
        $('#modal-danger').hide();
    }
</script>