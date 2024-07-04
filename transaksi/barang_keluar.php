<!-- transaksi/barang_keluar.php -->
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
    $tanggal = $_POST['tanggal']; // Ambil tanggal dari input pengguna
    $username = $_SESSION['username']; // Ambil informasi username dari session

    // Ambil jumlah barang saat ini dari tabel barang
    $sql_get_qty = "SELECT qty FROM barang WHERE kode_barang = '$kode_barang'";
    $result = $conn->query($sql_get_qty);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_qty = $row['qty'];

        if ($current_qty >= $qty) {
            // Update jumlah barang di tabel barang
            $sql_update = "UPDATE barang SET qty = qty - $qty WHERE kode_barang = '$kode_barang'";
            if ($conn->query($sql_update) === TRUE) {
                // Insert ke dalam riwayat
                $sql_riwayat = "INSERT INTO riwayat (aksi, waktu, keterangan_barang, kode_barang, username) 
                                VALUES ('Barang Keluar', '$tanggal', 'Barang keluar dengan Jumlah: $qty', '$kode_barang', '$username')";
                $conn->query($sql_riwayat);
                echo "<script>alert('Transaksi berhasil.');</script>";
            } else {
                echo "<script>alert('Error: " . $sql_update . "<br>" . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error: Jumlah barang tidak mencukupi.');</script>";
        }
    } else {
        echo "<script>alert('Error: Barang tidak ditemukan.');</script>";
    }
}
?>
<div class="container-fluid">
    <h1>Barang Keluar</h1>
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
        <input type="submit" value="Kurang" class="btn btn-success">
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
