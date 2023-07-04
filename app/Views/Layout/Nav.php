<?php
$request = \Config\Services::request();
$id = $request->uri->getSegment(1);
?>
<!-- 
    1 = Super Admin
    2 = Pimpinan
    3 = Produksi
    4 = Pelanggan
-->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Si-Tenun</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('nama') ?></a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Beranda -->
                <li class="nav-item">
                    <a href="<?= base_url('/Admin/Beranda') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Beranda') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Master Admin-->
                <?php if (session()->get('akses1') == '1' || session()->get('akses1') == '2' || session()->get('akses1') == '3') { ?>

                    <li class="nav-item <?php if ($request->uri->getSegment(2) == 'Produk' || $request->uri->getSegment(2) == 'Pelanggan' || $request->uri->getSegment(2) == 'Bahanbaku' || $request->uri->getSegment(2) == 'JenisMotif') {
                                            echo 'menu-open';
                                        } ?>">
                        <a href="#" class="nav-link <?php if ($request->uri->getSegment(2) == 'Produk' || $request->uri->getSegment(2) == 'Pelanggan' || $request->uri->getSegment(2) == 'Bahanbaku' || $request->uri->getSegment(2) == 'JenisMotif') {
                                                        echo 'active';
                                                    } ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('/Admin/Produk') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Produk') {
                                                                                                echo 'active';
                                                                                            } ?>">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Produksi</p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('/Admin/JenisMotif') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'JenisMotif') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Jenis Motif</p>
                                </a>

                            </li>
                            <!-- <li class="nav-item">
                                <a href="<?= base_url('/Admin/Bahanbaku') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Bahanbaku') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>Bahan Baku</p>
                                </a>
                            </li> -->
                            <!-- Pelanggan -->
                            <li class="nav-item">
                                <a href="<?= base_url('/Admin/Pelanggan') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Pelanggan') {
                                                                                                    echo 'active';
                                                                                                } ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Pelanggan
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!-- Transaksi Admin -->
                <?php if (session()->get('akses1') == '1' || session()->get('akses1') == '2') { ?>

                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/Admin/Penjualan') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Penjualan') {
                                                                                            echo 'active';
                                                                                        } ?>">
                            <i class="nav-icon fas fa-cart-shopping"></i>
                            <p>
                                Penjualan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/Admin/PO') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'PO') {
                                                                                    echo 'active';
                                                                                } ?>">
                            <i class="nav-icon fa fa-cart-plus" aria-hidden="true"></i>
                            <p>
                                Pesanan Order
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="<?= base_url('/Admin/Pembelian') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Pembelian') {
                                                                                            echo 'active';
                                                                                        } ?>">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Pembelian Bahan Baku
                                <span class="right badge badge-danger">New</span> -->
                    </p>
                    </a>
                    </li>
                <?php } ?>
                <!-- Settings -->
                <?php if (session()->get('akses1') == '0' || session()->get('akses1') == '1') { ?>
                    <li class="nav-header">LAPORAN</li>
                    <li class="nav-item">
                        <a href="<?= base_url('LpProduksi') ?>" class="nav-link">
                            <i class="nav-icon fa fa-print text-danger"></i>
                            <p>Produksi</p>
                        </a>
                    </li>
                    <li class="nav-header">SETTINGS</li>
                    <!-- User -->
                    <li class="nav-item">
                        <a href="<?= base_url('/Admin/User') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'User') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Pegawai
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('/Admin/Logout') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Transaksi Pelanggan -->
                <?php if (session()->get('akses1') == '4') { ?>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/Pelanggan/PO') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'PO') {
                                                                                        echo 'active';
                                                                                    } ?>">
                            <i class="nav-icon fa fa-cart-plus" aria-hidden="true"></i>
                            <p>
                                Pesanan Order
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php if (session()->get('akses1') == '4') { ?>
                    <li class="nav-header">SETTINGS</li>
                    <!-- Logout -->
                    <li class="nav-item">
                        <a href="<?= base_url('/Admin/Logout') ?>" class="nav-link">
                            <i class="nav-icon fas fa-sign-out"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>

    </div>

</aside>