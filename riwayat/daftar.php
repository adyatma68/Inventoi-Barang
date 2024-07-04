<?php
session_start();
include '../koneksi.php';
include '../header.php';

$search_keyword = '';
$start = 0;
$per_page = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $per_page;
$aksi_filter = isset($_POST['aksi_filter']) ? $_POST['aksi_filter'] : (isset($_GET['aksi_filter']) ? $_GET['aksi_filter'] : '');

if (!empty($_POST['search'])) {
    $search_keyword = $_POST['search'];

    $count_sql = "
        SELECT COUNT(*) as total 
        FROM riwayat r
        LEFT JOIN barang b ON r.kode_barang = b.kode_barang
        LEFT JOIN users u ON r.username = u.username
        WHERE (r.keterangan_barang LIKE '%$search_keyword%' 
           OR r.aksi LIKE '%$search_keyword%' 
           OR b.nama LIKE '%$search_keyword%'
           OR u.username LIKE '%$search_keyword%')
           " . ($aksi_filter ? "AND r.aksi = '$aksi_filter'" : "") . "
    ";
    $count_result = $conn->query($count_sql);
    $count_row = $count_result->fetch_assoc();
    $total_records = $count_row['total'];
    $total_pages = ceil($total_records / $per_page);

    $sql = "
        SELECT r.id_riwayat, r.aksi, r.waktu, r.keterangan_barang, b.nama, b.spesifikasi, b.merek, b.qty, u.username AS 'Last modified by'
        FROM riwayat r
        LEFT JOIN barang b ON r.kode_barang = b.kode_barang
        LEFT JOIN users u ON r.username = u.username
        WHERE (r.keterangan_barang LIKE '%$search_keyword%' 
           OR r.aksi LIKE '%$search_keyword%' 
           OR b.nama LIKE '%$search_keyword%'
           OR u.username LIKE '%$search_keyword%')
           " . ($aksi_filter ? "AND r.aksi = '$aksi_filter'" : "") . "
        ORDER BY r.id_riwayat DESC
        LIMIT $start, $per_page
    ";

    $result = $conn->query($sql);
} else {
    $count_sql = "
        SELECT COUNT(*) as total 
        FROM riwayat r
        LEFT JOIN barang b ON r.kode_barang = b.kode_barang
        LEFT JOIN users u ON r.username = u.username
        " . ($aksi_filter ? "WHERE r.aksi = '$aksi_filter'" : "") . "
    ";
    $count_result = $conn->query($count_sql);
    $count_row = $count_result->fetch_assoc();
    $total_records = $count_row['total'];
    $total_pages = ceil($total_records / $per_page);

    $sql = "
        SELECT r.id_riwayat, r.aksi, r.waktu, r.keterangan_barang, b.nama, b.spesifikasi, b.merek, b.qty, u.username AS 'Last modified by'
        FROM riwayat r
        LEFT JOIN barang b ON r.kode_barang = b.kode_barang
        LEFT JOIN users u ON r.username = u.username
        " . ($aksi_filter ? "WHERE r.aksi = '$aksi_filter'" : "") . "
        ORDER BY r.id_riwayat DESC
        LIMIT $start, $per_page
    ";

    $result = $conn->query($sql);
}
?>
<div class="container-fluid">
    <h1>Riwayat</h1>
    <hr><br>

    <form method="post" action="" class="form-inline mb-3">
        <div class="form-group mr-2">
            <input type="text" name="search" placeholder="Cari barang..." value="<?php echo $search_keyword; ?>" class="form-control form-control-sm">
        </div>
        <div class="form-group mr-2">
            <select name="aksi_filter" class="form-control form-control-sm">
                <option value="">Semua Aksi</option>
                <option value="Barang Masuk" <?php if ($aksi_filter == "Barang Masuk") echo 'selected'; ?>>Barang Masuk</option>
                <option value="Barang Keluar" <?php if ($aksi_filter == "Barang Keluar") echo 'selected'; ?>>Barang Keluar</option>
            </select>
        </div>
        <input type="submit" value="Cari" class="btn btn-success btn-sm">
        <a href="daftar.php" class="btn btn-secondary btn-sm">Reset</a>
    </form><br>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama Barang</th>
                <th>Merek</th>
                <th>Keterangan</th>
                <th>Jumlah Total</th>
                <th>Tanggal</th>
                <th>Last modified by</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                $no = $start + 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['aksi'] . "</td>";
                    echo "<td>" . $row['nama'] . " / " . $row['spesifikasi'] . "</td>";
                    echo "<td>" . $row['merek'] . "</td>";
                    echo "<td>" . $row['keterangan_barang'] . "</td>";
                    echo "<td>" . (isset($row['qty']) ? $row['qty'] : '') . "</td>";
                    echo "<td>" . $row['waktu'] . "</td>";
                    echo "<td>" . $row['Last modified by'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Tidak ada riwayat.</td></tr>";
            }
            ?>
        </tbody>
    </table>
<?php

echo "<div class='pagination'>";
echo "<ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : '';
    echo "<li class='page-item $active'><a class='page-link' href='?page=$i&aksi_filter=$aksi_filter'>$i</a></li>";
}
echo "</ul>";
echo "</div>";

include '../footer.php';
?>
</div>
