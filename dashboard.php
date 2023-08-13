<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Dashboard Admin</h1>
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

    // Query untuk mengambil daftar berita dan mengurutkannya berdasarkan tanggal unggah terbalik (baru ke lama)
    $query = "SELECT * FROM berita ORDER BY date_published DESC";
    $result = mysqli_query($conn, $query);
    ?>

    <main>
        <section class="admin-panel">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="add_news.php">Tambah Berita</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </section>

        <section class="news-list">
            <h2>Daftar Berita</h2>
            <ul>
                <?php
                // Tampilkan notifikasi jika ada
                if (isset($_SESSION['success_message'])) {
                    echo '<li class="success">' . $_SESSION['success_message'] . '</li>';
                    unset($_SESSION['success_message']);
                }
                
                // Tampilkan daftar berita dalam loop
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li>';
                    echo '<strong>' . $row['title'] . '</strong> - ';
                    echo '<a href="edit_news.php?id=' . $row['id'] . '">Edit</a> | ';
                    echo '<a href="delete_news.php?id=' . $row['id'] . '">Hapus</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
