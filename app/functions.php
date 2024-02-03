<?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Registrasi
    function register($data) {
        global $conn;
        
        $namaLengkap = $data["nama_lengkap"];
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        if(mysqli_num_rows($result) > 0) {
            echo "
                <script>
                    alert('Username sudah terdaftar!');
                    document.location.href = '../views/register.php';
                </script>
            ";
            return false;
        }

        // cek konfirmasi password
        if ($password !== $password2) {
            echo "
                <script>
                    alert('Password yang anda masukkan tidak sesuai!');
                </script>
            ";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);


        mysqli_query($conn, "INSERT INTO user VALUES('','$namaLengkap', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }

    // Show Note Data
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
    
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    // Tambah data
    function tambah($data) {
        global $conn;
        $id_user = $data["id_user"];
        $judul = htmlspecialchars($data['judul']);
        $keterangan = htmlspecialchars($data["keterangan"]);
        $level = 1;
        $status = true;

        $query = "INSERT INTO noteku
                VALUES
                ('', '$judul', '$keterangan', $level, '$id_user', '$status')
                ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Update
    function update($data) {
        global $conn;

        $id = $data["id"];
        $judul = htmlspecialchars($data["judul"]);
        $keterangan = htmlspecialchars($data["keterangan"]);
        $level = $data["level"];
        $status = $data["status"];

        $query = "UPDATE noteku SET
                judul = '$judul',
                keterangan = '$keterangan',
                level = '$level',
                status = '$status'
                WHERE id = '$id'
                ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Delete
    function delete($id) {
        global $conn;

        mysqli_query($conn, "DELETE FROM noteku WHERE id = '$id'");

        return mysqli_affected_rows($conn);
    }

    function cari($keyword){
        $query =  "SELECT * FROM noteku WHERE 
                judul LIKE '%$keyword%'
                ";
        return query($query);
    }
?>