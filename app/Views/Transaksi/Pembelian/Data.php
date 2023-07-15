<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pembelian Bahan Baku</h3>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/PembelianBahanBaku/Bahanbaku-Tambah') ?>')" class="btn btn-outline-success" title="Tambah Pembelian Bahan Baku">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                                    <th>No. Transaksi</th>
                                    <th>Tanggal Pembelian Bahan Baku</th>
                                    <th>Total</th>
                                    <th width="10px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $r) {
                                ?>

                                    <tr>
                                        <td><?= $r['kode_bahan_baku_masuk'] ?></td>
                                        <td><?= $r['tgl_bahan_baku_masuk'] ?></td>
                                        <td><?= "Rp. " . number_format($r['total_harga_bahan_baku_masuk']) ?></td>
                                        <td>
                                            <button class="btn btn-outline-success" title="Detail" onclick="location.href=('<?= base_url('PembelianBahanBaku/Detail/').$r['kode_bahan_baku_masuk'] ?>')">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </td>
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