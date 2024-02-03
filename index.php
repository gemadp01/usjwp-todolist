<?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: views/login.php");
        exit;
    }
    $id_user = $_SESSION['id_user'];

    require 'app/functions.php';

    $profile = query("SELECT * FROM user WHERE id = '$id_user'")[0];

    if(isset($_POST['search'])) {
        $keyword = $_POST['cari'];
        $listNote = query("SELECT * FROM noteku WHERE iduser = '$id_user' AND judul LIKE '%$keyword%'");
    } else {
        $listNote = query("SELECT * FROM noteku WHERE iduser = '$id_user'");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
</head>
<body>
    <!-- Navbar Start -->

    <!-- Navbar End -->

    <!-- Note Section Start -->
    <div class="container">
        <h4>Selamat datang, <?= $profile['nama_lengkap']; ?></h6>
        <a href="views/tambah.php">Tambah note</a>
        <a href="app/logout.php">Logout></a>
        
        <form action="" method="post">
            <input type="text" name="cari" id="cari" placeholder="Masukkan judul note...">
            <button type="submit" name="search">Cari</button>
        </form>

        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($listNote as $note) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $note['judul']; ?></td>
                    <td><?= $note['keterangan']; ?></td>
                    <td>
                        <?php if($note['status'] == 1) : ?>
                        Aktif
                        <?php else : ?>
                        Selesai
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="views/edit.php?id=<?= $note['id']; ?>">Update</a>
                        <a href="app/hapus.php?id=<?= $note['id']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Note Section End -->
</body>
</html>