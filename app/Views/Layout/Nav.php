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
        <?php
        $request = \Config\Services::request();
        $id = $request->uri->getSegment(2);
        ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Beranda -->
                <li class="nav-item">
                    <a href="<?= base_url('Beranda') ?>" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard <?= $id ?>
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <!-- Master -->
                <?php if (session()->get('akses1') == '0' || session()->get('akses1') == '1' || session()->get('akses1') == '2') { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('Produksi') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produksi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (session()->get('akses1') == '0' || session()->get('akses1') == '1') { ?>
                    <li class="nav-header">Transaksi</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Penjualan') ?>" class="nav-link">
                            <i class="nav-icon fas fa-cart-shopping"></i>
                            <p>
                                Penjualan
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Penjualan') ?>" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Pembelian
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    
                    <li class="nav-header">LAPORAN</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>Informational</p>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-header">SETTINGS</li>
                <?php if (session()->get('akses1') == '0' || session()->get('akses1') == '1') { ?>
                    <!-- User -->
                    <li class="nav-item">
                        <a href="<?= base_url('User') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Pelanggan') {
                                                                                echo 'active';
                                                                            } ?>">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                User
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    <!-- Pelanggan -->
                    <li class="nav-item">
                        <a href="<?= base_url('Pelanggan') ?>" class="nav-link <?php if ($request->uri->getSegment(2) == 'Pelanggan') {
                                                                                    echo 'active';
                                                                                } ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pelanggan
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= base_url('Logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>