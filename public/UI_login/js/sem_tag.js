// let btnCounter = document.getElementById("coba");

// let liIndex = [];
// let counter = 0;

// let tglTagihan = new Date();

// btnCounter.onclick = function () {
//   let keterangan = document.getElementById("keterangan").value;
//   if (keterangan == "") {
//     alert("Harap Masukkan Keterangan");
//     return;
//   }
//   counter++;
//   // Membuat elemen li baru
//   let newListItem = document.createElement("li");

//   //Membuat elemen span baru (nama tagihan)
//   let newNamaSpan = document.createElement("span");
//   newNamaSpan.textContent = "Nama : Tagihan " + counter;

//   //Membuat elemen span baru (nama tagihan)
//   let newKetSpan = document.createElement("span");
//   newKetSpan.textContent = keterangan;

//   //Membuat elemen span baru (tanggal tagihan)
//   let newTglSpan = document.createElement("span");
//   newTglSpan.id = "tgl";
//   newTglSpan.textContent =
//     "Jatuh Tempo : " +
//     tglTagihan.getDate() +
//     "/" +
//     tglTagihan.getMonth() +
//     "/" +
//     tglTagihan.getFullYear();

//   //Membuat elemen div baru
//   let newTglDiv = document.createElement("div");
//   newTglDiv.classList.add("tanggal");
//   newTglDiv.appendChild(newKetSpan);
//   newTglDiv.appendChild(newTglSpan);

//   // Menambahkan kelas ke elemen li
//   newListItem.classList.add("tagihan");
//   newListItem.appendChild(newNamaSpan);
//   newListItem.appendChild(newTglDiv);

//   // Mendapatkan elemen ul dengan kelas list-group
//   let listGroup = document.querySelector(".list-tagihan");

//   // Menambahkan elemen li ke dalam elemen ul
//   listGroup.appendChild(newListItem);

//   // Membersihkan Input Keterangan
//   document.getElementById("keterangan").value = "";
// };
// Cek Tinggi Lebar

let myWidth = window.innerWidth;
let myHeight = window.innerHeight;
console.log("W :" + myWidth);
console.log("H :" + myHeight);

// Panel Tambah Tagihan
let bgTag = document.getElementById("tagBg");
let pnTag = document.getElementById("tagPn");
let openTag = document.getElementById("tagOpen");
let closeTag = document.getElementById("tagClose");

closeTag.onclick = function () {
  pnTag.style.display = "none";
  bgTag.style.display = "none";
  document.body.style.overflow = "auto";
  // Animasi pn masuk
  pnTag.classList.toggle("active");
};

bgTag.onclick = function () {
  pnTag.style.display = "none";
  bgTag.style.display = "none";
  document.body.style.overflow = "auto";
  // Animasi pn masuk
  pnTag.classList.toggle("active");
};

openTag.onclick = function () {
  pnTag.style.display = "block";
  bgTag.style.display = "block";
  document.body.style.overflow = "hidden";
  // Animasi pn masuk
  pnTag.classList.toggle("active");
};

// Select item tam-tag
let tamTagMurid = document.getElementById("tam-tag-murid");
let tamTagKelas = document.getElementById("tam-tag-kelas");
let tamTagTa = document.getElementById("tam-tag-ta");
let pnSelectedItem = document.getElementById("pn-item-select");

let displaySiswa = document.getElementById("siswa");
let displayKelas = document.getElementById("kelas");
let displayTa = document.getElementById("tahun-ajar");

tamTagMurid.onclick = function () {
  if (displaySiswa.classList.contains("d-none")) {
    displaySiswa.classList.remove("d-none");
    pnSelectedItem.innerText = "Per-Murid";
  }
  displayKelas.classList.add("d-none");
  displayTa.classList.add("d-none");
  pnSelectedItem.innerText = "Per-Murid";
};

tamTagKelas.onclick = function () {
  if (displayKelas.classList.contains("d-none")) {
    displayKelas.classList.remove("d-none");
    pnSelectedItem.innerText = "Per-Kelas";
  }
  displaySiswa.classList.add("d-none");
  displayTa.classList.add("d-none");
  pnSelectedItem.innerText = "Per-Kelas";
};

tamTagTa.onclick = function () {
  if (displayTa.classList.contains("d-none")) {
    displayTa.classList.remove("d-none");
    pnSelectedItem.innerText = "Per-Tahun Ajar";
  }
  displaySiswa.classList.add("d-none");
  displayKelas.classList.add("d-none");
  pnSelectedItem.innerText = "Per-Tahun Ajar";
};
