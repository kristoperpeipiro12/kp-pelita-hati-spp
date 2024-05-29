<table class="table align-items-center table-flush table-hover" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th class="mini-th">No</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th class="mini-th">Kelas</th>
            <th class="text-center mini-th">Foto</th>
            <th class="text-center mini-th">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswa as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nis }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->nohp }}</td>
                <td>{{ $item->kelas }}</td>
                <td><img src="{{ asset('storage/foto-siswa/' . $item->foto) }}" alt=""
                        width="65"></td>
                <td class="d-flex justify-content-between">
                    <a href="{{ route('admin.siswa.edit', $item->nis) }}"
                        class="btn btn-primary btn-sm mr-2"><i class="fas fa-pen-alt"></i></a>
                    <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal"
                        data-target="#deleteModal{{ $item->nis }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>

            <!-- Modal Delete -->
            <div class="modal fade" id="deleteModal{{ $item->nis }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Batal</button>
                            <form action="{{ route('admin.siswa.delete', $item->nis) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Delete -->
        @endforeach
    </tbody>
</table>
