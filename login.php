<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Login Admin</h1>
    </header>
    
    <?php
    session_start();

    // Cek apakah pengguna sudah terautentikasi
    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
        exit();
    }

    // Tangkap data yang dikirimkan dari form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Lakukan validasi data jika diperlukan

        // Simpan informasi login (contoh sederhana, biasanya dienkripsi)
        $admin_username = 'admin';
        $admin_password = 'admin123';

        if ($username == $admin_username && $password == $admin_password) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            echo '<p>Login gagal. Coba lagi.</p>';
        }
    }
    ?>

    <main>
        <section class="admin-login">
            <h2>Login Admin</h2>
            <form method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit">Login</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>Hak Cipta &copy; 2023 Portal Berita</p>
    </footer>
</body>
</html>
