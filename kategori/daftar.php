<!-- kategori/daftar.php -->
<?php
session_start();

include '../koneksi.php';
include '../header.php';

// Query untuk mendapatkan daftar kategori
$sql = "SELECT * FROM kategori";
$result = $conn->query($sql);

?>

<div class="container-fluid">
    <h1>Daftar Kategori</h1>
    <hr>
    <a class="btn btn-success" href='tambah.php'>Tambah</a><br><br>
    <table class="table table-bordered">
    <tr>
        <th width="40">No</th>
        <th>Deskripsi</th>
        <th width="100">Aksi</th>
    </tr>
</div>

<?php
$no = 1;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['deskripsi'] . "</td>";
        echo "<td>
                <a class='btn btn-info' href='edit.php?id=" . $row['id_kategori'] . "'>Edit</a>
                <a class='btn btn-danger' href='hapus.php?id=" . $row['id_kategori'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus kategori ini?')\">Hapus</a>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Tidak ada kategori.</td></tr>";
}
echo "</table>";

include '../footer.php';
?>
