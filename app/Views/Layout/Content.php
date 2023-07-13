<?php
if (session()->get('akses1') == '1') {
    $akses = "Super Admin";
} else if (session()->get('akses1') == '2') {
    $akses = "Pimpinan";
} else if (session()->get('akses1') == '3') {
    $akses = "Produksi";
} else if (session()->get('akses1') == '4') {
    $akses = "Pelanggan";
}
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $akses ?></li>
                    </ol>
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