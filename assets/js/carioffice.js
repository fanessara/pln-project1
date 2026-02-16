document.addEventListener("DOMContentLoaded", function () {
  const btnCari = document.getElementById("btnCari");

  if (!btnCari) {
    console.log("Tombol Cari tidak ditemukan");
    return;
  }

  btnCari.addEventListener("click", function () {
    const keyword = document.getElementById("searchBA").value.trim();
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    const container = document.getElementById("hasilContainer");

    let data = localStorage.getItem("office365Data");

    if (!data) {
      container.innerHTML = `
        <div class="empty-state">
          <h5>Belum ada data tersimpan</h5>
        </div>
      `;
      return;
    }

    data = JSON.parse(data);

    let hasil = data;

    // Filter Nomor BA
    if (keyword !== "") {
      hasil = hasil.filter(
        (item) =>
          item.nomorBA &&
          item.nomorBA.toLowerCase().includes(keyword.toLowerCase()),
      );
    }

    // Filter Tanggal
    if (startDate !== "") {
      hasil = hasil.filter((item) => item.tanggalBA >= startDate);
    }

    if (endDate !== "") {
      hasil = hasil.filter((item) => item.tanggalBA <= endDate);
    }

    if (hasil.length === 0) {
      container.innerHTML = `
        <div class="empty-state">
          <h5>Data tidak ditemukan</h5>
          <p>Silakan cari laporan atau tambahkan laporan baru</p>
        </div>
      `;
      return;
    }

    let html = `<div class="row">`;

    hasil.forEach((item) => {
      html += `
        <div class="col-md-4">
          <div class="report-item p-3 border rounded mb-3">
            <span class="badge bg-primary mb-2">Office 365</span>
            <h6>Laporan #${item.nomorBA}</h6>
            <small>
              Periode: ${item.periode}/${item.tahun}<br>
              Tanggal: ${item.tanggalBA}<br>
              Unit: ${item.unit}<br>
              Total: Rp ${item.totalTagihan}
            </small>
          </div>
        </div>
      `;
    });

    html += "</div>";

    container.innerHTML = html;
  });
});
