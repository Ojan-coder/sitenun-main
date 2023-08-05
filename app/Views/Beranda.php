<?php
$db = \Config\Database::connect();
$produk = $db->query("SELECT SUM(jumlah_produk) as jumlah from tbl_produk ")->getRowArray();
$pelanggan = $db->query("SELECT COUNT(kodepelanggan) as jumlah from pelanggan ")->getRowArray();
$penjualan = $db->query("SELECT SUM(total_harga_penjualan) as jumlah from tbl_penjualan ")->getRowArray();
$pemesanan = $db->query("SELECT SUM(dp_pemesanan+bayar_sisa) as jumlah from tbl_pemesanan ")->getRowArray();
$bahanbaku = $db->query("SELECT SUM(jumlah_bahan_baku) as jumlah from tbl_bahan_baku ")->getRowArray();
$bahanbakuterpakai = $db->query("SELECT SUM(qty_bahan_baku_produksi) as jumlah from tbl_produksi_detail ")->getRowArray();
$pembelianbahanbaku = $db->query("SELECT SUM(total_harga_bahan_baku_masuk) as jumlah from tbl_bahan_baku_masuk ")->getRowArray();
$jenistenun = $db->query("SELECT COUNT(kode_jenis) as jumlah from tbl_jenis_tenun ")->getRowArray();

?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $produk['jumlah'] ?></h3>
                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url('Admin/Produk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $pelanggan['jumlah'] ?>&nbsp;<i class="fa fa-users" aria-hidden="true"></i></h3>
                        <p>Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= base_url('Admin/Pelanggan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Rp <?= number_format($penjualan['jumlah']) ?></h3>
                        <p>Penjualan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= base_url('Admin/Penjualan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rp. <?= number_format($pemesanan['jumlah']) ?></h3>
                        <p>Pemesanan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('Admin/Pemesanan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $bahanbaku['jumlah'] ?></h3>
                        <p>Bahan Baku</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('Admin/Bahanbaku') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $bahanbakuterpakai['jumlah'] ?></h3>
                        <p>Bahan Baku Terpakai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('Admin/Bahanbaku') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp. <?= number_format($pembelianbahanbaku['jumlah']) ?></h3>
                        <p>Pembelian Bahan Baku</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('Admin/PembelianBahanBaku') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $jenistenun['jumlah'] ?></h3>
                        <p>Jenis Tenun</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('Admin/JenisMotif') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>