<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../koneksi.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tanggal'];
    $username = $_SESSION['username'];

    // Update qty di tabel barang
    $sql_update = "UPDATE barang SET qty = qty + $qty WHERE kode_barang = '$kode_barang'";
    if ($conn->query($sql_update) === TRUE) {
        // Insert ke dalam riwayat
        $sql_riwayat = "INSERT INTO riwayat (aksi, waktu, keterangan_barang, kode_barang, username) 
                        VALUES ('Barang Masuk', '$tanggal', 'Barang masuk dengan Jumlah: $qty', '$kode_barang', '$username')";
        $conn->query($sql_riwayat);
        echo "<script>alert('Barang berhasil dimasukkan.');</script>";
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}
?>

<div class="container-fluid">
    <h1>Barang Masuk</h1>
    <hr>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_kategori">Kategori:</label>
            <select id="id_kategori" name="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php
                $sql_kategori = "SELECT id_kategori, deskripsi FROM kategori";
                $result_kategori = $conn->query($sql_kategori);
                while ($row_kategori = $result_kategori->fetch_assoc()) {
                    echo "<option value='" . $row_kategori['id_kategori'] . "'>" . $row_kategori['deskripsi'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="kode_barang">Nama Barang:</label>
            <select id="kode_barang" name="kode_barang" class="form-control" required>
                <option value="">Pilih Barang</option>
            </select>
        </div>
        <div class="form-group">
            <label for="qty">Jumlah:</label>
            <input type="number" id="qty" name="qty" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" class="" required>
        </div>
        <input type="submit" value="Tambah" class="btn btn-success">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#id_kategori').change(function() {
        var id_kategori = $(this).val();
        $.ajax({
            url: 'get_barang.php',
            method: 'POST',
            data: {id_kategori: id_kategori},
            success: function(data) {
                $('#kode_barang').html(data);
            }
        });
    });
});
</script>

<?php
include '../footer.php';
?>
