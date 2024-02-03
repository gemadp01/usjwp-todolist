<?php
    session_start();
    if (isset($_SESSION["login"])) {
        header("Location: ../index.php");
        exit;
    }

    require '../app/functions.php';

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        // cek username
        if(mysqli_num_rows($result) === 1) {

            // cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])) {
                $_SESSION["id_user"] = $row['id'];
                $_SESSION["login"] = true;
                header("Location: ../index.php");
                exit;
            }

        } else {
            echo "
                <script>
                    alert('Username atau password anda salah!');
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
    <title>Login</title>
</head>
<body>
    
    <!-- Login Section Start -->
    <div class="container">
        <form method="POST" action="">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
            </div>

            <button type="submit" name="login" id="login">Login</button>
        </form>
        <a href="register.php">Register</a>
    </div>
    <!-- Login Section End -->

</body>
</html>