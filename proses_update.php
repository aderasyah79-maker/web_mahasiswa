<?php
include('koneksi.php');

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$id_prodi = $_POST['id_prodi'];
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$alamat = $_POST['alamat'];

$query = "update mahasiswa set nama = '$nama', id_prodi = '$id_prodi', jenis_kelamin = '$jenis_kelamin',
          alamat = '$alamat' where nim = '$nim'";

if (mysqli_query($koneksi, $query)) {
    header('location:main.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>