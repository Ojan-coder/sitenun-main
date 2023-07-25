<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="container-fluid">
                <div class="row sm-16">
                    <?php
                    if (session()->get('akses1') == '4') {
                    ?>
                        <div class="col-sm-6">
                            <!-- <h1 class="m-0"><small>Selamat Datang </small><?= session()->get('nama') ?></h1> -->
                        </div>
                    <?php } else { ?>
                        <div class="col-sm-6">
                            <h1 class="m-0"><small>Si-Tenun </small>Lintau Buo</h1>
                        </div>
                    <?php } ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <?php if (session()->get('akses1') == '4') { ?>
                                <li class="breadcrumb-item active">Pelanggan</li>
                            <?php } else { ?>
                                <li class="breadcrumb-item active">Home</li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-outline card-primary">

    </div>
    <div class="form-group">
        <center>
            <h4>Selamat Datang</h4>
            Sentra Industri Tenun
            <h5>Taluak, Kec. Lintau Buo, Kabupaten Tanah Datar, Sumatera Barat 27292</h5>
        </center>
    </div>
    <?php
    if ($isi) {
        echo view($isi);
    }
    ?>
</div>