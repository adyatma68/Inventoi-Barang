<?php
include '../koneksi.php';

if (isset($_POST['id_kategori'])) {
    $id_kategori = $_POST['id_kategori'];
    $sql = "SELECT kode_barang, nama, merek, spesifikasi, qty FROM barang WHERE id_kategori = '$id_kategori'";
    $result = $conn->query($sql);
    
    echo '<option value="">Pilih Barang</option>';
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['kode_barang'] . "'>" . $row['nama'] . " / " . $row['merek'] . " / " . $row['spesifikasi'] . " / Jumlah: " . $row['qty'] . "</option>";
    }
}
?>
