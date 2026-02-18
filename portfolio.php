<!--Statistik Laporan Icon-->

<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

/* ===============================
   KONEKSI DATABASE
================================= */
include 'service/koneksi(office).php';
include 'service/koneksi(layananplnicon).php';
include 'service/koneksi(card).php';

/* ===============================
   AMBIL SEMUA TAHUN (3 TABEL)
================================= */
$listTahun = [];

$resultOffice = mysqli_query($conn_office, "SELECT DISTINCT tahun FROM user");
while($row = mysqli_fetch_assoc($resultOffice)){
    $listTahun[] = $row['tahun'];
}

$resultIcon = mysqli_query($conn_icon, "SELECT DISTINCT tahun FROM data");
while($row = mysqli_fetch_assoc($resultIcon)){
    $listTahun[] = $row['tahun'];
}

$resultCard = mysqli_query($conn, "SELECT DISTINCT tahun FROM data");
while($row = mysqli_fetch_assoc($resultCard)){
    $listTahun[] = $row['tahun'];
}

$listTahun = array_unique($listTahun);
rsort($listTahun);

$tahunTerbaru = !empty($listTahun) ? $listTahun[0] : date('Y');
$tahunDipilih = isset($_GET['tahun']) ? $_GET['tahun'] : $tahunTerbaru;

/* ===============================
   ARRAY BULAN
================================= */
$bulan = [
    "Januari","Februari","Maret","April","Mei","Juni",
    "Juli","Agustus","September","Oktober","November","Desember"
];

/* ===============================
   GRAFIK OFFICE 365
================================= */
$dataOffice = [];

