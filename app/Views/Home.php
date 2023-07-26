<div class="content">

    <div class="row">
        <?php
        foreach ($produk as $r) {
        ?>
            <div class="col-lg-6">
                <!-- <form action="<?= base_url('Pemesanan/simp_detail') ?>" method="POST" enctype="multipart/form-data"> -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0"><b><?= $r['jenis_motif'] ?></b></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 text-center">
                                <img src="<?= base_url('fotojenismotif/') . $r['gambar_motif'] ?>" alt="user-avatar" height="100" width="160" class="img-rectangle img-fit">
                            </div>
                            <div class="col-12">
                                <h2 class="lead"></h2>
                                <p class="text-muted text-sm"><b>About: </b> <?= $r['deskripsi'] ?> </p>
                                <?php if (session()->get('masuk') == TRUE) { ?>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-money-bill"></i></span> &nbsp;&nbsp;<?= "Rp. " . number_format($r['harga_produk']) ?> / Meter</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-warehouse"></i></span> &nbsp; <?= $r['jumlah_produk'] ?></li>
                                    </ul>
                                <?php } ?>
                                <br>
                            </div>

                            <?php if ($r['jumlah_produk'] == 0) { ?>
                                <button class="btn btn-outline-danger" title="Stok Habis">
                                    <i class="fa fa-warning" aria-hidden="true"></i>
                                </button>
                            <?php } else if (session()->get('masuk') == TRUE) { ?>
                                <button type="button" id="tambah" onclick="return ambil1('<?= $r['kode_produk'] ?>','<?= $r['kode_jenis_motif'] ?>','<?= $r['jumlah_produk'] ?>','1','<?= $r['harga_produk'] ?>')" data-toggle="modal" data-target="#modal-konfirm" class="btn btn-outline-success" title="Masuk Pesanan">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        <?php } ?>
    </div>
</div>


<div class="modal fade" id="modal-konfirm">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5>
                    Konfirmasi Pesanan ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('pemesanan/simp_detail_home') ?>">
                    <input type="text" id="kodeproduk" name="kodeproduk">
                    <input type="text" id="kodem" name="kodem">
                    <input type="text" id="jumlah" name="jumlahproduk">
                    <input type="text" id="jumlah1" name="jumlahbeli">
                    <input type="text" id="harga" name="harga">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block"></i>
                    <span>Yes</span>
                </button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function ambil1(kodeproduk, kodem, jumlahproduk, jumlahbeli, harga) {
        $('#kodeproduk').val(kodeproduk);
        $('#kodem').val(kodem);
        $('#jumlah').val(jumlahproduk);
        $('#jumlah1').val(jumlahbeli);
        $('#harga').val(harga);
    }
</script>