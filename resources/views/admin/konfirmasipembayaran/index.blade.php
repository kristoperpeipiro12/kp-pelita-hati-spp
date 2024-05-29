@extends('layout.main')
@section('content')
<!-- DataTable with Hover -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Konfirmasi Pemasukan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Daftar Pemasukan</h6> --}}
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th class="mini-th">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Pemasukan(Rp)</th>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>
                            <th>foto bukti</th>
                            <th class="text-center mini-th">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($konfirmasi as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nis }}</td>
                            <td>{{ $k->siswa->nama }}</td>
                            <td>Rp. {{ number_format($k->pemasukan, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $k->jenis_transaksi}}</td>
                            <td>
                                <img src="{{ asset('storage/Bukti-transfer/' . $k->foto) }}" alt="" width="65" id="foto{{$k->id}}" onclick="showImage('{{ asset('storage/Bukti-transfer/' . $k->foto) }}')">
                            </td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('konfirmasi.terima',$k->id) }}" class="btn btn-success btn-sm mr-2"><i class="fas fa-check"></i> Konfirmasi</a>
                                <form action="{{ route('konfirmasi.tolak',$k->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm ml-2">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
    function showImage(imagePath) {
        // Buat elemen img baru
        var img = document.createElement('img');
        img.src = imagePath;

        // Gaya CSS untuk memperbesar gambar
        img.style.maxWidth = '100%';
        img.style.height = 'auto';

        // Tampilkan gambar dalam modal atau layar overlay
        var modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.zIndex = '9999';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0,0,0,0.7)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.onclick = function() {
            document.body.removeChild(modal);
        };

        // Tambahkan gambar ke dalam modal
        modal.appendChild(img);

        // Tambahkan modal ke dalam body dokumen
        document.body.appendChild(modal);
    }

</script>

@endsection
