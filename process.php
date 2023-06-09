<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";
$table = "peminjaman";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah data
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO $table (nama, barang, jumlah, tanggal) VALUES ('$nama', '$barang', '$jumlah', '$tanggal')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM $table WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: peminjaman.html"); // Mengalihkan kembali ke halaman utama setelah operasi CRUD
exit();
?>
