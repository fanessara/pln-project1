<!-- Layanan PLN iCON+ -->

<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Layanan PLN Icon+</title>
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
            <li><a href="about.php">Layanan User Office 365</a></li>
            <li><a href="services.php" class="active">Layanan PLN Icon+</a></li>
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
        style="background-image: url(assets/img/services-page-title-bg.jpg)"
      >
        <div class="container">
          <h1>Layanan PLN Icon+</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Beranda</a></li>
              <li class="current">Layanan PLN Icon+</li>
            </ol>
          </nav>
        </div>
      </div>
    
<div class="card shadow-sm border-0 rounded-4 p-4 search-card-pln">
  <div class="row g-3 align-items-center">

    <div class="col-md-4">
      <input type="text" class="form-control form-control-lg"
             id="searchKeyword"
             placeholder="Cari judul / nomor laporan...">
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
              data-bs-target="#modalSLAIcon">
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
  

<div class="modal fade" id="modalSLAIcon" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 rounded-4">

      
      <div class="modal-header px-4 py-3">
        <div>
          <h5 class="modal-title fw-semibold mb-0">
            Data Lisensi Layanan SLA
          </h5>
          <small class="text-muted">
            Input & pengelolaan lisensi layanan SLA
          </small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

     
      <div class="modal-body px-4">

       
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Periode Bulan</label>
            <select class="form-select pln-input">
              <option selected disabled>Pilih bulan</option>
              <option>Januari</option>
              <option>Februari</option>
              <option>Maret</option>
              <option>April</option>
              <option>Mei</option>
              <option>Juni</option>
              <option>Juli</option>
              <option>Agustus</option>
              <option>September</option>
              <option>Oktober</option>
              <option>November</option>
              <option>Desember</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Tahun</label>
            <input type="number" class="form-control pln-input" value="2026">
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Nomor BA</label>
            <input type="text" class="form-control pln-input"
                   placeholder="Nomor Berita Acara">
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Tanggal BA</label>
            <input type="date" class="form-control pln-input">
          </div>
        </div>

        
       <div class="provider-section">
  <div class="provider-title">
    INTERNET
  </div>
</div>
     
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    IPVPN
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    METRONET
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    CLEAR CHANNEL
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    VSAT IP
  </div>
</div>  
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
  INTERNET VSAT
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    CORE
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>
        <div class="row g-3 mt-2">
  <div class="col-md-6">
    <label class="form-label pln-label">Total</label>
    <div class="input-group">
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric">
    </div>
  </div>

  <div class="provider-section">
  <div class="provider-title">
    SUMUT 1
  </div>
</div>
 
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="text" class="form-control pln-input" placeholder="NON SCADA">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

         <div class="provider-section">
  <div class="provider-title">
    SUMUT 1
  </div>
</div>
 
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="text" class="form-control pln-input" placeholder="SCADA NON REDUDANT">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>

        <div class="provider-section">
  <div class="provider-title">
    SUMUT 2
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="text" class="form-control pln-input" placeholder="NON SCADA">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>      

         <div class="provider-section">
  <div class="provider-title">
    SUMUT 2
  </div>
</div>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="text" class="form-control pln-input" placeholder="SCADA NON REDUDANT">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input">
          </div>
        </div>      

        <div class="col-12 text-center">
              <label class="upload-box">
                <input type="file" hidden accept=".pdf">
                <i class="bi bi-upload"></i>
                <div>Upload BA (PDF)</div>
                <small>Maks. 5MB</small>
              </label>
            </div>

            <div class="modal-footer px-4 py-3">
        <button class="btn btn-light" data-bs-dismiss="modal">
          Batal
        </button>
        <button class="btn btn-primary px-4">
          Simpan Laporan
        </button>
      </div>


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
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Layanan lisensi Office 365</a></li>
                <li><a href="#">Layanan PLN Icon+</a></li>
                <li><a href="#">Statistik Laporan</a></li>
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
    <script src="assets/js/slaicon+.js"></script>
  </body>
</html>
