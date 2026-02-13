<!--Simcard APN-->

<?php

include "service/koneksi(card).php";

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $bulan = $_POST['periode_bulan'];
    $tahun = $_POST['tahun'];
    $no_ba = $_POST['no_ba'];
    $tanggal = $_POST['tanggal_ba'];
    $amr_telkomsel = $_POST['amr_telkomsel'];
    $scada_telkomsel = $_POST['scada_telkomsel'];
    $spklu_telkomsel = $_POST['spklu_telkomsel'];
    $total_telkomsel = $_POST['total_telkomsel'];
    $amr_xl = $_POST['amr_xl'];
    $scada_xl = $_POST['scada_xl'];
    $spklu_xl = $_POST['spklu_xl'];
    $total_xl = $_POST['total_xl'];
    $amr_indosat = $_POST['amr_indosat'];
    $scada_indosat = $_POST['scada_indosat'];
    $spklu_indosat = $_POST['spklu_indosat'];
    $total_indosat = $_POST['total_indosat'];
    $nama_baru = $_POST['upload_ba'];

    // ===============================
    // VALIDASI FILE
    // ===============================

    if ($_FILES['upload_ba']['error'] == 0) {

        $nama_file = $_FILES['upload_ba']['name'];
        $tmp = $_FILES['upload_ba']['tmp_name'];
        $size = $_FILES['upload_ba']['size'];

        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

        // cek ekstensi
        if ($ext != "pdf") {
            die("File harus PDF");
        }

        // cek ukuran max 5MB
        if ($size > 5 * 1024 * 1024) {
            die("Ukuran file maksimal 5MB");
        }

        // rename supaya tidak bentrok
        $nama_baru = time() . "_" . $nama_file;

        move_uploaded_file($tmp, "upload/" . $nama_baru);

    } else {
        echo "<script>alert('File wajib diupload'); window.history.back();</script>";
        exit();
    }

    // ===============================
    // INSERT DATABASE
    // ===============================

    $query = "INSERT INTO data 
        (periode_bulan, tahun, no_ba, tanggal_ba, amr_telkomsel, scada_telkomsel, spklu_telkomsel, total_telkomsel,amr_xl, scada_xl, spklu_xl, total_xl, amr_indosat, scada_indosat, spklu_indosat, total_indosat, upload_ba)
        VALUES 
        ('$bulan', '$tahun', '$no_ba', '$tanggal', '$amr_telkomsel', '$scada_telkomsel', '$spklu_telkomsel', '$total_telkomsel', '$amr_xl', '$scada_xl', '$spklu_xl', '$total_xl', '$amr_indosat', '$scada_indosat', '$spklu_indosat', '$total_indosat', '$nama_baru')";

    if (mysqli_query($conn, $query)) {

        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit();

    } else {

    // Tidak redirect, tidak popup
    // Bisa log error kalau mau
    }
}


?>

<?php if (isset($_GET['success'])): ?>
<script>
    alert('Data berhasil disimpan');
    window.history.replaceState(null, null, window.location.pathname);
</script>
<?php endif; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SIMCARD APN</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />    
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <link href="assets/css/main.css" rel="stylesheet" />
   
  </head>

  <body class="services-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div
        class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between"
      >
        <a href="index.html" class="logo d-flex align-items-center gap-2">
    <img
    src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png"
    alt="Logo PLN"
    class="logo-pln"
    />
      <span class="sitename">DIV STI OPS SUMUT</span>
    </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="index.php">Beranda<br /></a>
            </li>
             <li class="dropdown"><a href="about.php"><span>Layanan User Office 365</span> <i class="bi bi-chevron-down toogle-dropdown"></i></a>
                <ul>
                  <li><a href="simcardapn.php" class="active">SimCard APN</a></li>
                  <li><a href="#">Layanan Network</a></li>
                </ul>
            <li><a href="services.php">Layanan PLN Icon+</a></li>
            <li><a href="portfolio.php">Statistik Laporan Icon+</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>

    <main class="main">
      
      <div
        class="page-title dark-background"
        data-aos="fade"
        style="background-image: url(#)"
      >
        <div class="container">
          <h1>SimCard APN</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Beranda</a></li>
              <li class="current">SimCard APN</li>
            </ol>
          </nav>
        </div>
      </div>    
<div class="card shadow-sm border-0 rounded-4 p-4 search-card-pln">
  <div class="row g-3 align-items-center">

    <div class="col-md-4">
      <input type="text" class="form-control form-control-lg"
             id="searchKeyword"
             placeholder="Cari nomor BA...">
    </div>
    <div class="col-md-2">
      <input type="date" class="form-control form-control-lg"
             id="startDate">
    </div>

    <div class="col-md-2">
      <input type="date" class="form-control form-control-lg"
             id="endDate">
    </div>

    <div class="col-md-4 d-flex gap-2">
      <button class="btn btn-primary w-100" id="btnSearch">
        Cari Laporan
      </button>

      <button class="btn btn-outline-primary w-100"
              data-bs-toggle="modal"
              data-bs-target="#modalLaporan">
        + Tambah Laporan
      </button>
    </div>
  </div>
</div>
<div class="card laporan-card mt-4" id="emptyState">
  <div class="empty-state text-center py-5">
    <h5 class="fw-semibold">Data tidak ditemukan</h5>
    <p class="text-muted mb-0">
      Silakan cari laporan atau tambahkan laporan baru
    </p>
  </div>
</div>


