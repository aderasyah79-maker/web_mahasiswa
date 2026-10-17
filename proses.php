<?php
include('koneksi.php');

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$id_prodi = $_POST['id_prodi'];
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$alamat = $_POST['alamat'];

$query = "INSERT INTO mahasiswa
    (nim, nama, id_prodi, jenis_kelamin, alamat)
    VALUES
    ('$nim', '$nama', '$id_prodi', '$jenis_kelamin', '$alamat')";

if (mysqli_query($koneksi, $query)) {
    header('location:main.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>