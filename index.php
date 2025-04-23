<?php
session_start();
require_once 'koneksi.php';
require_once 'mahasiswa.php';
require_once 'matakuliah.php';
require_once 'krs.php';

function tampilkanFormTambahKRS() {
    formKRS('tambah');
}

function tampilkanFormEditKRS($id) {
    formKRS('edit', $id);
}

function tampilkanFormTambahMahasiswa() {
    formMahasiswa('tambah');
}

function tampilkanFormEditMahasiswa($npm) {
    formMahasiswa('edit', $npm);
}

function tampilkanFormTambahMatakuliah() {
    formMatakuliah('tambah');
}

function tampilkanFormEditMatakuliah($kodemk) {
    formMatakuliah('edit', $kodemk);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi KRS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        .navbar-brand { font-weight: bold; }
        .jumbotron { background-color: #f8f9fa; padding: 2rem; margin-bottom: 2rem; }
        .table { background-color: #fff; }
        footer { margin-top: 3rem; padding: 1rem 0; background-color: #f8f9fa; text-align: center; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Informasi KRS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php echo (!isset($_GET['page']) || $_GET['page'] == 'krs') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=krs">Data KRS</a>
                    </li>
                    <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'mahasiswa') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=mahasiswa">Data Mahasiswa</a>
                    </li>
                    <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'matakuliah') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=matakuliah">Data Mata Kuliah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'krs';
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        
        switch ($page) {
            case 'krs':
                echo '<div class="jumbotron">
                        <h1>Data KRS</h1>
                        <p class="lead">Kartu Rencana Studi Mahasiswa</p>';
                if ($action == 'list') {
                    echo '<a href="index.php?page=krs&action=tambah" class="btn btn-primary">Tambah KRS</a>';
                }
                echo '</div>';
                switch ($action) {
                    case 'list': tampilkanKRS(); break;
                    case 'tambah': tampilkanFormTambahKRS(); break;
                    case 'edit': $id = $_GET['id'] ?? ''; tampilkanFormEditKRS($id); break;
                    case 'hapus': $id = $_GET['id'] ?? ''; prosesHapusKRS($id); break;
                    case 'save': prosesKRS(); break;
                    default: tampilkanKRS();
                }
                break;

            case 'mahasiswa':
                echo '<div class="jumbotron">
                        <h1>Data Mahasiswa</h1>
                        <p class="lead">Informasi Mahasiswa</p>';
                if ($action == 'list') {
                    echo '<a href="index.php?page=mahasiswa&action=tambah" class="btn btn-primary">Tambah Mahasiswa</a>';
                }
                echo '</div>';
                switch ($action) {
                    case 'list': tampilkanMahasiswa(); break;
                    case 'tambah': tampilkanFormTambahMahasiswa(); break;
                    case 'edit': $npm = $_GET['npm'] ?? ''; tampilkanFormEditMahasiswa($npm); break;
                    case 'hapus': $npm = $_GET['npm'] ?? ''; prosesHapusMahasiswa($npm); break;
                    case 'save': prosesMahasiswa(); break;
                    default: tampilkanMahasiswa();
                }
                break;

            case 'matakuliah':
                echo '<div class="jumbotron">
                        <h1>Data Mata Kuliah</h1>
                        <p class="lead">Informasi Mata Kuliah</p>';
                if ($action == 'list') {
                    echo '<a href="index.php?page=matakuliah&action=tambah" class="btn btn-primary">Tambah Mata Kuliah</a>';
                }
                echo '</div>';
                switch ($action) {
                    case 'list': tampilkanMatakuliah(); break;
                    case 'tambah': tampilkanFormTambahMatakuliah(); break;
                    case 'edit': $kodemk = $_GET['kodemk'] ?? ''; tampilkanFormEditMatakuliah($kodemk); break;
                    case 'hapus': $kodemk = $_GET['kodemk'] ?? ''; prosesHapusMatakuliah($kodemk); break;
                    case 'save': prosesMatakuliah(); break;
                    default: tampilkanMatakuliah();
                }
                break;

            default:
                echo '<div class="alert alert-danger">Halaman tidak ditemukan!</div>';
        }
        ?>
    </div>

    <footer class="mt-5">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Sistem Informasi KRS</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
