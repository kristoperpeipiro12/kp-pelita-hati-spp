document.addEventListener("DOMContentLoaded", function () {
    const numberInput = document.getElementById("numberInput");
    if (numberInput) {
      numberInput.addEventListener("input", function (event) {
        let value = event.target.value.replace(/\D/g, ""); // Menghapus semua karakter kecuali digit
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Menambah titik setiap tiga digit
        event.target.value = value;
      });
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const nisInput = document.getElementById("nisInput");
    if (nisInput) {
      nisInput.addEventListener("input", function (event) {
        let value = event.target.value.replace(/\D/g, ""); // Menghapus semua karakter kecuali digit
        event.target.value = value;
      });
    }
    let pass_murid = document.getElementById("pass_murid"); // Menggunakan camelCase untuk id
    if (pass_murid) {
      let form_murid = document.getElementById("form-murid"); // Menggunakan camelCase untuk id
      form_murid.addEventListener("submit", function (event) {
        event.preventDefault(); // Menghentikan pengiriman formulir agar bisa memproses nilai baru

        // Mengambil nilai dari nisInput dan mengisinya ke pass_murid
        pass_murid.value = nisInput.value;

        // Melakukan pengiriman formulir
        form_murid.submit();
      });
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    const hpInput = document.getElementById("hpInput");
    if (hpInput) {
      hpInput.addEventListener("input", function (event) {
        let value = event.target.value.replace(/\D/g, "");
        event.target.value = value;
      });
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    // toggle hide/unhide password
    let btnPass1 = document.getElementById("togglePass1");
    let btnPass2 = document.getElementById("togglePass2"); // btn konfirmasi pass

    let pass = document.getElementById("pass");
    let konfpass = document.getElementById("konfpass");

    if (btnPass1) {
      btnPass1.onclick = function () {
        if (pass.type === "password") {
          pass.type = "text";
          btnPass1.classList.add("bi-eye");
          btnPass1.classList.remove("bi-eye-slash");
        } else {
          pass.type = "password";
          btnPass1.classList.remove("bi-eye");
          btnPass1.classList.add("bi-eye-slash");
        }
      };
    }

    if (btnPass2) {
      btnPass2.onclick = function () {
        if (konfpass.type === "password") {
          konfpass.type = "text";
          btnPass2.classList.add("bi-eye");
          btnPass2.classList.remove("bi-eye-slash");
        } else {
          konfpass.type = "password";
          btnPass2.classList.remove("bi-eye");
          btnPass2.classList.add("bi-eye-slash");
        }
      };
    }
  });
