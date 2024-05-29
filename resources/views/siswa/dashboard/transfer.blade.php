@extends('siswa.layout.main')
@section('content')
<div class="main-content container-fluid">
    <div class="d-flex justify-content-between align-items-center mt-3 mb-5">
        <h2 class="judul-page fw-medium m-0">School Fee Management System</h2>
        <a class="btn text-primary-emphasis h-50" href="https://wa.me/6285845177710" target="_blank"
           data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hubungi Admin">
            <i class="bi bi-person-circle fs-4"></i>
        </a>
    </div>
    <a class="text-decoration-none d-flex justify-content-end pe-1 fw-medium" href="{{ route('dashboard.siswa') }}">Kembali</a>
    <br>
    <div class="d-flex flex-column">
        <form action="{{ route('transfer.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <table class="table">
                <tr>
                    <td>Nominal Pembayaran</td>
                    <td>:</td>
                    <td>Rp. {{ number_format($tagihan->tagihan_perbulan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><label for="fileInput" class="form-label">Unggah Bukti Pembayaran</label></td>
                    <td>:</td>
                    <td>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="fileInput" name="foto">
                        </div>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="nis" value="{{ Auth::user()->nis }}">
            <input type="hidden" name="pemasukan" value="{{ $tagihan->tagihan_perbulan }}">
            <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
            <input type="hidden" name="jenis_transaksi" value="transfer">
            <div class="w-100 d-flex justify-content-center align-items-center">
                <img id="uploadedImage" width="320" height="240" alt="Unggah gambar akan muncul di sini">
            </div>
            <div class="d-flex w-100 justify-content-center">
                <button type="submit" class="btn btn-primary w-50">Kirim!</button>
            </div>
        </form>

        <span class="mt-3 mb-1">Pilih Layanan Bank :</span>
    </div>

    <!-- Accordion Bank -->
    <div class="accordion" id="accordionBank">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseBankOne" aria-expanded="true" aria-controls="collapseBankOne">
                    <span class="text-primary">BCA</span>
                </button>
            </h2>
            <div id="collapseBankOne" class="accordion-collapse collapse" data-bs-parent="#accordionBank">
                <div class="accordion-body">
                    <table class="bg- w-100">
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td class="copy-text">123-456-789-000</td>
                        </tr>
                        <tr>
                            <td>atas nama</td>
                            <td>:</td>
                            <td>BUDI SETIAWAN</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseBankTwo" aria-expanded="false" aria-controls="collapseBankTwo">
                    <span class="text-success">BNI</span>
                </button>
            </h2>
            <div id="collapseBankTwo" class="accordion-collapse collapse" data-bs-parent="#accordionBank">
                <div class="accordion-body">
                    <table class="bg- w-100">
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td class="copy-text">123-456-789-000</td>
                        </tr>
                        <tr>
                            <td>atas nama</td>
                            <td>:</td>
                            <td>BUDI SETIAWAN</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseBankThree" aria-expanded="false" aria-controls="collapseBankThree">
                    <span class="text-primary-emphasis">Mandiri</span>
                </button>
            </h2>
            <div id="collapseBankThree" class="accordion-collapse collapse" data-bs-parent="#accordionBank">
                <div class="accordion-body">
                    <table class="bg- w-100">
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td class="copy-text">123-456-789-000</td>
                        </tr>
                        <tr>
                            <td>atas nama</td>
                            <td>:</td>
                            <td>BUDI SETIAWAN</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
