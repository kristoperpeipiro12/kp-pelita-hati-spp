@extends('layout.main')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between" style="padding: 12px 20px;">
                        <h1 class="h3 mb-0 text-gray-800">Kenaikan Kelas</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kenaikan Kelas</li>
                        </ol>
                    </div>
                    <div class="mb-2 p-3 d-inline-block text-center text-warning align-self-center"
                        style="border-radius: 30px; width: 400px; font-weight: bold">
                        <i class="bi bi-exclamation-triangle" style="padding-right: 8px; font-size: 20px"></i>Harap edit
                        data dari kelas
                        tertinggi (Kelas 6)
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            <div class="accordion" id="kelasAccordion">
                                @for ($i = 6; $i >= 1; $i--)
                                    <h2 class="mx-3 mb-3" id="headingKelas{{ $i }}">
                                        <button class="btn btn-block text-left" type="button"
                                            style="background-color: #7286D3; color: white;" data-toggle="collapse"
                                            data-target="#collapseKelas{{ $i }}" aria-expanded="true"
                                            aria-controls="collapseKelas{{ $i }}">
                                            Kelas {{ $i }}
                                        </button>
                                    </h2>
                                    <div id="collapseKelas{{ $i }}" class="collapse"
                                        aria-labelledby="headingKelas{{ $i }}" data-parent="#kelasAccordion">
                                        <div class="card-body">
                                            <form action="{{ route('admin.siswa.naiksemua') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $i }}" name="kelas">
                                                <button type="submit"
                                                    class="btn btn-danger mb-3">{{ $i == 6 ? 'Lulus ' : 'Naik ' }}Semua</button>
                                            </form>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NIS</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">Kelas</th>
                                                        <th scope="col">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data[$i] as $siswa)
                                                        <tr>
                                                            <td>{{ $siswa->nis }}</td>
                                                            <td>{{ $siswa->nama }}</td>
                                                            <td>{{ $siswa->kelas }}</td>
                                                            <td>
                                                                <form method="POST"
                                                                    action="{{ route('admin.siswa.naiksatu') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="nis"
                                                                        value="{{ $siswa->nis }}">
                                                                    <input type="hidden" name="kelas"
                                                                        value="{{ $siswa->kelas }}">
                                                                    <button type="submit"
                                                                        class="btn btn-success">{{ $i == 6 ? 'Lulus ' : 'Naik Kelas' }}</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
