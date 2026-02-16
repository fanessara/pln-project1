document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM siap");

  const form = document.getElementById("formOffice365");

  console.log("Form:", form);

  if (!form) {
    console.log("Form tidak ditemukan!");
    return;
  }

  form.addEventListener("submit", function (e) {
  e.preventDefault();

  const fileInput = document.getElementById("fileBA");
  const file = fileInput.files[0];

  if (!file) {
    alert("PDF wajib diupload!");
    return;
  }

  if (file.type !== "application/pdf") {
    alert("File harus PDF!");
    return;
  }

  const reader = new FileReader();

  reader.onload = function () {

    const dataBaru = {
      periode: document.getElementById("periode").value,
      tahun: document.getElementById("tahun").value,
      nomorBA: document.getElementById("nomorBA").value.trim(),
      tanggalBA: document.getElementById("tanggalBA").value,
      e1: document.getElementById("e1").value,
      e3: document.getElementById("e3").value,
      e5: document.getElementById("e5").value,
      coreCal: document.getElementById("coreCal").value,
      unit: document.getElementById("unit").value,
      totalTagihan: document.getElementById("totalTagihan").value,
      fileName: file.name,
      fileData: reader.result // 🔥 ini base64 PDF
    };

    let data = JSON.parse(localStorage.getItem("office365Data")) || [];

    data.push(dataBaru);

    localStorage.setItem("office365Data", JSON.stringify(data));

    alert("Data & PDF berhasil disimpan!");

    form.reset();

    const modalElement = document.getElementById("modalOffice365");
    const modalInstance = bootstrap.Modal.getInstance(modalElement);
    modalInstance.hide();
  };

  reader.readAsDataURL(file);
});

