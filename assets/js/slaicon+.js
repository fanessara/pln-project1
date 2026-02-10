document.addEventListener("DOMContentLoaded", () => {
  const btn = document.querySelector('[data-bs-target="#modalSLAIcon"]');
  const modalEl = document.getElementById("modalSLAIcon");

  if (!btn || !modalEl) {
    console.error("Button atau modal tidak ditemukan");
    return;
  }

  const modal = new bootstrap.Modal(modalEl);

  btn.addEventListener("click", (e) => {
    e.preventDefault();
    modal.show();
  });
});
