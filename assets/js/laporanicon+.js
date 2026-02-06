document.addEventListener("DOMContentLoaded", function () {
  const btnSearch = document.getElementById("btnSearch");
  const emptyState = document.getElementById("emptyState");
  const resultState = document.getElementById("resultState");
  const laporanResult = document.getElementById("laporanResult");

  btnSearch.addEventListener("click", function () {
    const keyword = document.getElementById("searchKeyword").value;
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    // === simulasi hasil pencarian ===
    // nanti ganti ini dari backend / API
    const dataLaporan = [];

    if (dataLaporan.length === 0) {
      // TIDAK ADA DATA
      emptyState.classList.remove("d-none");
      resultState.classList.add("d-none");
    } else {
      // ADA DATA
      emptyState.classList.add("d-none");
      resultState.classList.remove("d-none");

      laporanResult.innerHTML = `
        <div class="col-md-4">
          <div class="report-item">
            <span class="badge bg-primary mb-2">PLN Icon+</span>
            <h6>Laporan #ICON-2026-001</h6>
            <small>Status: Diproses</small>
          </div>
        </div>
      `;
    }
  });
});
