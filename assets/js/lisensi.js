document.addEventListener("DOMContentLoaded", function () {
  const btnTambah = document.querySelector('[data-bs-target="#modalLaporan"]');
  const modalOffice = new bootstrap.Modal(
    document.getElementById("modalOffice365"),
  );

  btnTambah.addEventListener("click", function (e) {
    e.preventDefault();
    modalOffice.show();
  });
});
