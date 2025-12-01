<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | SIMASI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="text-dark">

  <!-- NAVBAR -->
  <nav class="navbar navbar-light bg-white glass border-bottom py-3 sticky-top">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="/" class="d-flex align-items-center text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="38" height="38" class="me-3 rounded-3" style="object-fit:cover;">
        <div>
          <h6 class="mb-0 fw-bold">UKM Management System</h6>
          <small class="text-muted">Sistem Informasi Manajemen UKM</small>
        </div>
      </a>

      <div class="d-flex gap-2">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark rounded-pill">
                Logout <i class="bi bi-box-arrow-right ms-1"></i>
            </button>
        </form>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="py-5 text-center">
    <div class="container">
      <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background-color:#e0f0ff; color:#2563eb; font-weight:600; font-size:.95rem;">
        <i class="bi bi-shield"></i>
        <span>Sistem Manajemen Terpadu</span>
      </div>

      <h1 class="fw-bold mt-3">Kelola UKM Anda dengan Lebih Efisien dan Terorganisir</h1>
      <p class="text-muted mx-auto" style="max-width:780px">
        Platform all-in-one untuk mengelola anggota, kegiatan, absensi, dan keuangan UKM.
      </p>

      <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-3">
        <a href="#fitur" class="btn btn-dark rounded-pill">
          Mulai Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
        </a>
        <a href="#fitur" class="btn btn-outline-secondary rounded-pill">Pelajari Lebih Lanjut</a>
      </div>

      <!-- STAT CARDS -->
      <div class="row g-3 mt-4">
        <div class="col-12 col-sm-4">
          <div class="bg-white rounded-16 border shadow-soft d-flex align-items-center p-3 h-100">
            <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-3 me-3" style="width:44px;height:44px;">
              <i class="bi bi-people"></i>
            </div>
            <div class="text-start">
              <div class="fs-4 fw-bold">{{ $totalUsers ?? '0' }}</div>
              <div class="text-muted small">Anggota Aktif</div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-4">
          <div class="bg-white rounded-16 border shadow-soft d-flex align-items-center p-3 h-100">
            <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-3 me-3" style="width:44px;height:44px;">
              <i class="bi bi-calendar-event"></i>
            </div>
            <div class="text-start">
              <div class="fs-4 fw-bold">{{ $totalKegiatan ?? '0' }}</div>
              <div class="text-muted small">Kegiatan/Tahun</div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-4">
          <div class="bg-white rounded-16 border shadow-soft d-flex align-items-center p-3 h-100">
            <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-3 me-3" style="width:44px;height:44px;">
              <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div class="text-start">
              <div class="fs-4 fw-bold">{{ $absensiRate ?? '0' }}%</div>
              <div class="text-muted small">Tingkat Kehadiran</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FITUR LENGKAP -->
  <section id="fitur" class="py-4">
    <div class="container">
      <div class="text-center mb-3">
        <h2 class="fw-bold">Fitur Lengkap untuk Manajemen UKM</h2>
        <p class="text-muted">Semua yang Anda butuhkan untuk mengelola organisasi dalam satu platform</p>
      </div>

      <div class="row g-3">
        <!-- Manajemen Pengguna -->
        <div class="col-md-6">
          <a href="{{ route('admin.user.index') }}" class="text-decoration-none text-dark">
            <div class="bg-white rounded-16 border shadow-soft p-4 d-flex gap-3 h-100">
              <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-3" style="width:44px;height:44px;">
                <i class="bi bi-people"></i>
              </div>
              <div>
                <h6 class="fw-semibold mb-1">Manajemen Pengguna</h6>
                <p class="text-muted small mb-0">Kelola data anggota dan pengurus UKM dengan mudah. Tambah, edit, dan atur peran setiap anggota.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Manajemen Kegiatan -->
        <div class="col-md-6">
          <a href="{{ route('admin.kegiatan.index') }}" class="text-decoration-none text-dark">
            <div class="bg-white rounded-16 border shadow-soft p-4 d-flex gap-3 h-100">
              <div class="bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center rounded-3" style="width:44px;height:44px;">
                <i class="bi bi-calendar3"></i>
              </div>
              <div>
                <h6 class="fw-semibold mb-1">Manajemen Kegiatan</h6>
                <p class="text-muted small mb-0">Buat dan kelola jadwal kegiatan. Atur panitia, kuota peserta, dan monitoring registrasi secara real-time.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Monitoring Absensi -->
        <div class="col-md-6">
          <a href="{{ route('admin.absensi.index') }}" class="text-decoration-none text-dark">
            <div class="bg-white rounded-16 border shadow-soft p-4 d-flex gap-3 h-100">
              <div class="bg-success-subtle text-success d-inline-flex align-items-center justify-content-center rounded-3" style="width:44px;height:44px;">
                <i class="bi bi-clipboard-check"></i>
              </div>
              <div>
                <h6 class="fw-semibold mb-1">Monitoring Absensi</h6>
                <p class="text-muted small mb-0">Catat kehadiran peserta setiap acara. Setujui pendaftaran dan ekspor laporan absensi dengan mudah.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Manajemen Kas -->
        <div class="col-md-6">
          <a href="{{ route('admin.kas.index') }}" class="text-decoration-none text-dark">
            <div class="bg-white rounded-16 border shadow-soft p-4 d-flex gap-3 h-100">
              <div class="bg-warning-subtle text-warning d-inline-flex align-items-center justify-content-center rounded-3" style="width:44px;height:44px;">
                <i class="bi bi-cash-coin"></i>
              </div>
              <div>
                <h6 class="fw-semibold mb-1">Manajemen Kas</h6>
                <p class="text-muted small mb-0">Kelola keuangan kegiatan dengan transparan. Catat pemasukan, pengeluaran, dan lihat saldo per kegiatan.</p>
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- CTA GRADIENT -->
      <div class="rounded-4 p-5 mt-4 text-center text-white"
           style="background: linear-gradient(135deg, #3b82f6 0%, #7c3aed 50%, #9333ea 100%);">
        <h5 class="fw-semibold mb-1">Siap Untuk Memulai?</h5>
        <p class="text-white-50 small mb-3">Bergabunglah dengan ratusan UKM yang telah menggunakan sistem kami untuk meningkatkan efisiensi dan transparansi organisasi mereka.</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded-pill px-4">
          Akses Dashboard <i class="bi bi-arrow-right-short ms-1"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="border-top py-4 mt-4">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
      <div class="d-flex align-items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="38" height="38" class="rounded-3" style="object-fit:cover;">
        <div>
          <div class="fw-semibold">UKM Management System</div>
          <small class="text-muted">© 2025 All rights reserved</small>
        </div>
      </div>
      <ul class="nav small">
        <li class="nav-item"><a class="nav-link text-muted" href="#">Tentang</a></li>
        <li class="nav-item"><a class="nav-link text-muted" href="#fitur">Fitur</a></li>
        <li class="nav-item"><a class="nav-link text-muted" href="#">Bantuan</a></li>
        <li class="nav-item"><a class="nav-link text-muted" href="#">Kontak</a></li>
      </ul>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
