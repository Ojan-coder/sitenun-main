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
                                <button type="button" onclick="location.href=('<?= base_url('Pemesanan/simp_detail_home/' . $r['kode_produk'] . '/' . $r['nama_produk'] . '/' . $r['harga_produk']) ?>')" class="btn btn-outline-success" title="Tambah Pesanan">
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