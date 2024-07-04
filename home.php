<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'header.php';
include 'koneksi.php';
?>
    <?php 
        // inisialisasi search keyword
        $search_keyword = '';
        if (!empty($_POST['search'])) {
            $search_keyword = $_POST['search'];
        }

        // Mengambil data dengan fungsi search
        $query = "
            SELECT k.id_kategori, k.deskripsi, COALESCE(SUM(b.qty), 0) AS jumlah
            FROM kategori k
            LEFT JOIN barang b ON k.id_kategori = b.id_kategori
            WHERE k.deskripsi LIKE '%$search_keyword%' 
            GROUP BY k.id_kategori, k.deskripsi
        ";
        $result = mysqli_query($conn, $query);
    ?>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-12">
                <h2>Dashboard</h2>
                <hr>
                <h3>Selamat datang <?php echo $_SESSION['username']; ?>!</h3><br>
                <form method="post" action="" class="form-inline mb-3">
                    <div class="form-group mr-2">
                        <input type="text" name="search" placeholder="Cari kategori..." value="<?php echo $search_keyword; ?>" class="form-control form-control-sm">
                    </div>
                    <input type="submit" value="Cari" class="btn btn-success btn-sm">
                    <a href="home.php" class="btn btn-secondary btn-sm">Reset</a>
                </form><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['deskripsi'] . "</td>";
                                echo "<td>" . $row['jumlah'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
