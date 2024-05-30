$(function () {
    $('#nisInput').on('input', function () {
        var inputVal = $(this).val().replace(/\s/g, '') // Menghapus semua spasi dari nilai input
        var count = 0

        // Jika input tidak kosong
        if (inputVal !== '') {
            $('.recommend .element-rec').each(function () {
                var text = $(this).text().replace(/\s/g, '') // Menghapus semua spasi dari teks elemen
                if (text.includes(inputVal)) {
                    $(this).removeClass('d-none').addClass('d-flex')
                    count++
                } else {
                    $(this).removeClass('d-flex').addClass('d-none')
                }
                if (count >= 5) return false // Hentikan iterasi setelah menemukan 5 rekomendasi
            })
            if (count === 0) {
                $('#not-found').removeClass('d-none').addClass('d-flex')
            } else {
                $('#not-found').removeClass('d-flex').addClass('d-none')
            }
        } else {
            // Jika input kosong, sembunyikan semua rekomendasi dan pesan tidak ditemukan
            $('.element-rec').removeClass('d-flex').addClass('d-none')
            $('#not-found').removeClass('d-flex').addClass('d-none')
        }
    })

    $('.element-rec').click(function () {
        var value = $(this).text().replace(/\s/g, '') // Menghapus semua spasi dari teks elemen yang diklik
        $('#nisInput').val(value)
        $('.element-rec').removeClass('d-flex').addClass('d-none')
        $('#not-found').removeClass('d-flex').addClass('d-none')
    })
})
