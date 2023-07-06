<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="<?= base_url() ?>" class="navbar-brand">
            <img src="<?= base_url() ?>img/logotenun.png" alt="AdminLTE Logo" class="brand-image  elevation-3" style="opacity: .8">

        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">Home</a>
                </li>
                <?php
                if (session()->get('masuk') == TRUE && session()->get('akses1') == '4') {
                ?>
                    <li class="nav-item">
                        <a href="<?= base_url('Pelanggan/PO') ?>" class="nav-link">Pesanan Order</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"></a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item">Laporan Gangguan </a></li>
                        </ul>
                    </li> -->
                <?php } ?>
            </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">

                        <div class="media">
                            <img src="<?= base_url('assets/') ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>

                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <?php
            if (session()->get('masuk') == TRUE) {
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" title="<?= session()->get('nama') ?>">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">

                            <div class="media">
                                <img src="<?= base_url('assets/') ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?= session()->get('nama') . ' / ' . session()->get('kode_user') ?>
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Logout" href="<?= base_url('Pelanggan/Logout') ?>">
                        <i class="fas fa-sign-out"></i>
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" title="Register Pelanggan" href="<?= base_url('Pelanggan/Register') ?>">
                        <i class="fas fa-user-plus"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Login" href="<?= base_url('Pelanggan/Login') ?>">
                        <i class="fas fa-sign-in"></i>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>