// modal-bootstrap (ga jalan)
$("#myModal").on("shown.bs.modal", function () {
    $("#myInput").trigger("focus");
});

// index.php - halaman informasi
// let btnEdit = document.getElementById("btn-edit-info");
// let btnSimpan = document.getElementById("btn-baru-info")

// let editJudul = document.getElementById("edit-judul");
// let editInfo = document.getElementById("edit-info");

// let isiJudul = document.getElementById("isi-judul");
// let isiInfo = document.getElementById("isi-info");

// btnEdit.onclick = function () {
//     btnEdit.classList.add("d-none");
//     btnSimpan.classList.remove("d-none");
    
//     editJudul.classList.add("d-inline-block");
//     editInfo.classList.add("d-inline-block");
//     editJudul.classList.remove("d-none");
//     editInfo.classList.remove("d-none");

//     isiJudul.classList.add("d-none");
//     isiInfo.classList.add("d-none");
//     isiJudul.classList.remove("d-inline-block");
//     isiInfo.classList.remove("d-inline-block");
// }

// btnSimpan.onclick = function () {
//     btnEdit.classList.remove("d-none");
//     btnSimpan.classList.add("d-none");

//     editJudul.classList.remove("d-inline-block");
//     editInfo.classList.remove("d-inline-block");
//     editJudul.classList.add("d-none");
//     editInfo.classList.add("d-none");

//     isiJudul.classList.remove("d-none");
//     isiInfo.classList.remove("d-none");
//     isiJudul.classList.add("d-inline-block");
//     isiInfo.classList.add("d-inline-block");
// }

let btnEdits = document.querySelectorAll(".btn-edit-info");
let btnSimpans = document.querySelectorAll(".btn-baru-info");

let editJuduls = document.querySelectorAll(".edit-judul");
let editInfos = document.querySelectorAll(".edit-info");

let isiJuduls = document.querySelectorAll(".isi-judul");
let isiInfos = document.querySelectorAll(".isi-info");

btnEdits.forEach(function(btnEdit, index) {
    btnEdit.onclick = function () {
        btnEdit.classList.add("d-none");
        btnSimpans[index].classList.remove("d-none");
        
        editJuduls[index].classList.add("d-inline-block");
        editInfos[index].classList.add("d-inline-block");
        editJuduls[index].classList.remove("d-none");
        editInfos[index].classList.remove("d-none");

        isiJuduls[index].classList.add("d-none");
        isiInfos[index].classList.add("d-none");
        isiJuduls[index].classList.remove("d-inline-block");
        isiInfos[index].classList.remove("d-inline-block");
    };
});

btnSimpans.forEach(function(btnSimpan, index) {
    btnSimpan.onclick = function () {
        btnEdits[index].classList.remove("d-none");
        btnSimpan.classList.add("d-none");

        editJuduls[index].classList.remove("d-inline-block");
        editInfos[index].classList.remove("d-inline-block");
        editJuduls[index].classList.add("d-none");
        editInfos[index].classList.add("d-none");

        isiJuduls[index].classList.remove("d-none");
        isiInfos[index].classList.remove("d-none");
        isiJuduls[index].classList.add("d-inline-block");
        isiInfos[index].classList.add("d-inline-block");
    };
});


