let muridSelect = document.getElementById("master-murid");
let yayasanSelect = document.getElementById("master-yayasan");
let adminSelect = document.getElementById("master-admin");

let muridContent = document.getElementById("md-murid");
let yayasanContent = document.getElementById("md-yayasan");
let adminContent = document.getElementById("md-admin");

let muridTable = document.getElementById("tabel-murid");
let yayasanTable = document.getElementById("tabel-yayasan");
let adminTable = document.getElementById("tabel-admin");

let btnAddUser = document.getElementById("open-form-user");
let formActive = "murid";

muridSelect.onclick = function () {
  formActive = "murid";
  btnAddUser.classList.remove("active-md");
  open = false;
  if (!muridSelect.classList.contains("active")) {
    // tab
    muridSelect.classList.add("active");
    yayasanSelect.classList.remove("active");
    adminSelect.classList.remove("active");
    // table
    muridTable.classList.remove("d-none");
    yayasanTable.classList.add("d-none");
    adminTable.classList.add("d-none");
    // btn-tambah-user
    btnAddUser.innerText = "Tambah Murid";
    // reset-form
    formMurid.classList.add("d-none");
    formYayasan.classList.add("d-none");
    formAdmin.classList.add("d-none");
  }
};
yayasanSelect.onclick = function () {
  formActive = "yayasan";
  btnAddUser.classList.remove("active-md");
  open = false;
  if (!yayasanSelect.classList.contains("active")) {
    muridSelect.classList.remove("active");
    yayasanSelect.classList.add("active");
    adminSelect.classList.remove("active");
    // table
    muridTable.classList.add("d-none");
    yayasanTable.classList.remove("d-none");
    adminTable.classList.add("d-none");
    // btn-tambah-user
    btnAddUser.innerText = "Tambah Yayasan";
    // reset-form
    formMurid.classList.add("d-none");
    formYayasan.classList.add("d-none");
    formAdmin.classList.add("d-none");
  }
};
adminSelect.onclick = function () {
  formActive = "admin";
  btnAddUser.classList.remove("active-md");
  open = false;
  if (!adminSelect.classList.contains("active")) {
    muridSelect.classList.remove("active");
    yayasanSelect.classList.remove("active");
    adminSelect.classList.add("active");
    // table
    muridTable.classList.add("d-none");
    yayasanTable.classList.add("d-none");
    adminTable.classList.remove("d-none");
    // btn-tambah-user
    btnAddUser.innerText = "Tambah Admin";
    // reset-form
    formMurid.classList.add("d-none");
    formYayasan.classList.add("d-none");
    formAdmin.classList.add("d-none");
  }
};

// btn-tambah-user.onclick
let formMurid = document.getElementById("md-murid");
let formYayasan = document.getElementById("md-yayasan");
let formAdmin = document.getElementById("md-admin");
let open = false;
// lanjut disini
btnAddUser.onclick = function () {
  btnAddUser.classList.toggle("active-md");
  open = !open;
  if (open === true) {
    btnAddUser.innerHTML =
      '<i id="scale-btn" class="bi bi-x-lg text-white"></i>';
  } else if (open === false && formActive === "murid") {
    btnAddUser.innerHTML = "Tambah Murid";
  } else if (open === false && formActive === "yayasan") {
    btnAddUser.innerHTML = "Tambah Yayasan";
  } else if (open === false && formActive === "admin") {
    btnAddUser.innerHTML = "Tambah Admin";
  }

  if (formActive == "murid") {
    formMurid.classList.toggle("d-none");
  } else if (formActive == "yayasan") {
    formYayasan.classList.toggle("d-none");
  } else if (formActive == "admin") {
    formAdmin.classList.toggle("d-none");
  }
};

// dd-kelas-murid
let klsTitle = document.getElementById("kelas-title");

let kls1 = document.getElementById("kls-1");
let kls2 = document.getElementById("kls-2");
let kls3 = document.getElementById("kls-3");
let kls4 = document.getElementById("kls-4");
let kls5 = document.getElementById("kls-5");
let kls6 = document.getElementById("kls-6");

let klsSelected = document.getElementById("kelas-murid").value;

kls1.onclick = function () {
  klsTitle.innerText = kls1.innerText;
  klsSelected = "1";
};

kls2.onclick = function () {
  klsTitle.innerText = kls2.innerText;
  klsSelected = "2";
};

kls3.onclick = function () {
  klsTitle.innerText = kls3.innerText;
  klsSelected = "3";
};

kls4.onclick = function () {
  klsTitle.innerText = kls4.innerText;
  klsSelected = "4";
};

kls5.onclick = function () {
  klsTitle.innerText = kls5.innerText;
  klsSelected = "5";
};

kls6.onclick = function () {
  klsTitle.innerText = kls6.innerText;
  klsSelected = "6";
};
