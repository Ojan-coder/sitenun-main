<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="container-fluid">
                <div class="row sm-16">
                    <?php
                    if (session()->get('akses1') == '4') {
                    ?>
                        <div class="col-sm-6">
                            <h1 class="m-0"><small>Selamat Datang </small><?= session()->get('nama') ?></h1>
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-6">
                            <h1 class="m-0"><small>Si-Tenun </small>Lintau Buo</h1>
                        </div>
                    <?php } ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($isi) {
        echo view($isi);
    }
    ?>
</div>