@extends('layout.main')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="alert alert-warning p-3 w-100 d-flex justify-content-center">Harap edit data dari kelas tertinggi (kelas 6)</div>

                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="accordion" id="kelasAccordion">
                            @for ($i = 6; $i >= 1; $i--)
                            <div class="card">
                                <h2 class="card-header" id="headingKelas{{ $i }}">
                                    <button class="btn btn-success btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseKelas{{ $i }}" aria-expanded="true" aria-controls="collapseKelas{{ $i }}">
                                        Kelas {{ $i }}
                                    </button>
                                </h2>
                                <div id="collapseKelas{{ $i }}" class="collapse" aria-labelledby="headingKelas{{ $i }}" data-parent="#kelasAccordion">
                                    <div class="card-body">
                                        <form action="{{ route('admin.siswa.naiksemua') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $i }}" name="kelas">
                                            <button type="submit" class="btn btn-success">{{ $i == 6 ? 'Lulus ' : 'Naik ' }}Semua</button>
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
                                                        <form method="POST" action="{{ route('admin.siswa.naiksatu') }}">
                                                            @csrf
                                                            <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                                            <input type="hidden" name="kelas" value="{{ $siswa->kelas }}">
                                                            <button type="submit" class="btn btn-success">{{ $i == 6 ? 'Lulus ' : 'Naik Kelas' }}</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
