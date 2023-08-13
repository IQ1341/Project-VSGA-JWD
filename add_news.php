<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Tambah Berita</h1>
    </header>
    
    <?php
    session_start();

    // Cek apakah pengguna terautentikasi sebagai admin
    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    // Tangkap data yang dikirimkan dari form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        // Lakukan validasi data jika diperlukan

        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "db_Jwd");

        // Query untuk menambah berita baru
        $query = "INSERT INTO berita (title, category, content, date_published) VALUES ('$title', '$category', '$content', NOW())";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['success_message'] = "Berita berhasil ditambah.";
            header('Location: dashboard.php'); // Redirect ke halaman dashboard setelah menghapus berita
            exit();
        } else {
            echo '<p>Terjadi kesalahan. Berita gagal ditambahkan.</p>';
        }

        // Tutup koneksi
        mysqli_close($conn);
    }
    ?>

    <main>
        <section class="admin-form">
            <form method="POST">
                <label for="title">Judul Berita:</label>
                <input type="text" id="title" name="title" required><br>

                <label for="category">Kategori:</label>
                <input type="text" id="category" name="category" required><br>

                <label for="content">Konten Berita:</label>
                <textarea id="content" name="content" rows="6" required></textarea><br>

                <button type="submit">Tambah Berita</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
