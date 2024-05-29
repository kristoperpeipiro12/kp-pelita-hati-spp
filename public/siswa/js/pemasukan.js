$(function () {
  $("#nisInput").keyup(function () {  
    var filter = $(this).val().replace(/\s/g, ""), // Menghapus semua spasi dari nilai input
      count = 0;
    $(".recommend .element-rec").each(function () {
      if (count <= 5 && filter != "") {
        var text = $(this).text().replace(/\s/g, ""); // Menghapus semua spasi dari teks elemen
        if (text.search(new RegExp(filter, "i")) < 0) {
          $(this).removeClass("d-flex").addClass("d-none");
        } else {
          $(this).removeClass("d-none").addClass("d-flex");
          count++;
        }
      } else {
        $(".element-rec").removeClass("d-flex").addClass("d-none");
      }
    });

    if (count === 0 && filter != "") {
      $("#not-found").removeClass("d-none").addClass("d-flex");
    } else {
      $("#not-found").removeClass("d-flex").addClass("d-none");
    }
  });

  $(".element-rec").click(function () {
    var value = $(this).text().replace(/\s/g, ""); // Menghapus semua spasi dari teks elemen yang diklik
    $("#nisInput").val(value);
    $(this).removeClass("d-flex").addClass("d-none");
    $("#not-found").removeClass("d-flex").addClass("d-none");
  });
});
