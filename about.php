<!--Data Lisensi Official 365-->

<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PLN DIV STI SUMUT</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  
  <link href="assets/css/main.css" rel="stylesheet">

 
</head>

<body class="about-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      
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
          <li><a href="index.php">Beranda<br></a></li>
           <li class="dropdown"><a href="about.php"><span>Layanan User Office 365</span> <i class="bi bi-chevron-down toogle-dropdown"></i></a>
                <ul>
                  <li><a href="simcardapn.php">SimCard APN</a></li>
                  <li><a href="#">Layanan Network</a></li>
                </ul>
           </li>
          <li><a href="services.php">Layanan PLN Icon+ </a></li>
          <li><a href="portfolio.php">Statistik Laporan Icon+</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">   
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/about-page-title-bg.jpg);">
      <div class="container">
        <h1>Layanan User Office 365</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Beranda</a></li>
            <li class="current">Layanan User Office 365</li>
          </ol>
        </nav>
      </div>
    </div>
    <section id="laporan" class="laporan-section">
  <div class="container">
    <div class="section-title">
      <h2>Monitoring Laporan</h2>
      <p>Pencarian dan pengelolaan laporan layanan operasional</p>
    </div>
   
    <div class="card laporan-card mb-4">
      <div class="row g-3 align-items-center">
        <div class="col-md-8">
          <input type="text" class="form-control form-control-lg"
                 placeholder="Masukkan nomor laporan...">
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button class="btn btn-outline-primary w-100">
            Cari Laporan
          </button>
          <button class="btn btn-primary w-100"
                  data-bs-toggle="modal"
                  data-bs-target="#modalLaporan">
             + Tambah Laporan
          </button>
        </div>
      </div>
    </div>   
    <div class="card laporan-card">
      <div class="empty-state">
        <h5>Data tidak ditemukan</h5>
        <p>Silakan cari laporan atau tambahkan laporan baru</p>
      </div>
      <!-- Contoh jika data ADA -->
      <!-- 
      <div class="row">
        <div class="col-md-4">
          <div class="report-item">
            <span class="badge bg-primary mb-2">Office 365</span>
            <h6>Laporan #PLN-2025-001</h6>
            <small>Status: Diproses</small>
          </div>
        </div>
      </div>
      -->
    </div>
  </div>

  <div class="modal fade" id="modalOffice365" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content modal-pln">

      
      <div class="modal-header modal-header-pln">
        <div>
          <h5 class="modal-title">Data Lisensi Office 365</h5>
          <small class="modal-subtitle">Input & pengelolaan lisensi Office 365</small>
        </div>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      
      <div class="modal-body">

        <form id="formOffice365"> 
          <div class="row g-4">

            
            <div class="col-md-6">
  <label class="form-label-pln">Periode Bulan</label>
  <div class="select-wrapper">
    <select class="form-select form-select-sm">
      <option value="" disabled selected>Silakan pilih bulan</option>
      <option value="01">Januari</option>
      <option value="02">Februari</option>
      <option value="03">Maret</option>
      <option value="04">April</option>
      <option value="05">Mei</option>
      <option value="06">Juni</option>
      <option value="07">Juli</option>
      <option value="08">Agustus</option>
      <option value="09">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>
    <span class="select-arrow"></span>
  </div>
</div>


            <div class="col-md-6">
              <label class="form-label-pln">Tahun</label>
              <input type="year" class="form-control input-pln" placeholder="2026">
            </div>

            
            <div class="col-12">
              <label class="form-label-pln">Nomor Berita Acara (BA)</label>
              <input type="text" class="form-control input-pln">
            </div>

            
            <div class="col-12">
              <label class="form-label-pln">Tanggal BA</label>
              <input type="date" class="form-control input-pln">
            </div>

            

            
            <div class="col-md-6">
              <label class="form-label-pln">E1</label>
              <input type="number" class="form-control input-pln">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">E3</label>
              <input type="number" class="form-control input-pln">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">E5</label>
              <input type="number" class="form-control input-pln">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">Core CAL Bridge</label>
              <input type="number" class="form-control input-pln">
            </div>

            <!-- UNIT -->
          <div class="col-12">
  <label class="form-label-pln">Unit</label>
  <div class="select-wrapper">
    <select class="form-select form-select-sm">
      <option value="" disabled selected>Silakan pilih unit</option>
      <option>UID SUMUT</option>
      <option>UIP SUMBAGUT</option>
    </select>
    <span class="select-arrow"></span>
  </div>
</div>



            <!-- TOTAL -->
            <div class="col-12">
              <div class="total-box">
                <span>Total Tagihan</span>
                <strong id="totalTagihan">Rp 0</strong>
              </div>
            </div>

            <!-- UPLOAD -->
            <div class="col-12 text-center">
              <label class="upload-box">
                <input type="file" hidden accept=".pdf">
                <i class="bi bi-upload"></i>
                <div>Upload BA (PDF)</div>
                <small>Maks. 5MB</small>
              </label>
            </div>

            <!-- SUBMIT -->
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100 btn-submit-pln">
                Simpan Data Lisensi
              </button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</div>

  
  
</section>



   
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
        </a>

            <p>Menjalankan peran strategis dalam memastikan keandalan sistem teknologi informasi guna mendukung kelancaran operasional dan pelayanan ketenagalistrikan di Sumatera Utara.</p>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Beranda</a></li>
              <li><a href="#">Layanan User Office 365</a></li>
              <li><a href="#">Layanan PLN Icon+</a></li>
            </ul>
          </div>
   
          <div class="col-lg-2 col-6 footer-links">
            <h4>Layanan Kami</h4>
            <ul>
              <li><a href="#">IPVPN</a></li>
              <li><a href="#">METRONET</a></li>
              <li><a href="#">CLEAR CHANNEL</a></li>
              <li><a href="#">VSAT IP</a></li>
              <li><a href="#">INTERNET VSAT</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Kotak Kami</h4>
            <p>-</p>
          
            <p class="mt-4"><strong>Phone:</strong> <span>-</span></p>
            <p><strong>Email:</strong> <span>-</span></p>
          </div>

        </div>
      </div>
    </div>

    
    </div>

  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>


  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  
  <script src="assets/js/main.js"></script>
  <script src="assets/js/lisensi.js"></script>
  

</body>

</html>