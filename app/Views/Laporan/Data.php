<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Laporan</h3>
                    </div>
                    <form action="<?= base_url('Laporan/Cetak') ?>" data_target="_blank" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Periode</label>
                                <input type="date" class="form-control" name="tglawal">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Periode</label>
                                <input type="date" class="form-control" name="tglakhir">
                            </div>
                            <div class="form-group">
                                <label>Pilih Laporan</label>
                                <select class="form-control" name="cbjenislaporan">
                                    <option>-Pilih Laporan-</option>
                                    <option value="1">Laporan Bahan Baku</option>
                                    <option value="2">Laporan Produk</option>
                                    <option value="3">Laporan Pelanggan</option>
                                    <option value="4">Laporan Pembelian Bahan Baku</option>
                                    <option value="5">Laporan Pemesanan</option>
                                    <option value="6">Laporan Penjualan</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa fa-print" aria-hidden="true"></i> Cetak
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>