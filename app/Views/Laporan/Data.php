<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Laporan</h3>
                    </div>
                    <form action="<?= base_url('Laporan/Cetak') ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Periode</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Periode</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="cbjenislaporan">
                                    <option>-Pilih Laporan-</option>
                                    <option value="1">Laporan Material</option>
                                    <option value="2">Laporan Produk</option>
                                    <option value="3">Laporan Pelanggan</option>
                                    <option value="4">Laporan Bahan Baku</option>
                                    <option value="5">Laporan Pembelian Bahan Baku</option>
                                    <option value="6">Laporan Pemesanan</option>
                                    <option value="7">Laporan Penjualan</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>