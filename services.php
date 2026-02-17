<!-- Layanan PLN iCON+ -->

<?php
include 'service/koneksi(layananplnicon).php';

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

/* =====================================================
   PROSES SIMPAN DATA
===================================================== */
if (isset($_POST['submit'])) {

    $periode_bulan = $_POST['periode_bulan'];
    $tahun = $_POST['tahun'];
    $no_ba = $_POST['no_ba'];
    $tanggal_ba = $_POST['tanggal_ba'];

    $internet_jl = $_POST['internet_jl'];
    $internet_jt = $_POST['internet_jt'];
    $internet_tdg = $_POST['internet_tdg'];
    $internet_p_mttr = $_POST['internet_p_mttr'];
    $internet_p_sla = $_POST['internet_p_sla'];

    $ipvpn_jl = $_POST['ipvpn_jl'];
    $ipvpn_jt = $_POST['ipvpn_jt'];
    $ipvpn_tdg = $_POST['ipvpn_tdg'];
    $ipvpn_p_mttr = $_POST['ipvpn_p_mttr'];
    $ipvpn_p_sla = $_POST['ipvpn_p_sla'];

    $metronet_jl = $_POST['metronet_jl'];
    $metronet_jt = $_POST['metronet_jt'];
    $metronet_tdg = $_POST['metronet_tdg'];
    $metronet_p_mttr = $_POST['metronet_p_mttr'];
    $metronet_p_sla = $_POST['metronet_p_sla'];

    $clear_channel_jl = $_POST['clear_channel_jl'];
    $clear_channel_jt = $_POST['clear_channel_jt'];
    $clear_channel_tdg = $_POST['clear_channel_tdg'];
    $clear_channel_p_mttr = $_POST['clear_channel_p_mttr'];
    $clear_channel_p_sla = $_POST['clear_channel_p_sla'];

    $vsat_ip_jl = $_POST['vsat_ip_jl'];
    $vsat_ip_jt = $_POST['vsat_ip_jt'];
    $vsat_ip_tdg = $_POST['vsat_ip_tdg'];
    $vsat_ip_p_mttr = $_POST['vsat_ip_p_mttr'];
    $vsat_ip_p_sla = $_POST['vsat_ip_p_sla'];

    $internet_vsat_jl = $_POST['internet_vsat_jl'];
    $internet_vsat_jt = $_POST['internet_vsat_jt'];
    $internet_vsat_tdg = $_POST['internet_vsat_tdg'];
    $internet_vsat_p_mttr = $_POST['internet_vsat_p_mttr'];
    $internet_vsat_p_sla = $_POST['internet_vsat_p_sla'];

    $core_jl = $_POST['core_jl'];
    $core_jt = $_POST['core_jt'];
    $core_tdg = $_POST['core_tdg'];
    $core_p_mttr = $_POST['core_p_mttr'];
    $core_p_sla = $_POST['core_p_sla'];

    $sumut1_ns_jl = $_POST['sumut1_ns_jl'];
    $sumut1_ns_jt = $_POST['sumut1_ns_jt'];
    $sumut1_ns_tdg = $_POST['sumut1_ns_tdg'];
    $sumut1_ns_p_mttr = $_POST['sumut1_ns_p_mttr'];
    $sumut1_ns_p_sla = $_POST['sumut1_ns_p_sla'];

    $sumut1_sn_jl = $_POST['sumut1_sn_jl'];
    $sumut1_sn_jt = $_POST['sumut1_sn_jt'];
    $sumut1_sn_tdg = $_POST['sumut1_sn_tdg'];
    $sumut1_sn_p_mttr = $_POST['sumut1_sn_p_mttr'];
    $sumut1_sn_p_sla = $_POST['sumut1_sn_p_sla'];

    $sumut2_ns_jl = $_POST['sumut2_ns_jl'];
    $sumut2_ns_jt = $_POST['sumut2_ns_jt'];
    $sumut2_ns_tdg = $_POST['sumut2_ns_tdg'];
    $sumut2_ns_p_mttr = $_POST['sumut2_ns_p_mttr'];
    $sumut2_ns_p_sla = $_POST['sumut2_ns_p_sla'];

    $sumut2_sn_jl = $_POST['sumut2_sn_jl'];
    $sumut2_sn_jt = $_POST['sumut2_sn_jt'];
    $sumut2_sn_tdg = $_POST['sumut2_sn_tdg'];
    $sumut2_sn_p_mttr = $_POST['sumut2_sn_p_mttr'];
    $sumut2_sn_p_sla = $_POST['sumut2_sn_p_sla'];
    $nama_baru = $_POST['upload_ba'];

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
    // HITUNG TOTAL STI SUMUT
    // ===============================

    // NON SCADA
    $total_sti_sumut_ns_jt     = $sumut1_ns_jt + $sumut2_ns_jt;
    $total_sti_sumut_ns_tdg    = $sumut1_ns_tdg + $sumut2_ns_tdg;
    $total_sti_sumut_ns_p_mttr = $total_sti_sumut_ns_tdg / $total_sti_sumut_ns_jt;
    $total_sti_sumut_ns_p_sla = round((($sumut1_ns_p_sla + $sumut2_ns_p_sla) / 2), 2);


    // SCADA NON REDUNDANT
    $total_sti_sumut_sn_jt     = $sumut1_sn_jt + $sumut2_sn_jt;
    $total_sti_sumut_sn_tdg    = $sumut1_sn_tdg + $sumut2_sn_tdg;
    $total_sti_sumut_sn_p_mttr = $total_sti_sumut_sn_tdg / $total_sti_sumut_sn_jt ;
    $total_sti_sumut_sn_p_sla  = round((($sumut1_sn_p_sla + $sumut2_sn_p_sla) / 2), 2);

    // ===============================
    // INSERT DATABASE
    // ===============================

    $query = "INSERT INTO data (periode_bulan, tahun, no_ba, tanggal_ba, internet_jl, internet_jt, internet_tdg, internet_p_mttr, internet_p_sla, ipvpn_jl, ipvpn_jt, ipvpn_tdg, ipvpn_p_mttr, ipvpn_p_sla, metronet_jl, metronet_jt, metronet_tdg, metronet_p_mttr, metronet_p_sla, clear_channel_jl, clear_channel_jt, clear_channel_tdg, clear_channel_p_mttr, clear_channel_p_sla, vsat_ip_jl, vsat_ip_jt, vsat_ip_tdg, vsat_ip_p_mttr, vsat_ip_p_sla, internet_vsat_jl, internet_vsat_jt, internet_vsat_tdg, internet_vsat_p_mttr, internet_vsat_p_sla, core_jl, core_jt, core_tdg, core_p_mttr, core_p_sla, sumut1_ns_jt, sumut1_ns_tdg, sumut1_ns_p_mttr, sumut1_ns_p_sla, sumut1_sn_jt, sumut1_sn_tdg, sumut1_sn_p_mttr, sumut1_sn_p_sla, sumut2_ns_jt, sumut2_ns_tdg, sumut2_ns_p_mttr, sumut2_ns_p_sla, sumut2_sn_jt, sumut2_sn_tdg, sumut2_sn_p_mttr, sumut2_sn_p_sla, upload_ba, total_sti_sumut_ns_jt, total_sti_sumut_ns_tdg, total_sti_sumut_ns_p_mttr, total_sti_sumut_ns_p_sla, total_sti_sumut_sn_jt, total_sti_sumut_sn_tdg, total_sti_sumut_sn_p_mttr, total_sti_sumut_sn_p_sla) VALUES 
    ('$periode_bulan', '$tahun', '$no_ba', '$tanggal_ba', '$internet_jl', '$internet_jt', '$internet_tdg', '$internet_p_mttr', '$internet_p_sla', '$ipvpn_jl', '$ipvpn_jt', '$ipvpn_tdg', '$ipvpn_p_mttr', '$ipvpn_p_sla', '$metronet_jl', '$metronet_jt', '$metronet_tdg', '$metronet_p_mttr', '$metronet_p_sla', '$clear_channel_jl', '$clear_channel_jt', '$clear_channel_tdg', '$clear_channel_p_mttr', '$clear_channel_p_sla', '$vsat_ip_jl', '$vsat_ip_jt', '$vsat_ip_tdg', '$vsat_ip_p_mttr', '$vsat_ip_p_sla', '$internet_vsat_jl', '$internet_vsat_jt', '$internet_vsat_tdg', '$internet_vsat_p_mttr', '$internet_vsat_p_sla', '$core_jl', '$core_jt', '$core_tdg', '$core_p_mttr', '$core_p_sla', '$sumut1_ns_jt', '$sumut1_ns_tdg', '$sumut1_ns_p_mttr', '$sumut1_ns_p_sla', '$sumut1_sn_jt', '$sumut1_sn_tdg', '$sumut1_sn_p_mttr', '$sumut1_sn_p_sla', '$sumut2_ns_jt', '$sumut2_ns_tdg', '$sumut2_ns_p_mttr', '$sumut2_ns_p_sla', '$sumut2_sn_jt', '$sumut2_sn_tdg', '$sumut2_sn_p_mttr', '$sumut2_sn_p_sla', '$nama_baru','$total_sti_sumut_ns_jt', '$total_sti_sumut_ns_tdg', '$total_sti_sumut_ns_p_mttr', '$total_sti_sumut_ns_p_sla', '$total_sti_sumut_sn_jt', '$total_sti_sumut_sn_tdg', '$total_sti_sumut_sn_p_mttr', '$total_sti_sumut_sn_p_sla'
)";
    if (mysqli_query($conn, $query)) {
        header("Location: ".$_SERVER['PHP_SELF']."?success=1");
        exit();
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($conn);
    }
}

