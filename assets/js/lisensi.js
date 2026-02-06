document.addEventListener("DOMContentLoaded", function () {
  const btnOffice = document.getElementById("btnOffice365");
  const modalOfficeEl = document.getElementById("modalOffice365");

  if (btnOffice && modalOfficeEl) {
    btnOffice.addEventListener("click", function () {
      const modalOffice = new bootstrap.Modal(modalOfficeEl);
      modalOffice.show();
    });
  }
});
