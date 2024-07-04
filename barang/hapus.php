<!-- barang/hapus.php -->
<?php
include '../koneksi.php';

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    $sql_get = "SELECT nama FROM barang WHERE kode_barang = '$kode_barang'";
    $result = $conn->query($sql_get);
    $nama_barang = $result->fetch_assoc()['nama'];

    $sql = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Barang Berhasil Dihapus');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