/* =====================================================
   PROSES SEARCH DATA
===================================================== */
$resultData = null;
$errorSearch = "";

if (isset($_GET['cari'])) {

    $search = trim($_GET['search_ba']);
    $start  = trim($_GET['start_date']);
    $end    = trim($_GET['end_date']);

    // 🔥 WAJIB SEMUA DIISI
    if ($search == "" || $start == "" || $end == "") {

        $errorSearch = "Semua field harus diisi terlebih dahulu!";

    } else {

        $search = mysqli_real_escape_string($conn, $search);

        $queryData = "SELECT * FROM data 
                      WHERE no_ba LIKE '%$search%' 
                      AND tanggal_ba BETWEEN '$start' AND '$end'
                      ORDER BY id DESC";

        $resultData = mysqli_query($conn, $queryData);
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
          <h1>Layanan SLA Icon+</h1>
          <nav class="breadcrumbs">
            <ol>
              <li><a href="index.html">Beranda</a></li>
              <li class="current">Layanan SLA Icon+</li>
            </ol>
          </nav>
        </div>
      </div>
    
<form method="GET">
<div class="card shadow-sm border-0 rounded-4 p-4 search-card-pln">
  <div class="row g-3 align-items-center">

    <div class="col-md-4">
      <input type="text"
             class="form-control form-control-lg"
             name="search_ba"
             placeholder="Cari nomor BA..."
             value="<?= isset($_GET['search_ba']) ? $_GET['search_ba'] : '' ?>">
    </div>

    <div class="col-md-2">
      <input type="date"
             class="form-control form-control-lg"
             name="start_date"
             value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
    </div>

    <div class="col-md-2">
      <input type="date"
             class="form-control form-control-lg"
             name="end_date"
             value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
    </div>

    <div class="col-md-4 d-flex gap-2">
      <button type="submit"
              name="cari"
              class="btn btn-primary w-100">
        Cari Laporan
      </button>

      <button type="button"
              class="btn btn-outline-primary w-100"
              data-bs-toggle="modal"
              data-bs-target="#modalSLAIcon">
        + Tambah Laporan
      </button>
    </div>

  </div>
</div>
</form>
 
<?php if ($resultData && mysqli_num_rows($resultData) > 0): ?>

<?php if($errorSearch != ""): ?>
  <div class="alert alert-danger mt-3">
    <?= $errorSearch; ?>
  </div>
<?php endif; ?>

<div class="card mt-4 p-4 shadow-sm">
  <div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
      <thead class="table-primary">
<tr>
<th>No</th>
<th>Periode</th>
<th>No BA</th>
<th>Tanggal</th>

<th>Internet Jumlah Layanan</th>
<th>Internet Jumlah Tiket</th>
<th>Internet Total Durasi Gangguan (Menit)/th>
<th>Internet Pencapaian MTTR (Menit)</th>
<th>Internet Pencapaian SLA (%)</th>

<th>IPVPN Jumlah Layanan</th>
<th>IPVPN Jumlah Tiket</th>
<th>IPVPN Total Durasi Gangguan (Menit)</th>
<th>IPVPN Pencapaian MTTR (Menit)</th>
<th>IPVPN Pencapaian SLA (%)</th>

<th>Metronet Jumlah Layanan</th>
<th>Metronet Jumlah Tiket</th>
<th>Metronet Total Durasi Gangguan (Menit)</th>
<th>Metronet Pencapaian MTTR (Menit)</th>
<th>Metronet Pencapaian SLA (%)</th>

<th>Clear Jumlah Layanan</th>
<th>Clear Jumlah Tiket</th>
<th>Clear Total Durasi Gangguan (Menit)</th>
<th>Clear Pencapaian MTTR (Menit)</th>
<th>Clear Pencapaian SLA (%)</th>

<th>VSAT IP Jumlah Layanan</th>
<th>VSAT IP Jumlah Tiket</th>
<th>VSAT IP Total Durasi Gangguan (Menit)</th>
<th>VSAT IP Pencapaian MTTR (Menit)</th>
<th>VSAT IP Pencapaian SLA (%)</th>

<th>Internet VSAT Jumlah Layanan</th>
<th>Internet VSAT Jumlah Tiket</th>
<th>Internet VSAT Total Durasi Gangguan (Menit)</th>
<th>Internet VSAT Pencapaian MTTR (Menit)</th>
<th>Internet VSAT Pencapaian SLA (%)</th>

<th>Core Jumlah Layanan</th>
<th>Core Jumlah Tiket</th>
<th>Core Total Durasi Gangguan (Menit)</th>
<th>Core Pencapaian MTTR (Menit)</th>
<th>Core Pencapaian SLA (%)</th>

<th>Sumut1 Non Scada Jumlah Layanan</th>
<th>Sumut1 Non Scada Jumlah Tiket</th>
<th>Sumut1 Non Scada Total Durasi Gangguan (Menit)</th>
<th>Sumut1 Non Scada Pencapaian MTTR (Menit)</th>
<th>Sumut1 Non Scada Pencapaian SLA (%)</th>

<th>Sumut1 Scada Non Redundant Jumlah Layanan</th>
<th>Sumut1 Scada Non Redundant Jumlah Tiket</th>
<th>Sumut1 Scada Non Redundant Total Durasi Gangguan (Menit)</th>
<th>Sumut1 Scada Non Redundant Pencapaian MTTR (Menit)</th>
<th>Sumut1 Scada Non Redundant Pencapaian SLA (%)</th>

<th>Sumut2 Non Scada Jumlah Layanan</th>
<th>Sumut2 Non Scada Jumlah Tiket</th>
<th>Sumut2 Non Scada Total Durasi Gangguan (Menit)</th>
<th>Sumut2 Non Scada Pencapaian MTTR (Menit)</th>
<th>Sumut2 Non Scada Pencapaian SLA (%)</th>

<th>Sumut2 Scada Non Redundant Jumlah Layanan</th>
<th>Sumut2 Scada Non Redundant Jumlah Tiket</th>
<th>Sumut2 Scada Non Redundant Total Durasi Gangguan (Menit)</th>
<th>Sumut2 Scada Non Redundant Pencapaian MTTR (Menit)</th>
<th>Sumut2 Scada Non Redundant Pencapaian SLA (%)</th>

<th>Total Sti Sumut Non Scada Jumlah Layanan</th>
<th>Total Sti Sumut Non Scada Jumlah Tiket</th>
<th>Total Sti Sumut Non Scada Total Durasi Gangguan (Menit)</th>
<th>Total Sti Sumut Non Scada Pencapaian MTTR (Menit)</th>
<th>Total Sti Sumut Non Scada Pencapaian SLA (%)</th>

<th>Total Sti Sumut Scada Non Redundant Jumlah Layanan</th>
<th>Total Sti Sumut Scada Non Redundant Jumlah Tiket</th>
<th>Total Sti Sumut Scada Non Redundant Total Durasi Gangguan (Menit)</th>
<th>Total Sti Sumut Scada Non Redundant Pencapaian MTTR (Menit)</th>
<th>Total Sti Sumut Scada Non Redundant Pencapaian SLA (%)</th>

<th>File</th>
</tr>
      </thead>
      <tbody>

      <?php 
      $no = 1;
      while($row = mysqli_fetch_assoc($resultData)):
      ?>

<tr>
<td><?= $no++; ?></td>
<td><?= $row['periode_bulan'] ?></td>
<td><?= $row['no_ba']; ?></td>
<td><?= $row['tanggal_ba']; ?></td>

<td><?= $row['internet_jl']; ?></td>
<td><?= $row['internet_jt']; ?></td>
<td><?= $row['internet_tdg']; ?></td>
<td><?= $row['internet_p_mttr']; ?></td>
<td><?= $row['internet_p_sla']; ?>%</td>

<td><?= $row['ipvpn_jl']; ?></td>
<td><?= $row['ipvpn_jt']; ?></td>
<td><?= $row['ipvpn_tdg']; ?></td>
<td><?= $row['ipvpn_p_mttr']; ?></td>
<td><?= $row['ipvpn_p_sla']; ?>%</td>

<td><?= $row['metronet_jl']; ?></td>
<td><?= $row['metronet_jt']; ?></td>
<td><?= $row['metronet_tdg']; ?></td>
<td><?= $row['metronet_p_mttr']; ?></td>
<td><?= $row['metronet_p_sla']; ?>%</td>

<td><?= $row['clear_channel_jl']; ?></td>
<td><?= $row['clear_channel_jt']; ?></td>
<td><?= $row['clear_channel_tdg']; ?></td>
<td><?= $row['clear_channel_p_mttr']; ?></td>
<td><?= $row['clear_channel_p_sla']; ?>%</td>

<td><?= $row['vsat_ip_jl']; ?></td>
<td><?= $row['vsat_ip_jt']; ?></td>
<td><?= $row['vsat_ip_tdg']; ?></td>
<td><?= $row['vsat_ip_p_mttr']; ?></td>
<td><?= $row['vsat_ip_p_sla']; ?>%</td>

<td><?= $row['internet_vsat_jl']; ?></td>
<td><?= $row['internet_vsat_jt']; ?></td>
<td><?= $row['internet_vsat_tdg']; ?></td>
<td><?= $row['internet_vsat_p_mttr']; ?></td>
<td><?= $row['internet_vsat_p_sla']; ?>%</td>

<td><?= $row['core_jl']; ?></td>
<td><?= $row['core_jt']; ?></td>
<td><?= $row['core_tdg']; ?></td>
<td><?= $row['core_p_mttr']; ?></td>
<td><?= $row['core_p_sla']; ?>%</td>

<td>NON SCADA</td>
<td><?= $row['sumut1_ns_jt']; ?></td>
<td><?= $row['sumut1_ns_tdg']; ?></td>
<td><?= $row['sumut1_ns_p_mttr']; ?></td>
<td><?= $row['sumut1_ns_p_sla']; ?>%</td>

<td>SCADA NON REDUNDANT</td>
<td><?= $row['sumut1_sn_jt']; ?></td>
<td><?= $row['sumut1_sn_tdg']; ?></td>
<td><?= $row['sumut1_sn_p_mttr']; ?></td>
<td><?= $row['sumut1_sn_p_sla']; ?>%</td>

<td>NON SCADA</td>
<td><?= $row['sumut2_ns_jt']; ?></td>
<td><?= $row['sumut2_ns_tdg']; ?></td>
<td><?= $row['sumut2_ns_p_mttr']; ?></td>
<td><?= $row['sumut2_ns_p_sla']; ?>%</td>

<td>SCADA NON REDUNDANT</td>
<td><?= $row['sumut2_sn_jt']; ?></td>
<td><?= $row['sumut2_sn_tdg']; ?></td>
<td><?= $row['sumut2_sn_p_mttr']; ?></td>
<td><?= $row['sumut2_sn_p_sla']; ?>%</td>

<td>NON SCADA</td>
<td><?= $row['total_sti_sumut_ns_jt']; ?></td>
<td><?= $row['total_sti_sumut_ns_tdg']; ?></td>
<td><?= $row['total_sti_sumut_ns_p_mttr']; ?></td>
<td><?= $row['total_sti_sumut_ns_p_sla']; ?>%</td>

<td>SCADA NON REDUNDANT</td>
<td><?= $row['total_sti_sumut_sn_jt']; ?></td>
<td><?= $row['total_sti_sumut_sn_tdg']; ?></td>
<td><?= $row['total_sti_sumut_sn_p_mttr']; ?></td>
<td><?= $row['total_sti_sumut_sn_p_sla']; ?>%</td>

<td>
<a href="upload/<?= $row['upload_ba']; ?>" target="_blank" class="btn btn-success btn-sm">
Lihat PDF
</a>
</td>

</tr>

      <?php endwhile; ?>

      </tbody>
    </table>
  </div>
  
</div>

<?php else: ?>

<div class="card laporan-card mt-4">
  <div class="empty-state text-center py-5">
    <h5 class="fw-semibold">Data tidak ditemukan</h5>
    <p class="text-muted mb-0">
      Silakan tambahkan laporan baru
    </p>
  </div>
</div>

<?php endif; ?>
  
<form method="POST" enctype="multipart/form-data">
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
            <select class="form-select pln-input" name="periode_bulan">
              <option selected disabled>Pilih bulan</option>
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
          </div>

          <div class="col-md-3">
            <label class="form-label pln-label">Tahun</label>
            <input type="number" class="form-control pln-input" placeholder="2026" name="tahun">
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

        
       <div class="provider-section">
  <div class="provider-title">
    INTERNET
  </div>
</div>
     
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="number" class="form-control pln-input" name="internet_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="internet_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="internet_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number" class="form-control pln-input"  step="0.01" name="internet_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="internet_p_sla">
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
            <input type="number" class="form-control pln-input" name="ipvpn_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="ipvpn_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input"name="ipvpn_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="ipvpn_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01" class="form-control pln-input" name="ipvpn_p_sla">
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
            <input type="number" class="form-control pln-input" name="metronet_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="metronet_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="metronet_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="metronet_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="metronet_p_sla">
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
            <input type="number" class="form-control pln-input" name="clear_channel_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="clear_channel_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="clear_channel_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="clear_channel_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="clear_channel_p_sla">
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
            <input type="number" class="form-control pln-input" name="vsat_ip_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="vsat_ip_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="vsat_ip_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="vsat_ip_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="vsat_ip_p_sla">
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
            <input type="number" class="form-control pln-input" name="internet_vsat_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="internet_vsat_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="internet_vsat_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="internet_vsat_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="internet_vsat_p_sla">
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
            <input type="number" class="form-control pln-input" name="core_jl">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="core_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="core_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="core_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="core_p_sla">
          </div>
        </div>
        <div class="row g-3 mt-2">
  <!-- <div class="col-md-6">
    <label class="form-label pln-label">Total</label>
    <div class="input-group">
      <input type="text"
             class="form-control pln-input text-end"
             placeholder="0"
             inputmode="numeric">
    </div>
  </div> -->

  <div class="provider-section">
  <div class="provider-title">
    SUMUT 1
  </div>
</div>
 
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Layanan</label>
            <input type="text" class="form-control pln-input" value="NON SCADA">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="sumut1_ns_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="sumut1_ns_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="sumut1_ns_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="sumut1_ns_p_sla">
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
            <input type="text" class="form-control pln-input" value="SCADA NON REDUDANT">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="sumut1_sn_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="sumut1_sn_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="sumut1_sn_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="sumut1_sn_p_sla">
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
            <input type="text" class="form-control pln-input" value="NON SCADA">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="sumut2_ns_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="sumut2_ns_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="sumut2_ns_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="sumut2_ns_p_sla">
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
            <input type="text" class="form-control pln-input" value="SCADA NON REDUDANT">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Jumlah Tiket</label>
            <input type="number" class="form-control pln-input" name="sumut2_sn_jt">
          </div>
          <div class="col-md-3">
            <label class="form-label pln-label">Total Durasi Gangguan (Menit)</label>
            <input type="number" class="form-control pln-input" name="sumut2_sn_tdg">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian MTTR (Menit)</label>
            <input type="number"  step="0.01" class="form-control pln-input" name="sumut2_sn_p_mttr">
          </div>
           <div class="col-md-3">
            <label class="form-label pln-label">Pencapaian SLA (%)</label>
            <input type="number" step="0.01"class="form-control pln-input" name="sumut2_sn_p_sla">
          </div>
        </div>      

        <!-- <div class="provider-section">
  <div class="provider-title">
    TOTAL STI SUMUT
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
    TOTAL STI SUMUT
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
        </div>       -->



        <div class="col-12 text-center">
              <label class="upload-box">
                <input type="file" hidden accept=".pdf" name="upload_ba">
                <i class="bi bi-upload"></i>
                <div>Upload BA (PDF)</div>
                <small>Maks. 5MB</small>
              </label>
            </div>

            <div class="modal-footer px-4 py-3">
        <button class="btn btn-light" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="submit" name="submit" class="btn btn-primary px-4" >
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
                <li><a href="services.html">Layanan PLN Icon+</a></li>
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
    <script src="assets/js/slaicon+.js"></script>
  </body>
</html>
