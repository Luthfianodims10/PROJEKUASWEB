<?php
    include 'koneksiDb.php';
    $username = $_POST["username"];
    $password = $_POST["passwd"];
    $query_sql = "SELECT * FROM user WHERE username = '$username' AND passwd = '$password'";

    $result = mysqli_query($conn, $query_sql);
    if(mysqli_num_rows($result) > 0){
        header("location:dash.html");
    } else {
        echo "<script language='javascript'>";
        echo "alert('User atau Password tidak sesuai');";
        echo "window.location.href = 'index.html';";
        echo "</script>";
    }
?>