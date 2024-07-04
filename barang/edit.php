<?php
session_start();
include '../koneksi.php';
include '../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_kode_barang = $_POST['original_kode_barang'];
    $kode_barang = $_POST['kode_barang'];
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $id_kategori = $_POST['id_kategori'];
    $spesifikasi = $_POST['spesifikasi'];
    $satuan = $_POST['satuan'];
    $qty = $_POST['qty'];

    // Update query agar boleh mengganti primary key
    $sql = "UPDATE barang SET kode_barang='$kode_barang', nama='$nama', merek='$merek', id_kategori=$id_kategori, spesifikasi='$spesifikasi', satuan='$satuan', qty=$qty WHERE kode_barang='$original_kode_barang'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Barang Berhasil Diupdate.'); window.location.href='daftar.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

if (isset($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];

    $sql = "SELECT * FROM barang WHERE kode_barang='$kode_barang'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<h2>Edit Barang</h2>
    <form method="post" action="" class="form-horizontal">
        <input type="hidden" name="original_kode_barang" value="<?php echo $row['kode_barang']; ?>">

        <div class="form-group">
            <label for="kode_barang" class="col-sm-2 control-label">Kode Barang:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?php echo $row['kode_barang']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama Barang:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="merek" class="col-sm-2 control-label">Merek:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="merek" name="merek" value="<?php echo $row['merek']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="id_kategori" class="col-sm-2 control-label">Kategori:</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_kategori" name="id_kategori" required>
                    <?php
                    $sql_kategori = "SELECT id_kategori, deskripsi FROM kategori";
                    $result_kategori = $conn->query($sql_kategori);
                    while ($row_kategori = $result_kategori->fetch_assoc()) {
                        $selected = ($row_kategori['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                        echo "<option value='" . $row_kategori['id_kategori'] . "' $selected>" . $row_kategori['deskripsi'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="spesifikasi" class="col-sm-2 control-label">Spesifikasi:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="spesifikasi" name="spesifikasi"><?php echo $row['spesifikasi']; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="satuan" class="col-sm-2 control-label">Satuan:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $row['satuan']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="qty" class="col-sm-2 control-label">Jumlah:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $row['qty']; ?>" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </div>
    </form>
<?php
    } else {
        echo "<script>alert('Barang tidak ditemukan.'); window.location.href='daftar.php';</script>";
    }
} else {
    echo "<script>alert('Kode barang tidak ditemukan.'); window.location.href='daftar.php';</script>";
}

include '../footer.php';
?>
