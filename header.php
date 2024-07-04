<!DOCTYPE html>
<html>
<head>
    <title>Sistem Inventori</title>
    <!-- Menggunakan Bootstrap 4 atau 5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }
        .navbar-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
            margin-bottom: 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000; 
        }
        .navbar-primary .navbar-brand,
        .navbar-primary .navbar-nav > li > a {
            color: #fff;
        }
        .btn-danger.navbar-btn a {
            color: #fff;
        }
        .sidenav {
            background-color: #f8f9fa;
            padding-top: 20px;
            position: fixed;
            top: 56px; 
            left: 0;
            bottom: 0;
            width: 250px;
            overflow-y: auto;
            z-index: 999;
        }
        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
        }
        .sidenav a:hover {
            background-color: #ddd;
            color: #000;
        }
        .sidenav .active {
            background-color: #337ab7;
            color: #fff;
        }
        .sidenav .navbar-brand {
            padding: 0 15px;
        }
        .main-content {
            margin-left: 260px;
            padding-top: 70px; /* Sesuaikan dengan tinggi navbar */
            padding-left: 20px;
            padding-right: 20px;
        }
        .navbar-brand img {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-primary">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="/">
                    <img alt="Logo" src="/inventaris/img/pamapersada-logo.png" style="height: 30px;">
                    INVENTORY
                </a>
                <ul class="nav ml-auto">
                    <button class="btn btn-danger navbar-btn"><a href="#" id="logout">Logout</a></button>
                </ul>
            </div>
        </nav>
        <div class="row no-gutters">
            <div class="col-md-2 sidenav">
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>" href="/inventaris/home.php">Home</a>
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'daftar.php' && strpos($_SERVER['REQUEST_URI'], '/kategori/') !== false ? 'active' : '' ?>" href="/inventaris/kategori/daftar.php">Kategori</a>
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'daftar.php' && strpos($_SERVER['REQUEST_URI'], '/barang/') !== false ? 'active' : '' ?>" href="/inventaris/barang/daftar.php">Barang</a>
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'barang_masuk.php' && strpos($_SERVER['REQUEST_URI'], '/transaksi/') !== false ? 'active' : '' ?>" href="/inventaris/transaksi/barang_masuk.php">Barang Masuk</a>
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'barang_keluar.php' && strpos($_SERVER['REQUEST_URI'], '/transaksi/') !== false ? 'active' : '' ?>" href="/inventaris/transaksi/barang_keluar.php">Barang Keluar</a>
                <a class="<?= basename($_SERVER['PHP_SELF']) == 'daftar.php' && strpos($_SERVER['REQUEST_URI'], '/riwayat/') !== false ? 'active' : '' ?>" href="/inventaris/riwayat/daftar.php">Riwayat</a>
            </div>
            <div class="col-md-10 main-content"><br>
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = '/inventaris/logout.php';
            }
        });
    </script>
</body>
</html>
