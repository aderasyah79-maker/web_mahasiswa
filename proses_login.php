
<?php
session_start();
include('koneksi.php');

$id_akun = $_POST['id_akun'];
$password = $_POST['password'];

$query = "SELECT * FROM akun a, mahasiswa b
          WHERE a.id_akun = '$id_akun'
          AND a.password = '$password' and b.nim = a.nim";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error SQL: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    $_SESSION['nim'] = $data['nim'];
    $_SESSION['nama'] = $data['nama'];

    header('Location: main.php');
    exit;
} else {
    echo "ID akun atau password salah!";
}
?>