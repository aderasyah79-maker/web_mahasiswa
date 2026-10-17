
<?php
session_start();

if (isset($_SESSION['nim'])) {
    header("Location: main.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="min-height:100vh; margin:0; display:flex; align-items:center; justify-content:center; padding:20px; font-family:'Segoe UI',sans-serif; background:linear-gradient(135deg,#0f172a,#1d4ed8,#38bdf8);">

    <div class="container d-flex justify-content-center align-items-center">

        <div class="card border-0 shadow-lg p-4 p-md-5"
             style="width:100%; max-width:430px; border-radius:24px; background:rgba(255,255,255,0.97);">

           
            <div class="text-center mb-4">

                <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                     style="width:75px; height:75px; color:white; font-size:35px; border-radius:22px; background:linear-gradient(135deg,#2563eb,#38bdf8);">

                    <i class="bi bi-mortarboard-fill"></i>

                </div>

                <h3 class="fw-bold text-dark mb-2">
                    Login Mahasiswa
                </h3>

                <p class="text-secondary mb-0">
                    Silakan masuk menggunakan akun Anda
                </p>

            </div>

            <form action="proses_login.php" method="post">

            
                <div class="mb-3">

                    <label for="id_akun" class="form-label fw-semibold">
                        ID Akun
                    </label>

                    <div class="input-group">

                        <span class="input-group-text"
                              style="color:#2563eb; background:#eff6ff; border-radius:10px 0 0 10px;">
                            <i class="bi bi-person-fill"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            id="id_akun"
                            name="id_akun"
                            placeholder="Masukkan ID akun"
                            autocomplete="username"
                            style="padding:12px; border-radius:0 10px 10px 0;"
                            required>

                    </div>

                </div>

     
                <div class="mb-4">

                    <label for="password" class="form-label fw-semibold">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text"
                              style="color:#2563eb; background:#eff6ff; border-radius:10px 0 0 10px;">
                            <i class="bi bi-lock-fill"></i>
                        </span>

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            style="padding:12px; border-radius:0 10px 10px 0;"
                            required>

                    </div>

                </div>

                <div class="d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary fw-semibold"
                        style="padding:12px; border:0; border-radius:10px; background:linear-gradient(135deg,#2563eb,#0ea5e9);">

                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Login Sekarang

                    </button>

                </div>

            </form>

          
            <div class="text-center mt-4">

                <p class="mb-0 text-secondary"
                   style="font-size:13px;">

                    <i class="bi bi-shield-lock me-1"></i>
                    Sistem Informasi Mahasiswa

                </p>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>