const openBtn = document.getElementById("openLogin");
const overlay = document.getElementById("loginOverlay");
const closeBtn = document.getElementById("closeLogin");

openBtn.addEventListener("click", () => {
  overlay.classList.add("active");
});

closeBtn.addEventListener("click", () => {
  overlay.classList.remove("active");
});
