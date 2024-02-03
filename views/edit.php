<?php
  require '../app/functions.php';
  $id = $_GET['id'];
  
  $note = query("SELECT * FROM noteku WHERE id = $id")[0];
  
  if(isset($_POST['edit'])) {
    if(update($_POST) > 0) {
      echo "
        <script>
          alert('Data berhasil diubah!');
          document.location.href = '../index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Data gagal diubah!');
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
    <title>Edit Note</title>
</head>
<body>

    <!-- Edit Note Section Start -->
    <div class="container">
        <h1>Edit Note</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $note['id']; ?>">
            <input type="hidden" name="level" value="<?= $note['level']; ?>">
            <div class="input-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" placeholder="Masukkan judul" value="<?= $note['judul']; ?>" required>
            </div>
            <div class="input-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Masukkan keterangan" required><?= $note['keterangan']; ?></textarea>
            </div>
            <div class="input-group">
                <input type="radio" name="status" id="status" value="true" <?php if($note['status'] == 1) { echo 'checked'; } ?>>
                <label for="status">Aktif</label>

                <input type="radio" name="status" id="status" value="false" <?php if($note['status'] == 0) { echo 'checked'; } ?>>
                <label for="status">Selesai</label>
            </div>

            <button type="submit" name="edit">Edit note</button>
        </form>
        <a href="../index.php"></a>
    </div>
    <!-- Edit Note Section End -->
    
</body>
</html>