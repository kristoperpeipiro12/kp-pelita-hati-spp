@extends('siswa.layout.main')
@section('content')
    <div class="main-content container-fluid">
        <div class="d-flex justify-content-between align-items-center mt-3 mb-5">
            <h2 class="judul-page fw-medium m-0">School Fee Management System</h2>
            <button class="btn text-primary-emphasis h-50" data-bs-toggle="tooltip" data-bs-placement="bottom"
                data-bs-title="Hubungi Admin">
                <i class="bi bi-person-circle fs-4"></i>
            </button>
        </div>

        <section id="informasi" class="mb-5">
            <div class="row">
                <!-- <div class="col-12">
                                                <h4>Informasi</h4>
                                                <hr>
                                            </div> -->
                <!-- <div class="col-12">
                                                <div class="accordion" id="accordionExample">
                                                    @foreach ($data_informasi as $informasi)
    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{ $informasi->id }}">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $informasi->id }}" aria-expanded="false"
                                                                aria-controls="collapse{{ $informasi->id }}">
                                                                <span class="fw-medium fs-judul-tag-inf">{{ $informasi->judul }}</span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{ $informasi->id }}" class="accordion-collapse collapse"
                                                            aria-labelledby="heading{{ $informasi->id }}" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>{{ $informasi->info }}</p>
                                                                <footer class="blockquote-footer">Tanggal <cite
                                                                        title="Source Title">{{ $informasi->tanggal }}</cite></footer>
                                                            </div>
                                                        </div>
                                                    </div>
    @endforeach
                                                </div>
                                            </div> -->
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-header bg-transparent">
                            <h4 class="fw-bold text-start">Informasi Terbaru!</h4>
                        </div>
                        @foreach ($data_informasi as $informasi)
                            <div class="card-body">
                                <h5 class="card-title">{{ $informasi->judul }}</h5>
                                <p class="card-text">{{ $informasi->info }}</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                            <div class="card-footer text-body-secondary fst-italic bg-transparent">
                                Tercatat pada : {{ $informasi->tanggal }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <div class="card" style="margin-top: 120px" id="identitas">
            <div class="card-header text-center fw-bold fs-judul-ident">
                Identitas Murid
            </div>
            <div class="card-body card-identitas">
                <div class="w-75">
                    <table class="table tabel-murid w-100">
                        <tr class="px-5">
                            <td class="text-">Nomor Induk Siswa</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->nis }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Nama Murid</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Kelas</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->kelas }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Jenis Kelamin</td>
                            <td class="px-2 text-center">:</td>
                            <td> {{ Auth::user()->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="text-">Status Murid</td>
                            <td class="px-2 text-center">:</td>
                            <td>{{ Auth::user()->status }}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-center w-25">
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/foto-siswa/' . Auth::user()->foto) }}" alt=""
                            class="img-murid rounded-circle">
                    @else
                        <img src="{{ asset('siswa/assets/userprofile.png') }}" alt="foto-murid"
                            class="img-murid rounded-circle">
                    @endif
                </div>
            </div>
        </div>

        <section id="tagihan" class="my-5">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-5">
                        <div class="col-12">
                            <h4>
                                Informasi Tagihan SPP
                            </h4>
                            <hr>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Tagihan Belum Lunas</h5>
                                    <p>{{ $bulan_belum_dibayar }} Bulan</p>
                                    <h3 class="card-text">Rp.
                                        {{ number_format($total_tagihan_belum_dibayar, 0, ',', '.') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Tagihan Lunas</h5>
                                    <p>{{ $bulan_dibayar }} Bulan</p>
                                    <h3 class="card-text">Rp. {{ number_format($total_tagihan_dibayar, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4>Daftar Tagihan SPP</h4>
                            <hr>
                        </div>

                        {{-- @foreach ($data_pembayaran as $jumlah_bulan_sejak_masuk => $pembayaran)
                            @php
                            $bulan = $pembayaran['bulan'];
                            $tahun = $pembayaran['tahun'];
                            @endphp
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <p>
                                            Tagihan Bulan {{ $bulan }}/{{ $tahun }}
                    </p>
                    <h2
                        class="card-title {{ ($pembayaran['status_pembayaran'] == 'Lunas') ? 'text-success' : 'text-danger' }}">
                        Rp.{{ number_format($pembayaran['jumlah_tagihan'], 0, ',', '.') }}
                    </h2>
                    <p
                        class="card-text {{ ($pembayaran['status_pembayaran'] == 'Lunas') ? 'text-success' : 'text-danger' }}">
                        {{ $pembayaran['status_pembayaran'] }}
                    </p>

                    @if ($pembayaran['status_pembayaran'] == 'Belum dibayarkan')
                    <button type="button" class="btn btn-success btn-sm" title="Bayar" data-bs-toggle="modal"
                        data-bs-target="#updateModal" data-bs-nis="{{ Auth::user()->nis }}" data-bs-bulan="{{ $bulan }}"
                        data-bs-tahun="{{ $tahun }}" data-bs-bayar="{{ $pembayaran['jumlah_tagihan'] }}">
                        <i class="fas fa-dollar"></i> Bayar
                    </button>
                    @endif

                </div>
            </div>
        </div>
        @endforeach --}}
                        @php
                            $grouped_pembayaran = [];
                            foreach ($data_pembayaran as $pembayaran) {
                                $tahun = $pembayaran['tahun'];
                                if (!isset($grouped_pembayaran[$tahun])) {
                                    $grouped_pembayaran[$tahun] = [];
                                }
                                $grouped_pembayaran[$tahun][] = $pembayaran;
                            }
                        @endphp
                        <div class="row text-end mb-2">
                            <span class="fs-4">No. Rek : <span class="text-primary">xxxx xxxx xxxx</span></span>
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach ($grouped_pembayaran as $tahun => $pembayarans)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $tahun }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $tahun }}" aria-expanded="true"
                                            aria-controls="collapse{{ $tahun }}">
                                            Tagihan Tahun {{ $tahun }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $tahun }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $tahun }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                @foreach ($pembayarans as $pembayaran)
                                                    @php
                                                        $bulan = $pembayaran['bulan'];
                                                        $status_pembayaran = $pembayaran['status_pembayaran'];
                                                        $jumlah_tagihan = $pembayaran['jumlah_tagihan'];
                                                    @endphp
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                                        <div class="card h-100">
                                                            <div class="card-body">
                                                                <p>Tagihan Bulan {{ $bulan }}/{{ $tahun }}
                                                                </p>
                                                                <h2
                                                                    class="card-title {{ $status_pembayaran == 'Lunas' ? 'text-success' : 'text-danger' }}">
                                                                    Rp.{{ number_format($jumlah_tagihan, 0, ',', '.') }}
                                                                </h2>
                                                                <p
                                                                    class="card-text {{ $status_pembayaran == 'Lunas' ? 'text-success' : 'text-danger' }}">
                                                                    {{ $status_pembayaran }}
                                                                </p>

                                                                @if ($status_pembayaran == 'Belum dibayarkan')
                                                                    <button type="button" class="btn btn-success btn-sm"
                                                                        title="Bayar" data-bs-toggle="modal"
                                                                        data-bs-target="#updateModal"
                                                                        data-bs-nis="{{ Auth::user()->nis }}"
                                                                        data-bs-bulan="{{ $bulan }}"
                                                                        data-bs-tahun="{{ $tahun }}"
                                                                        data-bs-bayar="{{ $jumlah_tagihan }}">
                                                                        <i class="fas fa-dollar"></i> Bayar
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section>


    </div>

    <!-- Modal untuk Update Pembayaran -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="updatePaymentForm" action="{{ route('siswa.tagihan.bayar') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Konfirmasi Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="konfirmasi" id="konfirmasi" value="Pending">
                        <input type="hidden" name="jenis_transaksi" id="jenis_transaksi" value="Transfer">

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="nis" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label for="bulan_tagihan" class="form-label">Bulan</label>
                                    <input type="text" class="form-control" id="bulan_tagihan" name="bulan_tagihan"
                                        readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label for="tahun_tagihan" class="form-label">Tahun</label>
                                    <input type="text" class="form-control" id="tahun_tagihan" name="tahun_tagihan"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                                <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar"
                                    readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                                <input type="date" class="form-control" id="tanggal_bayar"
                                    value="{{ date('Y-m-d') }}" name="tanggal_bayar">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Bukti Pembayaran</label>
                            <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control"
                                id="foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <img id="preview" src="#" alt="Pratinjau Gambar"
                                style="display: none; max-height: 200px;" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function formatRibuan(number) {
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        document.addEventListener('DOMContentLoaded', function() {
            var updateModal = document.getElementById('updateModal');
            updateModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var nis = button.getAttribute('data-bs-nis');
                var bulan = button.getAttribute('data-bs-bulan');
                var tahun = button.getAttribute('data-bs-tahun');
                var jumlahBayar = button.getAttribute('data-bs-bayar');

                var modalNis = updateModal.querySelector('#nis');
                var modalBulan = updateModal.querySelector('#bulan_tagihan');
                var modalTahun = updateModal.querySelector('#tahun_tagihan');
                var modalJumlahBayar = updateModal.querySelector('#jumlah_bayar');

                modalNis.value = nis;
                modalBulan.value = bulan;
                modalTahun.value = tahun;
                modalJumlahBayar.value = formatRibuan(jumlahBayar);
            });
        });

        document.getElementById('foto').addEventListener('change', function(event) {
            var preview = document.getElementById('preview');
            var file = event.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
