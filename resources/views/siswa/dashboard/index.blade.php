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
    <div class="card" id="identitas">
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
                @if(Auth::user()->foto)

                     <img src="{{ asset('storage/foto-siswa/' . Auth::user()->foto) }}" alt="" class="img-murid rounded-circle">

                @else
                    <img src="{{ asset('siswa/assets/userprofile.png') }}" alt="foto-murid" class="img-murid rounded-circle">
                @endif
            </div>
        </div>
    </div>


    <br>
    <br>

    <div class="accordion" id="accordionExample">
        <section id="tagihan">
            <div class="accordion-item">
                <h2 class="accordion-header fw-bold">
                    <h5>Total tagihan: Rp{{ number_format($totalTagihan, 0, ',', '.') }}</h5>
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="fw-medium fs-judul-tag-inf">Tagihan SPP</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body accor-tagihan">
                        @php
                            $months = [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ];
                        @endphp
                        @foreach(array_chunk($months, 3) as $monthChunk)
                            <div class="sub-accor-tagihan">
                                @foreach($monthChunk as $month)
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title fs-tag-bulan">{{ $month }}</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary text-end">Belum Lunas</h6>
                                        <p class="card-text text-end">Rp. {{ number_format($totalTagihan / 12, 0, ',', '.') }}</p>
                                        <a href="{{ route('transfer.create') }}" class="btn btn-primary">
                                            Transfer
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="informasi">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="fw-medium fs-judul-tag-inf">Informasi</span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-header">
                            {{-- {{ $informasi->judul }} --}}
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    {{-- <p>{{ $informasi->info }}</p> --}}
                                    {{-- <footer class="blockquote-footer">Administrasi <cite title="Source Title">Ibu
                                            Ani</cite></footer> --}}
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
