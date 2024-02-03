<?php
    session_start();
    if (isset($_SESSION["login"])) {
        header("Location: ../index.php");
        exit;
    }

     require '../app/functions.php';

     if(isset($_POST['register'])) {
    
        if(register($_POST) > 0) {
            echo "
                <script>
                    alert('Akun berhasil dibuat! ');
                    document.location.href = 'login.php';
                </script>
            ";
        }

     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
    <!-- Register Section Start -->
    <div class="container" style="height:100vh; display:flex; justify-content:center; align-items:center; flex-direction:column">
        <form method="post" action="">
            <div class="input-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <div class="input-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" name="password2" id="password2" placeholder="Konfirmasi Password">
            </div>

            <button type="submit" name="register">Buat Akun</button>
        </form>

        <div>
            <a href="login.php">Sudah punya akun?</a>
        </div>
    </div>
    <!-- Register Section End -->

</body>
</html>