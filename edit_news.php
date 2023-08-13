<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Berita</h1>
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
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        // Lakukan validasi data jika diperlukan

        // Query untuk memperbarui berita
        $updateQuery = "UPDATE berita SET title='$title', category='$category', content='$content' WHERE id=$id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            $_SESSION['success_message'] = "Berita berhasil diperbarui.";
            header('Location: dashboard.php'); // Redirect ke halaman dashboard setelah menghapus berita
            exit();
        } else {
            echo '<p>Terjadi kesalahan. Berita gagal diperbarui.</p>';
        }
    }

    $berita_id = $_GET['id'];
    $selectQuery = "SELECT * FROM berita WHERE id=$berita_id";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
    ?>

    <main>
        <section class="admin-form">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="title">Judul Berita:</label>
                <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required><br>

                <label for="category">Kategori:</label>
                <input type="text" id="category" name="category" value="<?php echo $row['category']; ?>" required><br>

                <label for="content">Konten Berita:</label>
                <textarea id="content" name="content" rows="6" required><?php echo $row['content']; ?></textarea><br>

                <button type="submit">Perbarui Berita</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
