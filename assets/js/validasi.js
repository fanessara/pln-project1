document.addEventListener("DOMContentLoaded", function () {
  const isLoggedIn = sessionStorage.getItem("isLoggedIn");

  // kalau belum login → redirect
  if (!isLoggedIn) {
    window.location.href = "index.html";
  }
});