<div class="modal fade" id="modalLaporan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 rounded-4">

      
      <div class="modal-header px-4 py-3">
        <div>
          <h5 class="modal-title fw-semibold mb-0">
            Data Lisensi SIM Card APN
          </h5>
          <small class="text-muted">
            Input & pengelolaan lisensi SIM Card APN
          </small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      
      <div class="modal-body px-4">

        <form method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Periode Bulan</label>
            <select class="form-select pln-input" name="periode_bulan">
              <option selected disabled>Pilih bulan</option>
              <option value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Tahun</label>
            <input type="number" class="form-control pln-input" value="2026" name="tahun">
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Nomor BA</label>
            <input type="text" class="form-control pln-input"
                   placeholder="Nomor Berita Acara" name="no_ba">
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Tanggal BA</label>
            <input type="date" class="form-control pln-input" name="tanggal_ba">
          </div>
        </div>

        <!-- Divider -->
       <div class="provider-section">
  <div class="provider-title">
    TELKOMSEL
  </div>
</div>


        
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">AMR</label>
            <input type="number" class="form-control pln-input" name="amr_telkomsel">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SCADA</label>
            <input type="number" class="form-control pln-input"  name="scada_telkomsel">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SPKLU</label>
            <input type="number" class="form-control pln-input" name="spklu_telkomsel">
          </div>
          
        </div>
        <div class="row g-3 mt-2">
  <div class="col-md-6">
    <label class="form-label pln-label">Total Tagihan</label>
    <div class="input-group">
      <span class="input-group-text">Rp</span>
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric"
             name="total_telkomsel">
    </div>
  </div>

        <!-- Divider -->
        <div class="provider-section">
  <div class="provider-title">
    XL
  </div>
</div>


        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">AMR</label>
            <input type="number" class="form-control pln-input" name="amr_xl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SCADA</label>
            <input type="number" class="form-control pln-input" name="scada_xl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SPKLU</label>
            <input type="number" class="form-control pln-input" name="spklu_xl">
          </div>
          
        </div>
        <div class="row g-3 mt-2">
  <div class="col-md-6">
    <label class="form-label pln-label">Total Tagihan</label>
    <div class="input-group">
      <span class="input-group-text">Rp</span>
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric"
             name="total_xl">
    </div>
  </div>

        
        <div class="provider-section">
  <div class="provider-title">
    INDOSAT
  </div>
</div>


        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label pln-label">AMR</label>
            <input type="number" class="form-control pln-input" name="amr_indosat">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SCADA</label>
            <input type="number" class="form-control pln-input" name="scada_indosat">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">SPKLU</label>
            <input type="number" class="form-control pln-input"
            name="spklu_indosat">
          </div>
          
        </div>

      </div>
      <div class="row g-3 mt-2">
  <div class="col-md-6">
    <label class="form-label pln-label">Total Tagihan</label>
    <div class="input-group">
      <span class="input-group-text">Rp</span>
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric"
             name="total_indosat">
    </div>
  </div>

   <div class="col-12 text-center">
              <label class="upload-box">
                <input type="file" hidden accept=".pdf" name="upload_ba">
                <i class="bi bi-upload"></i>
                <div>Upload BA (PDF)</div>
                <small>Maks. 5MB</small>
              </label>
            </div>

  </div>


    
      <div class="modal-footer px-4 py-3">
        <button class="btn btn-light" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="submit" class="btn btn-primary px-4" name="submit">
          Simpan Laporan
        </button>
      </div>

    </div>
  </div>
</div>
</form>

    </main>

    <footer id="footer" class="footer light-background">
      <div class="footer-top">
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about">
               <img
            src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png"
            alt="PLN"
            class="logo-img"
          />
          <span class="sitename">DIV STI OPS SUMUT</span>
        
             <p>Menjalankan peran strategis dalam memastikan keandalan sistem teknologi informasi guna mendukung kelancaran operasional dan pelayanan ketenagalistrikan di Sumatera Utara.</p>
              <div class="social-links d-flex mt-4">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
              <h4>Tautan Link</h4>
              <ul>
                <li><a href="index.html">Beranda</a></li>
                <li><a href="about.html">User Office 365</a></li>
                <li><a href="simcardapn.html">Simcard APN</a></li>
                <li><a href="layanannetwork.html">Layanan Network</a></li>
                <li><a href="services.html">Layanan SLA Icon+</a></li>
                <li><a href="portfolio.html">Statistik Laporan</a></li>
              </ul>
            </div>
            <div class="col-lg-2 col-6 footer-links">
              <h4>Layanan kami</h4>
              <ul>
               <li><a href="#">IPVPN</a></li>
              <li><a href="#">METRONET</a></li>
              <li><a href="#">CLEAR CHANNEL</a></li>
              <li><a href="#">VSAT IP</a></li>
              <li><a href="#">INTERNET VSAT</a></li>
              </ul>
            </div>

            <div
              class="col-lg-3 col-md-12 footer-contact text-center text-md-start"
            >
              <h4>Kontak Kami</h4>
              <p>-</p>
              <p>-</p>
              <p>-</p>
              <p class="mt-4">
                <strong>Phone:</strong> <span>-</span>
              </p>
              <p><strong>Email:</strong> <span>-</span></p>
            </div>
          </div>
        </div>
      </div>
     
    </footer>

    
    <a
      href="#"
      id="scroll-top"
      class="scroll-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    
    <div id="preloader"></div>

    
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    
    <script src="assets/js/main.js"></script>
    <script src="assets/js/simcard.js"></script>
   
  </body>
</html>
