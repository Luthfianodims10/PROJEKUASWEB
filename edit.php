<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";
$table = "peminjaman"; // Ganti dengan nama tabel yang sesuai

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang diubah dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    // Memperbarui data di database
    $sql = "UPDATE $table SET nama='$nama', barang='$barang', jumlah='$jumlah', tanggal='$tanggal' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Terjadi kesalahan saat memperbarui data: " . $conn->error;
    }
}

// Mendapatkan ID data dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data peminjaman barang berdasarkan ID
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $barang = $row['barang'];
        $jumlah = $row['jumlah'];
        $tanggal = $row['tanggal'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Data Peminjaman Barang</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>Edit Data Peminjaman Barang</h2>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="nama">Nama Peminjam:</label>
    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

    <label for="barang">Barang yang Dipinjam:</label>
    <input type="text" id="barang" name="barang" value="<?php echo $barang; ?>" required>

    <label for="jumlah">Jumlah Barang:</label>
    <input type="number" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" required>

    <label for="tanggal">Tanggal:</label>
    <input type="date" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>

    <input type="submit" name="submit" value="Update">
  </form>

  <a href="peminjaman.html">Kembali ke Daftar Peminjaman Barang</a>

</body>
</html>

<?php
    } else {
        echo "Data tidak ditemukan.";
    }
}

$conn->close();
?>
