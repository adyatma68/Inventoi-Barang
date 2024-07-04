<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id_kategori = $_GET['id'];

    // Query untuk mendapatkan deskripsi kategori sebelum dihapus
    $sql_get = "SELECT deskripsi FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = $conn->query($sql_get);
    $deskripsi = $result->fetch_assoc()['deskripsi'];

    // Hapus barang yang terkait dengan kategori ini
    $sql_delete_barang = "DELETE FROM barang WHERE id_kategori = '$id_kategori'";
    if ($conn->query($sql_delete_barang) === TRUE) {
        // Query untuk menghapus kategori berdasarkan id kategori
        $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Kategori berhasil dihapus.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_delete_barang . "<br>" . $conn->error;
    }
}
?>
