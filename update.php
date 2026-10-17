<?php
include('koneksi.php');

if (!isset($_GET['nim'])) {
    header("Location: main.php");
    exit;
}

$nim = $_GET['nim'];

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT nim, nama, id_prodi, jenis_kelamin, alamat
     FROM mahasiswa
     WHERE nim = ?"
);

mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$data) {
    header("Location: main.php");
    exit;
}

$query_prodi = mysqli_query(
    $koneksi,
    "SELECT id_prodi, nama_prodi FROM prodi"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Data Mahasiswa</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="margin:0; min-height:100vh; background:#f1f5f9; font-family:'Segoe UI',sans-serif;">

    <!-- Navbar -->
    <nav class="navbar navbar-dark shadow-sm"
         style="background:linear-gradient(135deg,#0f172a,#1d4ed8);">

        <div class="container-fluid px-4">

            <a href="main.php" class="navbar-brand fw-bold">
                <i class="bi bi-mortarboard-fill me-2"></i>
                SISTEM MAHASISWA
            </a>

            <a href="main.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

        </div>

    </nav>

    <!-- Konten -->
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-8 col-xl-7">

                <!-- Judul -->
                <div class="mb-4 text-center">

                    <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                         style="width:70px; height:70px; border-radius:20px; background:#dbeafe; color:#2563eb; font-size:32px;">

                        <i class="bi bi-pencil-square"></i>

                    </div>

                    <h2 class="fw-bold mb-2" style="color:#0f172a;">
                        Update Data Mahasiswa
                    </h2>

                    <p class="text-secondary mb-0">
                        Ubah informasi mahasiswa melalui formulir berikut.
                    </p>

                </div>

                <!-- Card Form -->
                <div class="card border-0 shadow-sm"
                     style="border-radius:20px; overflow:hidden;">

                    <div class="card-header border-0 p-4"
                         style="background:linear-gradient(135deg,#2563eb,#0ea5e9); color:white;">

                        <h5 class="fw-bold mb-1">
                            <i class="bi bi-card-list me-2"></i>
                            Formulir Edit Mahasiswa
                        </h5>

                        <p class="mb-0 small" style="opacity:0.9;">
                            Pastikan informasi yang diperbarui sudah benar.
                        </p>

                    </div>

                    <div class="card-body p-4 p-md-5">

                        <form action="proses_update.php" method="post">

                            <!-- NIM -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    NIM
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text"
                                          style="background:#eff6ff; color:#2563eb;">
                                        <i class="bi bi-credit-card-2-front"></i>
                                    </span>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= htmlspecialchars($data['nim']) ?>"
                                        readonly>

                                </div>

                                <div class="form-text">
                                    NIM digunakan sebagai identitas mahasiswa dan tidak diubah di formulir ini.
                                </div>

                            </div>

                            <!-- Nama -->
                            <div class="mb-4">

                                <label for="nama" class="form-label fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text"
                                          style="background:#eff6ff; color:#2563eb;">
                                        <i class="bi bi-person-fill"></i>
                                    </span>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="nama"
                                        name="nama"
                                        value="<?= htmlspecialchars($data['nama']) ?>"
                                        placeholder="Masukkan nama lengkap"
                                        required>

                                </div>

                            </div>

                            <!-- Program Studi -->
                            <div class="mb-4">

                                <label for="id_prodi" class="form-label fw-semibold">
                                    Program Studi <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text"
                                          style="background:#eff6ff; color:#2563eb;">
                                        <i class="bi bi-building"></i>
                                    </span>

                                    <select
                                        name="id_prodi"
                                        id="id_prodi"
                                        class="form-select"
                                        required>

                                        <option value="">-- Pilih Program Studi --</option>

                                        <?php while ($p = mysqli_fetch_assoc($query_prodi)) { ?>

                                            <option
                                                value="<?= htmlspecialchars($p['id_prodi']) ?>"
                                                <?= (string)$data['id_prodi'] === (string)$p['id_prodi'] ? 'selected' : '' ?>>

                                                <?= htmlspecialchars($p['nama_prodi']) ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">

                                <label for="jenis_kelamin" class="form-label fw-semibold">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text"
                                          style="background:#eff6ff; color:#2563eb;">
                                        <i class="bi bi-gender-ambiguous"></i>
                                    </span>

                                    <select
                                        name="jenis_kelamin"
                                        id="jenis_kelamin"
                                        class="form-select"
                                        required>

                                        <option value="">-- Pilih Jenis Kelamin --</option>

                                        <option value="1"
                                            <?= (string)$data['jenis_kelamin'] === '1' ? 'selected' : '' ?>>
                                            Laki-laki
                                        </option>

                                        <option value="0"
                                            <?= (string)$data['jenis_kelamin'] === '0' ? 'selected' : '' ?>>
                                            Perempuan
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">

                                <label for="alamat" class="form-label fw-semibold">
                                    Alamat <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text align-items-start pt-3"
                                          style="background:#eff6ff; color:#2563eb;">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </span>

                                    <textarea
                                        name="alamat"
                                        id="alamat"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Masukkan alamat lengkap mahasiswa"
                                        required><?= htmlspecialchars($data['alamat']) ?></textarea>

                                </div>

                            </div>

                            <!-- Hidden NIM -->
                            <input
                                type="hidden"
                                name="nim"
                                value="<?= htmlspecialchars($data['nim']) ?>">

                            <!-- Keterangan -->
                            <div class="alert alert-info border-0 small"
                                 style="border-radius:10px;">

                                <i class="bi bi-info-circle-fill me-2"></i>
                                Periksa kembali data sebelum menyimpan perubahan.

                            </div>

                            <!-- Tombol -->
                            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">

                                <button
                                    type="submit"
                                    class="btn btn-primary flex-fill fw-semibold"
                                    style="padding:12px; border:0; border-radius:10px; background:linear-gradient(135deg,#2563eb,#0ea5e9);">

                                    <i class="bi bi-save-fill me-2"></i>
                                    Simpan Perubahan

                                </button>

                                <a
                                    href="main.php"
                                    class="btn btn-outline-secondary flex-fill fw-semibold text-center"
                                    style="padding:12px; border-radius:10px;">

                                    <i class="bi bi-x-circle me-2"></i>
                                    Batal

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

                <!-- Footer -->
                <div class="text-center mt-4">

                    <p class="text-secondary small">
                        <i class="bi bi-shield-check me-1"></i>
                        Sistem Informasi Mahasiswa &copy; <?= date('Y') ?>
                    </p>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>