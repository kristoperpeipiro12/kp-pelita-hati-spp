$(document).ready(function () {
    const uploadedImage = $("#uploadedImage");
    // Mengaktifkan tooltip Bootstrap
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Menambahkan event listener untuk modal Bootstrap
    $("#myModal").on("shown.bs.modal", function () {
      $("#myInput").trigger("focus");
    });

    // Mengunggah gambar dari perangkat
    $("#fileInput").change(function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          uploadedImage.attr("src", e.target.result);
          uploadedImage.show();
        };
        reader.readAsDataURL(file);
      } else {
        uploadedImage.hide();
      }
    });

    $(".copy-text").on("click", function () {
      // Mendapatkan teks dari elemen yang diklik
      const text = $(this).text();

      // Menyalin teks ke clipboard
      navigator.clipboard
        .writeText(text)
        .then(() => {
          console.log("Rekening berhasil disalin: " + text);
        })
        .catch((err) => {
          console.error("Error copying text: ", err);
          console.log("Gagal menyalin rekening");
        });
    });
  });
