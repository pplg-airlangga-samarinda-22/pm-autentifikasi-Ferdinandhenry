<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    
    $sql = "SELECT * FROM masyarakat WHERE nik = ? AND username = ? AND password = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("sss", $nik, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION['nik'] = $nik;
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal Login!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post" class="form-login">
        <p>Silahkan Login</p>
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" required>
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
        <a href="register.php">Register</a>
    </form>
</body>

</html>
