<!--Data Lisensi Official 365-->

<?php
include 'service/koneksi(office).php';

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

/* =====================================================
   PROSES SIMPAN DATA
===================================================== */
if (isset($_POST['submit'])) {

    $bulan  = $_POST['periode_bulan'];
    $tahun  = $_POST['tahun'];
    $no_ba  = $_POST['no_ba'];
    $tanggal = $_POST['tanggal_ba'];
    $e1     = $_POST['e1'];
    $e3     = $_POST['e3'];
    $e5     = $_POST['e5'];
    $core_call_bridge = $_POST['core_cal_bridge'];
    $total     = $_POST['total'];
    $unit   = $_POST['unit'];

    // ===============================
    // VALIDASI FILE
    // ===============================

    if ($_FILES['upload_ba']['error'] === 0) {

        $nama_file = $_FILES['upload_ba']['name'];
        $tmp       = $_FILES['upload_ba']['tmp_name'];
        $size      = $_FILES['upload_ba']['size'];

        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

        // Cek ekstensi
        if ($ext !== "pdf") {
            die("File harus PDF!");
        }

        // Cek ukuran max 5MB
        if ($size > 5 * 1024 * 1024) {
            die("Ukuran file maksimal 5MB!");
        }

        // Rename file
        $nama_baru = uniqid() . ".pdf";

        // Path folder upload (lebih aman pakai __DIR__)
        $folder = __DIR__ . "/upload/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $upload_path = $folder . $nama_baru;

        if (!move_uploaded_file($tmp, $upload_path)) {
            die("Gagal upload file!");
        }

    } else {
        echo "<script>alert('File wajib diupload!');window.history.back();</script>";
        exit();
    }

    // ===============================
    // INSERT DATABASE
    // ===============================

    $query = "INSERT INTO user 
        (periode_bulan, tahun, no_ba, tanggal_ba, e1, e3, e5, core_cal_bridge, unit, total, upload_ba)
        VALUES 
        ('$bulan', '$tahun', '$no_ba', '$tanggal', '$e1', '$e3', '$e5', '$core_call_bridge', '$unit','$total' , '$nama_baru')";

    if (mysqli_query($conn_office, $query)) {
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit();
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($conn_office);
    }
}

/* =====================================================
   PROSES SEARCH DATA
===================================================== */
$resultData = null;
$errorSearch = "";

if (isset($_GET['cari'])) {

    $search = trim($_GET['search_ba']);

    if ($search == "") {
        $errorSearch = "Nomor BA tidak boleh kosong!";
    } else {

        $search = mysqli_real_escape_string($conn_office, $search);

        $queryData = "SELECT * FROM user 
                      WHERE no_ba LIKE '%$search%' 
                      ORDER BY id DESC";

        $resultData = mysqli_query($conn_office, $queryData);
    }
}
?>

<!-- ALERT SUCCESS -->
<?php if (isset($_GET['success'])): ?>
<script>
alert('Data berhasil disimpan!');
window.history.replaceState(null, null, window.location.pathname);
</script>
<?php endif; ?>

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

      
    <a href="index.php" class="logo d-flex align-items-center gap-2">
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
                </ul>
           </li>
          <li><a href="services.php">Layanan PLN Icon+ </a></li>
          <li><a href="portfolio.php">Statistik Laporan Icon+</a></li>
          <?php if(isset($_SESSION['login'])): ?>
          <li><a href="logout.php">Logout</a></li>
          <?php endif; ?>
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
            <li><a href="index.php">Beranda</a></li>
            <li class="current">User Office 365</li>
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
  <form method="GET">
    <div class="row g-3 align-items-center">
      
      <div class="col-md-8">
        <input type="text"
               class="form-control form-control-lg"
               name="search_ba"
               placeholder="Masukkan nomor laporan..."
               value="<?= isset($_GET['search_ba']) ? $_GET['search_ba'] : '' ?>">
      </div>

      <div class="col-md-4 d-flex gap-2">
        <button type="submit" name="cari" class="btn btn-outline-primary w-100">
          Cari Laporan
        </button>

        <button type="button"
                class="btn btn-primary w-100"
                data-bs-toggle="modal"
                data-bs-target="#modalOffice365">
          + Tambah Laporan
        </button>
      </div>

    </div>
  </form>
</div>
    <!-- <div class="card laporan-card"> -->
      <!-- <div class="empty-state">
        <h5>Data tidak ditemukan</h5>
        <p>Silakan cari laporan atau tambahkan laporan baru</p>
      </div> -->
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
    <!--</div> -->
    <div class="card laporan-card shadow-sm border-0">

  <div class="card-body">

