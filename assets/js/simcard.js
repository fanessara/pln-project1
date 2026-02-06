document.addEventListener("DOMContentLoaded", function () {
  const btnSimcard = document.getElementById("btnSimcardAPN");
  const laporanMenu = document.getElementById("laporanMenu");
  const simcardMenu = document.getElementById("simcardMenu");
  const simcardForm = document.getElementById("simcardForm");
  const modalSubtitle = document.getElementById("modalSubtitle");
  const providerTitle = document.getElementById("providerTitle");

  // klik SIM CARD APN
  btnSimcard.addEventListener("click", function () {
    laporanMenu.classList.add("d-none");
    simcardMenu.classList.remove("d-none");
    modalSubtitle.innerText = "Pilih Provider SIM Card";
  });

  // klik provider
  document.querySelectorAll(".provider-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      const provider = this.dataset.provider;
      providerTitle.innerText = provider;

      simcardMenu.classList.add("d-none");
      simcardForm.classList.remove("d-none");
      modalSubtitle.innerText = "Form Data SIM Card APN";
    });
  });

  // back ke menu laporan
  document.getElementById("btnBackToMenu").addEventListener("click", () => {
    simcardMenu.classList.add("d-none");
    laporanMenu.classList.remove("d-none");
    modalSubtitle.innerText = "Pilih jenis laporan";
  });

  // back ke provider
  document.getElementById("btnBackToProvider").addEventListener("click", () => {
    simcardForm.classList.add("d-none");
    simcardMenu.classList.remove("d-none");
    modalSubtitle.innerText = "Pilih Provider SIM Card";
  });
});
