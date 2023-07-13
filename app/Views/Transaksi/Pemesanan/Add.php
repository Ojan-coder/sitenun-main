<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" data-toggle="modal" onclick="location.href=('<?= base_url('Admin/Produk') ?>')" class="btn btn-outline-danger" title="Kembali">
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="row">
                        <!-- Form Produksi -->

                        <!-- Form Data Produksi -->
                        <div class="col-md-12" style="padding-right: 20px;padding-top:10px;">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Data Produksi</h3>
                                </div>
                                <br>
                                <?php
                                if (!empty(session()->getFlashdata('successbahanbaku'))) { ?>
                                    <div class="row" style="align-items: center;">
                                        <div class="col-md-10">
                                            <div class="alert alert-success alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <i class="icon fas fa-check"></i> Success.
                                                <?= session()->getFlashdata('successbahanbaku'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else if (!empty(session()->getFlashdata('deletebahanbaku'))) { ?>
                                    <div class="row" style="align-items: center;">
                                        <div class="col-md-10">
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <i class="fa fa-warning" aria-hidden="true"></i> Delete.
                                                <?= session()->getFlashdata('deletebahanbaku'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                                <div class="card-body">
                                    <table width="100%">
                                        <tr>
                                            <th>
                                                Nama Motif
                                            </th>
                                            <th>
                                                Qty
                                            </th>
                                            <th>
                                                Harga
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" class="form-control kodebahanbaku" name="kodebahanbaku" id="kodebahanbaku">
                                                <input type="text" class="form-control" id="nama_bahan_baku">
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control jumlah1" name="jumlah1" id="jumlah1">
                                                <input type="text" class="form-control jumlahbahanbaku" name="jumlahbahanbaku" id="jumlahbahanbaku">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control harga" name="harga" id="harga">
                                            </td>
                                            <td width="100px">
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-bahanbaku" title="Cari Data Bahan Baku">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-success tambah" id="tambah" title="Tambah Bahan Baku">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th width="200px">Kode Bahan Baku</th>
                                            <th>Bahan Baku</th>
                                            <th width="100px">Jumlah</th>
                                            <th width="10px">#</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-outline-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Jenis Motif Modal -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Jenis Tenun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Motif</th>
                            <th width="20">#</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Bahan Baku Modal -->
<div class="modal fade text-left" id="modal-bahanbaku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel130">
                    Data Bahan Baku
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <th>Bahan Baku</th>
                        <th>Jumlah / Satuan</th>
                        <th width="20">#</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var kode = $('#kodebahanbaku').val();
            var jumlah = $('#jumlahbahanbaku').val();
            var jumlah1 = $('#jumlah1').val();
            datanya = "&kodebahanbaku=" + kode + "&jumlahbahanbaku=" + jumlah + "&jumlah1=" + jumlah1;
            $.ajax({
                url: "<?php echo site_url('Produk/simp_detail') ?>",
                data: datanya,
                type: "POST",
                cache: false,
                success: function(msg) {}
            })
        });
        $(document).ajaxStop(function() {
            window.location.reload();
        });
    });

    // function refreshPage() {
    //     location.reload(true);
    // }

    function ambil(kode, namaproduk, deskripsi) {
        $('#kodejenis').val(kode);
        $('#namaproduk').val(namaproduk);
        $('#deskripsi').val(deskripsi);
        $('#modal-xl').modal('hide');
    }

    function ambil1(kode, nama, jumlah) {
        $('#kodebahanbaku').val(kode);
        $('#nama_bahan_baku').val(nama);
        $('#jumlah1').val(jumlah);
        $('#modal-bahanbaku').modal('hide');
    }
</script>