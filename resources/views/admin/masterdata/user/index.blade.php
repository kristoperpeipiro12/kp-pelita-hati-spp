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
    </script>

    <div class="container-fluid" id="container-wrapper">


        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Pengguna</li>
                        </ol>
                    </div>
                    <div class="d-flex w-100 justify-content-end mb-4">
                        <a href="{{ route('user.create') }}" class="btn btn-info mb-1"><i class="fas fa-plus"
                                style="margin-right: 5px;"></i>Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="width: 40%;">{{ $item->username }}</td>
                                        <td>{{ $item->role }}</td>

                                        <td>
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-sm"><i
                                                    class="fas fa-pen-alt"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
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
       <!-- Modal Delete -->
       <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                           Konfirmasi Hapus
                           Data</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       Apakah Anda yakin ingin menghapus data ini?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                       <form action="{{ route('user.delete', $item->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger">Hapus</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
       <!-- End Modal Delete -->

@endsection
