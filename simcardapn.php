<!--Simcard APN-->

<?php

include 'service/koneksi(card).php';

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
    $non_iot_telkomsel = $_POST['non_iot_telkomsel'];
    $total_telkomsel = $_POST['total_telkomsel'];
    $amr_xl = $_POST['amr_xl'];
    $scada_xl = $_POST['scada_xl'];
    $spklu_xl = $_POST['spklu_xl'];
    $non_iot_xl = $_POST['non_iot_xl'];
    $total_xl = $_POST['total_xl'];
    $amr_indosat = $_POST['amr_indosat'];
    $scada_indosat = $_POST['scada_indosat'];
    $spklu_indosat = $_POST['spklu_indosat'];
    $non_iot_indosat = $_POST['non_iot_indosat'];
    $total_indosat = $_POST['total_indosat'];
    //$nama_baru = $_POST['upload_ba'];

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

    $query = "INSERT INTO data 
        (periode_bulan, tahun, no_ba, tanggal_ba, amr_telkomsel, scada_telkomsel, spklu_telkomsel, non_iot_telkomsel, total_telkomsel,amr_xl, scada_xl, spklu_xl, non_iot_xl, total_xl, amr_indosat, scada_indosat, spklu_indosat, non_iot_indosat, total_indosat, upload_ba)
        VALUES 
        ('$bulan', '$tahun', '$no_ba', '$tanggal', '$amr_telkomsel', '$scada_telkomsel', '$spklu_telkomsel', '$non_iot_telkomsel', '$total_telkomsel', '$amr_xl', '$scada_xl', '$spklu_xl', '$non_iot_xl', '$total_xl', '$amr_indosat', '$scada_indosat', '$spklu_indosat', '$non_iot_indosat', '$total_indosat', '$nama_baru')";

if (mysqli_query($conn, $query)) {

    header("Location: ".$_SERVER['PHP_SELF']."?success=1");
    exit();

} else {

    die("Query Error: " . mysqli_error($conn));
}

}

// ===============================
// PROSES SEARCH
// ===============================

// ===============================
// PROSES SEARCH + DEFAULT
// ===============================

$querySearch = "SELECT * FROM data WHERE 1=1";

if (isset($_GET['cari'])) {

    $keyword = $_GET['keyword'] ?? '';
    $start   = $_GET['start'] ?? '';
    $end     = $_GET['end'] ?? '';

    if (!empty($keyword)) {
        $querySearch .= " AND no_ba LIKE '%$keyword%'";
    }

    // ✅ filter tanggal fleksibel
    if (!empty($start) && !empty($end)) {
        $querySearch .= " AND tanggal_ba BETWEEN '$start' AND '$end'";
    } elseif (!empty($start)) {
        $querySearch .= " AND tanggal_ba >= '$start'";
    } elseif (!empty($end)) {
        $querySearch .= " AND tanggal_ba <= '$end'";
    }
}

// ✅ selalu ada order
$querySearch .= " ORDER BY id DESC";

// ✅ selalu ambil data
$resultData = mysqli_query($conn, $querySearch);

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
           <li class="dropdown"><a href="#"><span>Input BA</span> <i class="bi bi-chevron-down toogle-dropdown"></i></a>
                <ul>
                  <li><a href="about.php">Layanan User Office 365</a></li>
                  <li><a href="simcardapn.php">SimCard APN</a></li>
                  <li><a href="services.php">Layanan PLN Icon+</a></li>
                </ul>
           </li>
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
<form method="GET" class="row g-3 align-items-center">
    <div class="col-md-4">
        <input type="text" name="keyword"
               class="form-control form-control-lg"
               placeholder="Cari nomor BA...">
    </div>

    <div class="col-md-2">
        <input type="date" name="start"
               class="form-control form-control-lg">
    </div>

    <div class="col-md-2">
        <input type="date" name="end"
               class="form-control form-control-lg">
    </div>

    <div class="col-md-4 d-flex gap-2">
        <button type="submit" name="cari"
                class="btn btn-primary w-100">
            Cari Laporan
        </button>

        <button type="button"
                class="btn btn-outline-primary w-100"
                data-bs-toggle="modal"
                data-bs-target="#modalLaporan">
            + Tambah Laporan
        </button>
    </div>
</form>
</div>
<div class="card laporan-card mt-4 shadow-sm border-0">
  <div class="card-body">

<?php if($resultData && mysqli_num_rows($resultData) > 0): ?>


<div class="table-responsive">
<table class="table table-bordered table-hover align-middle text-center">

