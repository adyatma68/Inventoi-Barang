<?php
session_start();

include '../koneksi.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = $_POST['deskripsi'];
    $username = $_SESSION['username']; 

    $sql = "INSERT INTO kategori (deskripsi) VALUES ('$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kategori berhasil ditambahkan.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<div class="container-fluid">
    <h2>Tambah Kategori</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
        </div>
        <input type="submit" value="Tambah" class="btn btn-success">
    </form>
</div>