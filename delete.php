<?php
include('koneksi.php');

$nim = $_GET['nim'];

$query = "delete from mahasiswa where nim = '$nim'";

if (mysqli_query($koneksi, $query)) {
    header('location:main.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>