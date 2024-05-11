let formPem = document.getElementById("form-tam-pem");
let btnToggleForm = document.getElementById("toggle-form");

let open = false;
btnToggleForm.onclick = function () {
  formPem.classList.toggle("active-pem");
  btnToggleForm.classList.toggle("active-btn-pem");
  open = !open;
  if (open === true) {
    btnToggleForm.innerHTML =
      '<i id="scale-btn" class="bi bi-x-lg text-white fw-bolder"></i>';
  } else {
    btnToggleForm.innerHTML = "Tambah Pemasukan";
  }
};
