<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Admin', 'Login::index');
$routes->get('/admin', 'Login::index');
$routes->get('/Admin/Beranda', 'Home::home');
$routes->post('/Admin/In', 'Login::ceklogin');
$routes->get('/Admin/Logout', 'Login::Logout');

// Karyawan
$routes->get('/Admin/Karyawan', 'Karyawan::index');
$routes->get('/Admin/Karyawan-Tambah', 'User::tambah');
$routes->post('/Admin/Store-user', 'User::add');

// User routes
$routes->get('/Admin/User', 'User::index');
$routes->get('/Admin/User-Tambah', 'User::tambah');
$routes->post('/Admin/Store-user', 'User::add');

// Jenis Motif
$routes->get('/Admin/JenisMotif', 'JenisMotif::index');
$routes->get('/Admin/JenisMotif/Tambah', 'JenisMotif::tambah');
$routes->post('/Admin/Store-JenisMotif', 'JenisMotif::add');

// Bahan Baku
$routes->get('/Admin/Bahanbaku', 'Bahanbaku::index');
$routes->get('/Admin/Bahanbaku/Bahanbaku-Tambah', 'Bahanbaku::tambah');
$routes->post('/Admin/Bahanbaku/Store-Bahanbaku', 'Bahanbaku::add');

// Pembelian Bahan Baku
$routes->get('/Admin/PembelianBahanBaku', 'PembelianBahanBaku::index');
$routes->get('/Admin/PembelianBahanBaku/Bahanbaku-Tambah', 'PembelianBahanBaku::tambah');
$routes->post('/Admin/PembelianBahanBaku/Store-Bahanbaku', 'PembelianBahanBaku::add');

// Admin - Penjualan
$routes->get('/Admin/Produk', 'Produk::index');
$routes->get('/Admin/Produk/Tambah', 'Produk::tambah');
$routes->post('/Admin/Store-produk', 'Produk::add');


// Produk
$routes->get('/Admin/Penjualan', 'Penjualan::index');
$routes->get('/Admin/Penjualan/Tambah', 'Penjualan::tambah');
$routes->post('/Admin/Store-penjualan', 'Penjualan::add');

// Produksi
$routes->get('/Admin/Produksi', 'Produksi::index');
$routes->get('/Admin/Produksi/Tambah', 'Produksi::tambah');
$routes->post('/Admin/Store-produksi', 'Produksi::add');

// Pemesanan Produksi dan Admin
$routes->get('/Admin/Pemesanan', 'Pemesanan::index');
$routes->get('/Admin/Pemesanan/tambah', 'Pemesanan::tambah');
$routes->post('/Admin/Store-pemesanan', 'Pemesanan::add');

// Laporan
$routes->get('/Admin/Laporan', 'Laporan::index');


// Pelanggan
$routes->get('/Pelanggan/Login', 'Login::index');
$routes->get('/Pelanggan/Beranda', 'Home::home');
$routes->get('/Admin/Pelanggan', 'Pelanggan::index');
$routes->get('/Admin/Pelanggan-Tambah', 'Pelanggan::tambah');
$routes->post('/Admin/Store-pelanggan', 'Pelanggan::add');
$routes->get('/Pelanggan/Logout', 'Login::Logout');

// Pemesananan Pelanggan
$routes->get('/Tambah-Pesanan', 'Pemesanan::tambah');
$routes->get('/Pelanggan/PO', 'Pemesanan::index');


// Register Pelanggan With Login
$routes->get('/Pelanggan/Register', 'Pelanggan::register');
$routes->post('/Store-Register', 'Pelanggan::addregister');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
