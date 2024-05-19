$(document).ready(function () {
  // Mengaktifkan tooltip Bootstrap
  $('[data-bs-toggle="tooltip"]').tooltip();

  // Menambahkan event listener untuk modal Bootstrap
  $("#myModal").on("shown.bs.modal", function () {
    $("#myInput").trigger("focus");
  });
});
