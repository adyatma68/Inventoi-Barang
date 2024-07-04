<?php
session_start();
include '../header.php';
include '../koneksi.php';

$id_kategori = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = $_POST['id_kategori'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE kategori SET deskripsi='$deskripsi' WHERE id_kategori=$id_kategori";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Kategori berhasil diedit.'); window.location.href = 'daftar.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM kategori WHERE id_kategori=$id_kategori";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<h2>Edit Kategori</h2>
<form method="post" action="" class="form-horizontal">
    <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>">

    <div class="form-group row">
        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Kategori:</label>
        <div class="col-sm-10">
            <input type="text" id="deskripsi" name="deskripsi" value="<?php echo isset($row['deskripsi']) ? $row['deskripsi'] : ''; ?>" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

<?php
include '../footer.php';
?>
