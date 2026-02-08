const modalLaporan = document.getElementById("modalLaporan");
modalLaporan.addEventListener("shown.bs.modal", () => {
  modalLaporan.querySelector("input, select")?.focus();
});