<thead class="table-primary">
<tr>
  <th>No</th>
  <th>Periode</th>
  <th>Tahun</th>
  <th>No BA</th>
  <th>Tanggal</th>

  <th>AMR Tsel</th>
  <th>SCADA Tsel</th>
  <th>SPKLU Tsel</th>
  <th>NON IOT/NON SCADA Tsel</th>
  <th>Total Tsel</th>

  <th>AMR XL</th>
  <th>SCADA XL</th>
  <th>SPKLU XL</th>
  <th>NON IOT/NON SCADA XL</th>
  <th>Total XL</th>

  <th>AMR Indosat</th>
  <th>SCADA Indosat</th>
  <th>SPKLU Indosat</th>
  <th>NON IOT/NON SCADA Indosat</th>
  <th>Total Indosat</th>

  <th>File BA</th>
</tr>
</thead>

<tbody>
<?php $no = 1; ?>
<?php while($row = mysqli_fetch_assoc($resultData)): ?>
<tr>

<td><?= $no++; ?></td>

<td><?= $row['periode_bulan']; ?></td>
<td><?= $row['tahun']; ?></td>
<td class="fw-bold text-primary"><?= $row['no_ba']; ?></td>
<td><?= $row['tanggal_ba']; ?></td>

<td><?= $row['amr_telkomsel']; ?></td>
<td><?= $row['scada_telkomsel']; ?></td>
<td><?= $row['spklu_telkomsel']; ?></td>
<td><?= $row['non_iot_telkomsel']; ?></td>
<td>Rp <?= number_format($row['total_telkomsel']); ?></td>

<td><?= $row['amr_xl']; ?></td>
<td><?= $row['scada_xl']; ?></td>
<td><?= $row['spklu_xl']; ?></td>
<td><?= $row['non_iot_xl']; ?></td>
<td>Rp <?= number_format($row['total_xl']); ?></td>

<td><?= $row['amr_indosat']; ?></td>
<td><?= $row['scada_indosat']; ?></td>
<td><?= $row['spklu_indosat']; ?></td>
<td><?= $row['non_iot_indosat']; ?></td>
<td>Rp <?= number_format($row['total_indosat']); ?></td>

<td>
  <a href="upload/<?= htmlspecialchars($row['upload_ba']); ?>"
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
  <p class="text-muted">Silakan coba filter lain</p>
</div>

<?php else: ?>
<div class="text-center py-4">
  <h5 class="text-danger">Data tidak ditemukan</h5>
</div>
<?php endif; ?>


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

    <!-- ================= HEADER ================= -->
    <div class="row g-3 mb-4">
      <div class="col-md-3">
        <label class="form-label pln-label">Periode Bulan</label>
        <select class="form-select pln-input" name="periode_bulan">
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
        <input type="number" class="form-control pln-input" value="2026" name="tahun">
      </div>

      <div class="col-md-3">
        <label class="form-label pln-label">Nomor BA</label>
        <input type="text" class="form-control pln-input" name="no_ba">
      </div>

      <div class="col-md-3">
        <label class="form-label pln-label">Tanggal BA</label>
        <input type="date" class="form-control pln-input" name="tanggal_ba">
      </div>
    </div>

    <!-- ================= TELKOMSEL ================= -->
    <div class="provider-section">
      <div class="provider-title">TELKOMSEL</div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="AMR" name="amr_telkomsel"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SCADA" name="scada_telkomsel"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SPKLU" name="spklu_telkomsel"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="Non IoT" name="non_iot_telkomsel"></div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label pln-label">Total Tagihan</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="text" class="form-control pln-input text-end" name="total_telkomsel">
        </div>
      </div>
    </div>

    <!-- ================= XL ================= -->
    <div class="provider-section">
      <div class="provider-title">XL</div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="AMR" name="amr_xl"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SCADA" name="scada_xl"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SPKLU" name="spklu_xl"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="Non IoT" name="non_iot_xl"></div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label pln-label">Total Tagihan</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="text" class="form-control pln-input text-end" name="total_xl">
        </div>
      </div>
    </div>

    <!-- ================= INDOSAT ================= -->
    <div class="provider-section">
      <div class="provider-title">INDOSAT</div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="AMR" name="amr_indosat"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SCADA" name="scada_indosat"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="SPKLU" name="spklu_indosat"></div>
      <div class="col-md-3"><input type="number" class="form-control pln-input" placeholder="Non IoT" name="non_iot_indosat"></div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label class="form-label pln-label">Total Tagihan</label>
        <div class="input-group">
          <span class="input-group-text">Rp</span>
          <input type="text" class="form-control pln-input text-end" name="total_indosat">
        </div>
      </div>
    </div>

    <!-- Upload -->
    <div class="col-12 text-center mb-3">
      <label class="upload-box">
        <input type="file" hidden accept=".pdf" name="upload_ba">
        <i class="bi bi-upload"></i>
        <div>Upload BA (PDF)</div>
        <small>Maks. 5MB</small>
      </label>
    </div>

</div>

<div class="modal-footer px-4 py-3">
  <button class="btn btn-light" data-bs-dismiss="modal">Batal</button>
  <button type="submit" class="btn btn-primary px-4" name="submit">
    Simpan Laporan
  </button>
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
