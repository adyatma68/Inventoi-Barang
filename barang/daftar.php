<?php
session_start(); 
include '../koneksi.php';
include '../header.php'; 

$search_keyword = '';
$selected_kategori = '';

if (!empty($_POST['search'])) {
    $search_keyword = $_POST['search'];
}

if (!empty($_POST['kategori_filter'])) {
    $selected_kategori = $_POST['kategori_filter'];
}

if (!empty($_GET['kategori_filter'])) {
    $selected_kategori = $_GET['kategori_filter'];
}

if (!empty($_GET['search'])) {
    $search_keyword = $_GET['search'];
}

$limit = 15; 
if (isset($_GET["page"])) {
    $page = $_GET["page"]; 
} else {
    $page = 1;
}
$start_from = ($page - 1) * $limit; 

$sql = "
    SELECT b.kode_barang, b.nama, b.merek, k.deskripsi, b.spesifikasi, b.satuan, b.qty
    FROM barang b
    JOIN kategori k ON b.id_kategori = k.id_kategori
    WHERE (b.nama LIKE '%$search_keyword%' 
           OR k.deskripsi LIKE '%$search_keyword%' 
           OR b.merek LIKE '%$search_keyword%' 
           OR b.spesifikasi LIKE '%$search_keyword%' 
           OR b.satuan LIKE '%$search_keyword%')
    " . ($selected_kategori ? "AND b.id_kategori = '$selected_kategori'" : "") . "
    LIMIT $start_from, $limit
";
$result = $conn->query($sql); 

$sql_total = "
    SELECT COUNT(*) FROM barang b
    JOIN kategori k ON b.id_kategori = k.id_kategori
    WHERE (b.nama LIKE '%$search_keyword%' 
           OR k.deskripsi LIKE '%$search_keyword%' 
           OR b.merek LIKE '%$search_keyword%' 
           OR b.spesifikasi LIKE '%$search_keyword%' 
           OR b.satuan LIKE '%$search_keyword%')
    " . ($selected_kategori ? "AND b.id_kategori = '$selected_kategori'" : "") . "
";
$result_total = $conn->query($sql_total); 
$row_total = $result_total->fetch_row(); 
$total_records = $row_total[0]; 
$total_pages = ceil($total_records / $limit); 

?>

<div class="container-fluid">
<h1>Daftar Barang</h1>
<hr>
<a href='tambah.php' class='btn btn-success'>Tambah</a><br><br>
<form method="post" action="" class="form-inline mb-3">
    <div class="form-group mr-2">
        <input type="text" name="search" placeholder="Cari barang..." value="<?php echo $search_keyword; ?>" class="form-control form-control-sm">
    </div>
    <div class="form-group mr-2">
        <select name="kategori_filter" class="form-control form-control-sm">
            <option value="">Semua Kategori</option>
            <?php
            // Query untuk mendapatkan daftar kategori
            $sql_kategori = "SELECT id_kategori, deskripsi FROM kategori";
            $result_kategori = $conn->query($sql_kategori); 
            while ($row_kategori = $result_kategori->fetch_assoc()) {
                $selected = ($row_kategori['id_kategori'] == $selected_kategori) ? 'selected' : '';
                echo "<option value='" . $row_kategori['id_kategori'] . "' $selected>" . $row_kategori['deskripsi'] . "</option>";
            }
            ?>
        </select>
    </div>
    <input type="submit" value="Cari" class="btn btn-success btn-sm">
    <a href="daftar.php" class="btn btn-secondary btn-sm">Reset</a>
</form><br>

<table class='table table-bordered'>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Kategori</th>
            <th>Nama</th>
            <th>Merek</th>
            <th>Spesifikasi</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
</div>

<?php 
if ($result->num_rows > 0) { 
    $no = $start_from + 1; 
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>"; 
        echo "<td>" . $row['kode_barang'] . "</td>"; 
        echo "<td>" . $row['deskripsi'] . "</td>"; 
        echo "<td>" . $row['nama'] . "</td>"; 
        echo "<td>" . $row['merek'] . "</td>";
        echo "<td>" . $row['spesifikasi'] . "</td>"; 
        echo "<td>" . $row['satuan'] . "</td>"; 
        echo "<td>" . $row['qty'] . "</td>"; 
        echo "<td>
                  <a href='edit.php?kode_barang=" . $row['kode_barang'] . "' class='btn btn-info btn-sm'>Edit</a> 
                  <a href='hapus.php?kode_barang=" . $row['kode_barang'] . "' class='btn btn-danger btn-sm'>Hapus</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>Tidak ada barang.</td></tr>"; 
}
echo "</tbody></table>";

// Menampilkan pagination
echo '<nav>';
echo '<ul class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? 'active' : ''; // Menandai halaman aktif
    echo "<li class='page-item $active'><a class='page-link' href='daftar.php?page=$i&search=$search_keyword&kategori_filter=$selected_kategori'>$i</a></li>";
}
echo '</ul>';
echo '</nav>';

include '../footer.php';
?>