<?php if(isset($_GET['cari']) && $resultData && mysqli_num_rows($resultData) > 0): ?>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle text-center">
        
          <thead class="table-primary">
            <tr>
              <th>No</th>
              <th>No BA</th>
              <th>Periode</th>
              <th>Tahun</th>
              <th>E1</th>
              <th>E3</th>
              <th>E5</th>
              <th>Core CAL</th>
              <th>Unit</th>
              <th>Total+PPN 11%</th>
              <th>File BA</th>
            </tr>
          </thead>

          <tbody>
          
          <?php $no = 1; ?>
          <?php while($row = mysqli_fetch_assoc($resultData)): ?>
            <tr>
              <td><?= $no++; ?></td>
          
              <td class="fw-bold text-primary">
                <?= $row['no_ba']; ?>
              </td>
          
              <td><?= $row['periode_bulan']; ?></td>
              <td><?= $row['tahun']; ?></td>
          
              <td><?= $row['e1']; ?></td>
              <td><?= $row['e3']; ?></td>
              <td><?= $row['e5']; ?></td>
              <td><?= $row['core_cal_bridge']; ?></td>
          
              <td><?= $row['unit']; ?></td>
              <td><?= number_format($row['total'], 0, ',', '.'); ?></td>
          
              <td>
                <a href="upload/<?= $row['upload_ba']; ?>" 
                   target="_blank" 
                   class="btn btn-sm btn-outline-danger">
                   Lihat PDF
                </a>
              </td>
          
            </tr>
          <?php endwhile; ?>
          
          </tbody>

      </table>
    </div>

<?php elseif(isset($_GET['cari'])): ?>

    <div class="text-center py-4">
      <h5 class="text-danger">Data tidak ditemukan</h5>
      <p class="text-muted">Silakan coba nomor BA lain</p>
    </div>

<?php else: ?>

    <div class="text-center py-4">
      <h5 class="text-muted">Belum ada pencarian</h5>
      <p>Silakan masukkan nomor laporan</p>
    </div>

<?php endif; ?>

  </div>
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

        <form id="formOffice365" method="POST" enctype="multipart/form-data"> 
          <div class="row g-4">

            
            <div class="col-md-6">
  <label class="form-label-pln">Periode Bulan</label>
  <div class="select-wrapper">
    <select class="form-select form-select-sm" name="periode_bulan">
      <option value="" disabled selected>Silakan pilih bulan</option>
      <option value="Januari">Januari</option>
      <option value="Februari">Februari</option>
      <option value="Maret">Maret</option>
      <option value="April">April</option>
      <option value="Mei">Mei</option>
      <option value="Juni">Juni</option>
      <option value="Juli">Juli</option>
      <option value="Agustus">Agustus</option>
      <option value="September">September</option>
      <option value="Oktober">Oktober</option>
      <option value="November">November</option>
      <option value="Desember">Desember</option>
    </select>
    <span class="select-arrow"></span>
  </div>
</div>

            <div class="col-md-6">
              <label class="form-label-pln">Tahun</label>
              <input type="number" class="form-control input-pln" name="tahun" value="2026">
            </div>

            
            <div class="col-12">
              <label class="form-label-pln">Nomor Berita Acara (BA)</label>
              <input type="text" class="form-control input-pln" name="no_ba">
            </div>

            
            <div class="col-12">
              <label class="form-label-pln">Tanggal BA</label>
              <input type="date" class="form-control input-pln" name="tanggal_ba">
            </div>

    
            <div class="col-md-6">
              <label class="form-label-pln">E1</label>
              <input type="number" class="form-control input-pln" name="e1">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">E3</label>
              <input type="number" class="form-control input-pln" name="e3">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">E5</label>
              <input type="number" class="form-control input-pln" name="e5">
            </div>

            <div class="col-md-6">
              <label class="form-label-pln">Core CAL Bridge</label>
              <input type="number" class="form-control input-pln" name="core_cal_bridge">
            </div>
        
          <div class="col-12">
  <label class="form-label-pln">Unit</label>
  <div class="select-wrapper">
    <select class="form-select form-select-sm" name="unit">
      <option value="" disabled selected>Silakan pilih unit</option>
      <option>UID SUMUT</option>
      <option>UIP SUMBAGUT</option>
    </select>
    <span class="select-arrow"></span>
  </div>
</div>

             <div class="row g-3 mt-2">
  <div class="col-md-6">
    <label class="form-label pln">Total Tagihan</label>
    <div class="input-group">
      <span class="input-group-text">Rp</span>
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric"
             name="total">
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
          
            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100 btn-submit-pln" name="submit">
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
            <h4>Layanan</h4>
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