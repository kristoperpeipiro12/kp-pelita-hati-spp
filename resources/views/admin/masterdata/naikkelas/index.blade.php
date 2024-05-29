@extends('layout.main')
@section('content')

<div class="col-lg-12">
    <div class="card mb-4">
        <span class="bg-warning p-3 w-100 d-flex justify-content-center my-4">Harap edit data dari kelas tertinggi (kelas 6)</span>
        <div class="container mt-5">

            <div class="accordion" id="kelasAccordion">
                @for ($i = 6; $i >= 1; $i--)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingKelas{{ $i }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKelas{{ $i }}" aria-expanded="false" aria-controls="collapseKelas{{ $i }}">
                                Kelas {{ $i }}
                            </button>
                        </h2>
                        <div id="collapseKelas{{ $i }}" class="accordion-collapse collapse" aria-labelledby="headingKelas{{ $i }}" data-bs-parent="#kelasAccordion">
                            <div class="accordion-body">
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

@endsection