$queryOffice = mysqli_query($conn_office, "
    SELECT periode_bulan, SUM(total) as total_bulanan
    FROM user
    WHERE tahun = '$tahunDipilih'
    GROUP BY periode_bulan
");

while ($row = mysqli_fetch_assoc($queryOffice)) {
    $dataOffice[$row['periode_bulan']] = $row['total_bulanan'];
}

$total_office_chart = [];
foreach ($bulan as $b) {
    $total_office_chart[] = isset($dataOffice[$b]) ? (float)$dataOffice[$b] : null;
}

/* ===============================
   GRAFIK ICON
================================= */
$data_ns = [];
$data_sn = [];

$queryIcon = mysqli_query($conn_icon, "
    SELECT periode_bulan,
           total_sti_sumut_ns_p_sla,
           total_sti_sumut_sn_p_sla
    FROM data
    WHERE tahun = '$tahunDipilih'
");

while($row = mysqli_fetch_assoc($queryIcon)){
    $data_ns[$row['periode_bulan']] = $row['total_sti_sumut_ns_p_sla'];
    $data_sn[$row['periode_bulan']] = $row['total_sti_sumut_sn_p_sla'];
}

$chart_ns = [];
$chart_sn = [];

foreach($bulan as $b){
    $chart_ns[] = isset($data_ns[$b]) ? (float)$data_ns[$b] : null;
    $chart_sn[] = isset($data_sn[$b]) ? (float)$data_sn[$b] : null;
}

/* ===============================
   GRAFIK SIMCARD
================================= */
$dataChart = [];

$queryCard = mysqli_query($conn, "
    SELECT 
        periode_bulan,
        SUM(total_telkomsel) as telkomsel,
        SUM(total_xl) as xl,
        SUM(total_indosat) as indosat
    FROM data
    WHERE tahun = '$tahunDipilih'
    GROUP BY periode_bulan
");

while ($row = mysqli_fetch_assoc($queryCard)) {
    $dataChart[$row['periode_bulan']] = [
        'telkomsel' => $row['telkomsel'],
        'xl' => $row['xl'],
        'indosat' => $row['indosat']
    ];
}

$telkomselData = [];
$xlData = [];
$indosatData = [];

foreach ($bulan as $b) {
    $telkomselData[] = isset($dataChart[$b]) ? (float)$dataChart[$b]['telkomsel'] : null;
    $xlData[] = isset($dataChart[$b]) ? (float)$dataChart[$b]['xl'] : null;
    $indosatData[] = isset($dataChart[$b]) ? (float)$dataChart[$b]['indosat'] : null;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Statistik Laporan Icon+</title>
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
<body class="portfolio-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
       <a href="index.html" class="logo d-flex align-items-center gap-2">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/9/97/Logo_PLN.png"
            alt="PLN"
            class="logo-img"
          />
          <span class="sitename">DIV STI OPS SUMUT</span>
        </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Beranda<br></a></li>
           <li class="dropdown"><a href="#"><span>Input BA</span> <i class="bi bi-chevron-down toogle-dropdown"></i></a>
                <ul>
                  <li><a href="about.php">Layanan User Office 365</a></li>
                  <li><a href="simcardapn.php">SimCard APN</a></li>
                  <li><a href="services.php">Layanan PLN Icon+</a></li>
                </ul>
           </li>
          <li><a href="portfolio.php" class="active">Statistik Laporan Icon+</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">
 
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/portfolio-page-title-bg.jpg);">
      <div class="container">
        <h1>Statistik Laporan</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Beranda</a></li>
            <li class="current">Statistik Laporan</li>
          </ol>
        </nav>
      </div>
    </div>

</section>     
    </section>

<div class="container my-4">
  <form method="GET" class="d-flex justify-content-end align-items-center gap-2">
    
    <label class="fw-bold">Pilih Tahun:</label>
    
    <select name="tahun" class="form-select w-auto" onchange="this.form.submit()">
      <?php foreach($listTahun as $t) { ?>
        <option value="<?= $t; ?>" 
          <?= ($tahunDipilih == $t) ? 'selected' : '' ?>>
          <?= $t; ?>
        </option>
      <?php } ?>
    </select>

    <a href="portfolio.php" class="btn btn-secondary btn-sm">
      Reset
    </a>

  </form>
</div>





<section class="container my-5">
  <div class="row g-4 align-items-stretch">

    <!-- Office 365 -->
    <div class="col-lg-4 col-md-6 d-flex">
      <div class="card shadow-sm w-100">
        <div class="card-body">
          <h5 class="text-center mb-3">
            Grafik Total Tagihan Office 365 Tahun <?= $tahunDipilih ?>
          </h5>
          <canvas id="chartOffice365"></canvas>
        </div>
      </div>
    </div>

    <!-- Simcard APN -->
    <div class="col-lg-4 col-md-6 d-flex">
      <div class="card shadow-sm w-100">
        <div class="card-body">
          <h5 class="text-center mb-3">
            Grafik Total Tagihan SIMCARD APN Tahun <?= $tahunDipilih ?>
          </h5>
          <canvas id="chartSimcard"></canvas>
        </div>
      </div>
    </div>

    <!-- PLN Icon+ -->
    <div class="col-lg-4 col-md-12 d-flex">
      <div class="card shadow-sm w-100">
        <div class="card-body">
          <h5 class="text-center mb-3">
            Grafik Pencapaian SLA Total STI Sumut Tahun <?= $tahunDipilih ?>
          </h5>
          <canvas id="chartSLA"></canvas>
        </div>
      </div>
    </div>

  </div>
</section>


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
              <li><a href="portfolio.html">Statistik Laporan </a></li>
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
            <h4>Kontak Kami</h4>
            <p>-</p>
            <p>-</p>
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
// OFFICE
const ctxOffice = document.getElementById('chartOffice365');

new Chart(ctxOffice, {
    type: 'line',
    data: {
        labels: <?= json_encode($bulan); ?>,
        datasets: [{
            label: 'Total Tagihan (Rp)',
            data: <?= json_encode($total_office_chart); ?>,
            borderWidth: 3,
            tension: 0.3,
            spanGaps: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// ICON
const ctx = document.getElementById('chartSLA');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($bulan); ?>,
        datasets: [
            {
                label: 'Non Scada',
                data: <?= json_encode($chart_ns); ?>,
                borderWidth: 3,
                tension: 0.3,
                spanGaps: true
            },
            {
                label: 'Scada Non Redundant',
                data: <?= json_encode($chart_sn); ?>,
                borderWidth: 3,
                tension: 0.3,
                spanGaps: true
            }
        ]
    },
    options: {
        responsive: true
    }
});

const ctxSimcard = document.getElementById('chartSimcard');

new Chart(ctxSimcard, {
    type: 'line',
    data: {
        labels: <?= json_encode($bulan); ?>,
        datasets: [
            {
                label: 'Telkomsel',
                data: <?= json_encode($telkomselData); ?>,
                borderWidth: 3,
                tension: 0.3,
                spanGaps: true
            },
            {
                label: 'XL',
                data: <?= json_encode($xlData); ?>,
                borderWidth: 3,
                tension: 0.3,
                spanGaps: true
            },
            {
                label: 'Indosat',
                data: <?= json_encode($indosatData); ?>,
                borderWidth: 3,
                tension: 0.3,
                spanGaps: true
            }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': Rp ' +
                               context.parsed.y.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});

</script>
  
</body>

</html>