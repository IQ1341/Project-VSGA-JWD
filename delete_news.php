<!DOCTYPE html>
<html>
<head>
    <title>Hapus Berita</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Hapus Berita</h1>
    </header>
    
    <?php
    session_start();

    // Cek apakah pengguna terautentikasi sebagai admin
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "db_jwd");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

        // Query untuk menghapus berita
        $deleteQuery = "DELETE FROM berita WHERE id=$id";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['success_message'] = "Berita berhasil dihapus.";
            header('Location: dashboard.php'); // Redirect ke halaman dashboard setelah menghapus berita
            exit();
        } else {
            echo '<p>Terjadi kesalahan. Berita gagal dihapus.</p>';
        }
    }

    $berita_id = $_GET['id'];
    $selectQuery = "SELECT * FROM berita WHERE id=$berita_id";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
    ?>

    <main>
        <section class="admin-form">
            <h2>Konfirmasi Hapus Berita</h2>
            <p>Anda yakin ingin menghapus berita ini?</p>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit">Hapus Berita</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
