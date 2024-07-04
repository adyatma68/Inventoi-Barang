<?php
session_start(); 

include '../koneksi.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama = $_POST['nama'];
    $merek = $_POST['merek']; // Tambahkan ini untuk merek
    $id_kategori = $_POST['id_kategori'];
    $spesifikasi = $_POST['spesifikasi'];
    $satuan = $_POST['satuan'];
    $username = $_SESSION['username']; // Ambil informasi username dari session
    
    $sql = "INSERT INTO barang (kode_barang, nama, merek, id_kategori, spesifikasi, satuan) 
            VALUES ('$kode_barang', '$nama', '$merek', '$id_kategori', '$spesifikasi', '$satuan')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Barang berhasil ditambahkan.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="container-fluid">
<h2>Tambah Barang</h2>
<form method="post" action="" class="form-horizontal">
    <div class="form-group row">
        <label for="id_kategori" class="col-sm-2 col-form-label">Kategori:</label>
        <div class="col-sm-10">
            <select id="id_kategori" name="id_kategori" class="form-control" required>
                <?php
                $sql = "SELECT id_kategori, deskripsi FROM kategori";
                $result = $conn->query($sql);
                echo '<option value="">Pilih Kategori</option>'; 
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_kategori'] . "'>" . $row['deskripsi'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang:</label>
        <div class="col-sm-10">
            <input type="text" id="kode_barang" autocomplete="off" name="kode_barang" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Barang:</label>
        <div class="col-sm-10">
            <input type="text" id="nama" name="nama" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="merek" class="col-sm-2 col-form-label">Merek:</label>
        <div class="col-sm-10">
            <input type="text" id="merek" name="merek" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="spesifikasi" class="col-sm-2 col-form-label">Spesifikasi:</label>
        <div class="col-sm-10">
            <input type="text" id="spesifikasi" name="spesifikasi" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="satuan" class="col-sm-2 col-form-label">Satuan:</label>
        <div class="col-sm-10">
            <input type="text" id="satuan" name="satuan" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-success">Tambah</button>
        </div>
    </div>
</form>
</div>

<?php
include '../footer.php';
?>
