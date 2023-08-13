<!DOCTYPE html>
<html>
<head>
    <title>Portal Berita</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Portal Berita</h1>
    </header>
    
    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "db_jwd");

    // Query untuk mengambil daftar berita dan mengurutkannya berdasarkan tanggal unggah terbalik (baru ke lama)
    $query = "SELECT * FROM berita ORDER BY date_published DESC";
    $result = mysqli_query($conn, $query);
    ?>

    <main>
        <section class="news">
            <?php
            // Tampilkan daftar berita dalam loop
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="news-item">';
                echo '<h2>' . $row['title'] . '</h2>';
                echo '<p>Kategori: ' . $row['category'] . '</p>';
                echo '<p>' . $row['content'] . '</p>';
                echo '</div>';
            }
            ?>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
