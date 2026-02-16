const openBtn = document.getElementById("openLogin");
const overlay = document.getElementById("loginOverlay");
const closeBtn = document.getElementById("closeLogin");
const loginForm = document.getElementById("loginForm");

// Buka overlay
openBtn.addEventListener("click", () => {
  overlay.classList.add("active");
});

// Tutup overlay
closeBtn.addEventListener("click", () => {
  overlay.classList.remove("active");
});

// Klik luar untuk tutup
window.addEventListener("click", (e) => {
  if (e.target === overlay) {
    overlay.classList.remove("active");
  }
});

// Submit login

loginForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const errorDiv = document.getElementById("loginError");

  const validUsername = "admin";
  const validPassword = "pln123";

  if (username === validUsername && password === validPassword) {
    sessionStorage.setItem("isLoggedIn", "true");

    errorDiv.style.color = "green";
    errorDiv.textContent = "Login berhasil...";

    setTimeout(() => {
      window.location.href = "about.html";
    }, 1000);
  } else {
    errorDiv.style.color = "red";
    errorDiv.textContent = "Username atau Password salah!";
  }
});
