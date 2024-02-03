<?php
    session_start();
    $id_user = $_SESSION['id_user'];

    require '../app/functions.php';

    if(isset($_POST['tambah'])) {

        if(tambah($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = '../index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                    document.location.href = '../index.php';
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
    <title>Tambah note</title>
</head>
<body>
    
    <!-- Tambah Note Section Start -->
    <div class="container">
        <h1>Tambah Note Baru</h1>
        <form action="" method="post">
            <input type="hidden" name="id_user" value="<?= $id_user ?>">
            <div class="input-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" placeholder="Masukkan judul" required>
            </div>
            <div class="input-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Masukkan keterangan" required></textarea>
            </div>

            <button type="submit" name="tambah">Tambah note</button>
        </form>
        <a href="../index.php"></a>
    </div>
    <!-- Tambah Note Section End -->

</body>
</html>