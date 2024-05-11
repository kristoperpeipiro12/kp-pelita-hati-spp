let hide = document.getElementById("hide");
let pass = document.getElementById("password");

let tampil = true;

hide.onclick = function () {
  if (tampil) {
    pass.setAttribute("type", "text");
    hide.setAttribute("src", "../assets/icons/eye-slash.svg");
    tampil = !tampil;
  } else {
    pass.setAttribute("type", "password");
    hide.setAttribute("src", "../assets/icons/eye.svg");
    tampil = !tampil;
  }
};

let masuk = document.getElementById("masuk");
masuk.onclick = function () {
  window.location.href = "index.html";
};
