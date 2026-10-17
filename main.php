<?php
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$query = mysqli_query($koneksi, "
    SELECT
        b.nim AS nim,
        b.nama AS nama,
        a.nama_prodi AS prodi,
        b.jenis_kelamin AS jenis_kelamin,
        b.alamat AS alamat
    FROM prodi a
    INNER JOIN mahasiswa b
        ON a.id_prodi = b.id_prodi
    ORDER BY b.nama ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Mahasiswa</title>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="margin:0; min-height:100vh; background:#f1f5f9; font-family:'Segoe UI',sans-serif;">

    <nav class="navbar navbar-dark shadow-sm"
         style="background:linear-gradient(135deg,#0f172a,#1d4ed8);">

        <div class="container-fluid px-4">

            <a href="main.php"
               class="navbar-brand fw-bold">
                <i class="bi bi-mortarboard-fill me-2"></i>
                SISTEM MAHASISWA
            </a>

            <a href="logout.php"
               class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </a>

        </div>

    </nav>


    <div class="container-fluid px-3 px-md-4 py-4">

        
        <div class="card border-0 shadow-sm mb-4"
             style="border-radius:16px;">

            <div class="card-body p-4">

                <div class="d-flex align-items-center gap-3">

                    <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width:60px; height:60px; border-radius:16px; background:#dbeafe; color:#2563eb; font-size:28px;">

                        <i class="bi bi-person-circle"></i>

                    </div>

                    <div>
                        <h4 class="fw-bold mb-1">
                            Halo, <?= htmlspecialchars($_SESSION['nama'] ?? 'Mahasiswa') ?>!
                        </h4>

                        <p class="text-secondary mb-0">
                            NIM: <?= htmlspecialchars($_SESSION['nim']) ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>

        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1" style="color:#0f172a;">
                    <i class="bi bi-people-fill me-2" style="color:#2563eb;"></i>
                    Daftar Data Mahasiswa
                </h3>

                <p class="text-secondary mb-0">
                    Kelola data mahasiswa dan informasi program studi.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="insert.php"
                   class="btn btn-primary shadow-sm"
                   style="border-radius:10px; padding:10px 16px;">

                    <i class="bi bi-person-plus-fill me-2"></i>
                    Tambah Mahasiswa

                </a>

            </div>

        </div>

        
        <div class="card border-0 shadow-sm"
             style="border-radius:16px; overflow:hidden;">

            <div class="card-header bg-white border-0 p-4">

                <h5 class="fw-bold mb-1">
                    <i class="bi bi-table me-2" style="color:#2563eb;"></i>
                    Tabel Mahasiswa
                </h5>

                <p class="text-secondary small mb-0">
                    Daftar mahasiswa yang terdaftar di sistem.
                </p>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead style="background:#eff6ff;">

                        <tr>
                            <th class="px-3 py-3 text-center">No.</th>
                            <th class="px-3 py-3">NIM</th>
                            <th class="px-3 py-3">Nama</th>
                            <th class="px-3 py-3">Program Studi</th>
                            <th class="px-3 py-3">Jenis Kelamin</th>
                            <th class="px-3 py-3">Alamat</th>
                            <th class="px-3 py-3 text-center">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        if (mysqli_num_rows($query) > 0) {
                            while ($data = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr>

                            <td class="px-3 text-center">
                                <?= $no++; ?>
                            </td>

                            <td class="px-3 fw-semibold"
                                style="color:#2563eb;">
                                <?= htmlspecialchars($data['nim']) ?>
                            </td>

                            <td class="px-3 fw-semibold">
                                <?= htmlspecialchars($data['nama']) ?>
                            </td>

                            <td class="px-3">
                                <span class="badge rounded-pill"
                                      style="background:#dbeafe; color:#1d4ed8; padding:8px 12px;">
                                    <?= htmlspecialchars($data['prodi']) ?>
                                </span>
                            </td>

                            <td class="px-3">
                                <?php if ($data['jenis_kelamin'] == 1) { ?>

                                    <span class="badge rounded-pill"
                                          style="background:#dbeafe; color:#1d4ed8; padding:7px 10px;">
                                        <i class="bi bi-gender-male me-1"></i>
                                        Laki-laki
                                    </span>

                                <?php } else { ?>

                                    <span class="badge rounded-pill"
                                          style="background:#fce7f3; color:#be185d; padding:7px 10px;">
                                        <i class="bi bi-gender-female me-1"></i>
                                        Perempuan
                                    </span>

                                <?php } ?>
                            </td>

                            <td class="px-3">
                                <?= htmlspecialchars($data['alamat']) ?>
                            </td>

                            <td class="px-3 text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="update.php?nim=<?= urlencode($data['nim']) ?>"
                                       class="btn btn-sm btn-warning"
                                       title="Edit data"
                                       style="border-radius:8px;">

                                        <i class="bi bi-pencil-square"></i>
                                        Edit

                                    </a>

                                    <a href="delete.php?nim=<?= urlencode($data['nim']) ?>"
                                       class="btn btn-sm btn-danger"
                                       title="Hapus data"
                                       style="border-radius:8px;"
                                       onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">

                                        <i class="bi bi-trash-fill"></i>
                                        Hapus

                                    </a>

                                </div>

                            </td>

                        </tr>

                        <?php
                            }
                        } else {
                        ?>

                        <tr>
                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-inbox"
                                   style="font-size:45px; color:#94a3b8;"></i>

                                <p class="fw-semibold mt-3 mb-1">
                                    Belum Ada Data Mahasiswa
                                </p>

                                <p class="text-secondary small mb-0">
                                    Silakan tambahkan data mahasiswa terlebih dahulu.
                                </p>

                            </td>
                        </tr>

                        <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>

            
            <div class="card-footer bg-white border-0 px-4 py-3">

                <small class="text-secondary">
                    <i class="bi bi-info-circle me-1"></i>
                    Data mahasiswa diurutkan berdasarkan nama.
                </small>

            </div>

        </div>

     
        <div class="text-center mt-4">

            <p class="text-secondary small">
                &copy; <?= date('Y') ?> Sistem Informasi Mahasiswa
            </p>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>