<?php
include 'koneksiDb.php';

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['passwd'];


    $checkQuery = "SELECT * FROM user WHERE userName='$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo '<script lang="javascript">';
        echo 'alert("Username sudah terdaftar, Silakan gunakan username lain.")';
        echo  '</script>';
    } else {
        $insertQuery = "INSERT INTO user (username, passwd) VALUES ('$username', '$password')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['daftar_success'] = true;
            header("Location: index.html");
            exit();
        } else {
            echo "Terjadi kesalahan saat pendaftaran: " . $conn->$connect_error;
        }
    }
}
?>