@extends('layout.main')
@section('content')
    <script>
        $(document).ready(function() {
            var datetime = new Date();
            var tanggalHariIni = datetime.getDate() + '-' + datetime.getMonth() + '-' + datetime
                .getFullYear();
            var waktuHariIni = datetime.getHours() + ':' + datetime.getMinutes() + ':' + datetime
                .getSeconds();

            var table = $('#dataTable').DataTable({
                "paging": true,
                "responsive": false,
                "searching": true,
                "deferRender": true,
                "lengthMenu": [
                    [10, 25, 50, 100, 500, -1],
                    ['10', '25', '50', '100', '500', 'Semua']
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [
                    [1, 'asc']
                ]
            });

            table.on('order.dt search.dt', function() {
                table.column(0, {
                    order: 'applied',
                    search: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

        });


        document.addEventListener('DOMContentLoaded', function() {
            $('#modalForm').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var title = button.data('title');
                var aksi = button.data('aksi');

                var id = button.data('id');
                var judul = button.data('judul');
                var info = button.data('info');
                var tanggal = button.data('tanggal');
                var tampil = button.data('tampil');

                $('#modalFormLabel').html(title);

                if (aksi == "tambah") {
                    var action = '{{ route('informasi.create') }}';
                } else if (aksi == "ubah") {
                    var action = '{{ route('informasi.update', ':id') }}';
                    action = action.replace(':id', id);
                }

                $('#updateForm').attr('action', action);
                $('#judul').val(judul);
                $('#info').val(info);
                $('#tanggal').val(tanggal);
                $('#tampil').val(tampil);
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var action = '{{ route('informasi.delete', ':id') }}';
                action = action.replace(':id', id);
                $('#deleteForm').attr('action', action);
            });
        });
    </script>

    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="h3 mb-0 text-gray-800">Informasi</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Informasi</li>
                            </ol>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-2 mb-5">
                            <button type="button" class="btn btn-info" title="Tambah" data-toggle="modal"
                                data-aksi="tambah" data-tanggal="{{ date('Y-m-d') }}" data-title="Tambah Data"
                                data-target="#modalForm">
                                <i class="fas fa-plus mr-2"></i> Tambah
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="mini-th">No</th>
                                                <th>Tanggal</th>
                                                <th>Judul</th>
                                                <th>Status Tampil</th>
                                                <th class="text-center mini-th">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_informasi as $row)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}
                                                    </td>
                                                    <td style="width: 70%;">{{ $row->judul }}</td>
                                                    <td class="text-left">
                                                        @if ($row->tampil == 'Draft')
                                                            <span class="p-2 badge badge-secondary">Draft</span>
                                                        @elseif ($row->tampil == 'Tayang')
                                                            <span class="p-2 badge badge-success">Tayang</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <div
                                                            class="d-flex list-unstyled align-items-center justify-content-center">
                                                            <li>
                                                                <button type="button" class="btn btn-warning btn-sm"
                                                                    title="Ubah" data-aksi="ubah" data-title="Edit Data"
                                                                    data-toggle="modal" data-target="#modalForm"
                                                                    data-id="{{ $row->id }}"
                                                                    data-judul="{{ $row->judul }}"
                                                                    data-info="{{ $row->info }}"
                                                                    data-tampil="{{ $row->tampil }}"
                                                                    data-tanggal="{{ $row->tanggal }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="btn btn-danger btn-sm ml-1"
                                                                    title="Hapus" data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    data-id="{{ $row->id }}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </li>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Konfirmasi -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
        aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-12">
                                <label for="judul">Judul</label>
                            </div>
                            <div class="col-12">
                                <input type="text" name="judul" id="judul" class="form-control"
                                    placeholder="Masukkan judul ..." required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label for="info">Informasi</label>
                            </div>
                            <div class="col-12">
                                <textarea name="info" id="info" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-12">
                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <label for="tampil">Tampil</label>
                            </div>
                            <div class="col-12">
                                <select class="form-control" id="tampil" name="tampil" required>
                                    <option value="Tayang">Tayang</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
