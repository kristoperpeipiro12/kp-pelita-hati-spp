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
            ]
            // , "dom": '<"d-block d-lg-flex justify-content-between"lf<"btn btn-sm"B>r>t<"d-block d-lg-flex justify-content-between"ip>'
            // , "buttons": [{
            //             extend: 'excelHtml5'
            //             , filename: 'Data Siswa - SD Kristen Pelita Hati - update ' +
            //                 tanggalHariIni
            //             , text: 'XLSX'
            //             , exportOptions: {
            //                 columns: [0, 1, 2, 3, 4, 5, 6, 7]
            //                 , stripHtml: true
            //                 , modifier: {
            //                     page: 'current'
            //                 }
            //             }
            //         }
            //         , {
            //             extend: 'pdfHtml5'
            //             , filename: 'Data Siswa - SD Kristen Pelita Hati - update ' +
            //                 tanggalHariIni
            //             , text: 'PDF'
            //             , message: 'Data Siswa - SD Kristen Pelita Hati'
            //             , messageBottom: 'Data dibuat otomatis oleh sistem : ' +
            //                 tanggalHariIni + ' ' + waktuHariIni + ' WIB'
            //             , exportOptions: {
            //                 columns: [0, 1, 2, 3, 4, 5, 6, 7]
            //                 , stripHtml: true
            //                 , modifier: {
            //                     page: 'current'
            //                 }
            //             }
            //             , orientation: 'landscape'
            //             , pageSize: 'LEGAL'
            //             , customize: function(doc) {
            //                 doc.pageMargins = [20, 20, 20, 20];
            //                 doc.defaultStyle.fontSize = 10;
            //                 doc.styles.tableHeader.fontSize = 10;
            //                 doc.styles.title.fontSize = 14;
            //                 doc.content[0].text = doc.content[0].text.trim();
            //                 doc['footer'] = (function(page, pages) {
            //                     return {
            //                         columns: [
            //                             'Data Siswa - SD Kristen Pelita Hati'
            //                             , {
            //                                 alignment: 'right'
            //                                 , text: ['Page ', {
            //                                     text: page
            //                                         .toString()
            //                                 }, ' of ', {
            //                                     text: pages
            //                                         .toString()
            //                                 }]
            //                             }
            //                         ]
            //                         , margin: [10, 0]
            //                     }
            //                 });
            //                 var objLayout = {};
            //                 objLayout['hLineWidth'] = function(i) {
            //                     return .5;
            //                 };
            //                 objLayout['vLineWidth'] = function(i) {
            //                     return .5;
            //                 };
            //                 objLayout['hLineColor'] = function(i) {
            //                     return '#aaa';
            //                 };
            //                 objLayout['vLineColor'] = function(i) {
            //                     return '#aaa';
            //                 };
            //                 objLayout['paddingLeft'] = function(i) {
            //                     return 4;
            //                 };
            //                 objLayout['paddingRight'] = function(i) {
            //                     return 4;
            //                 };
            //                 doc.content[1].layout = objLayout;
            //             }
            //         },

            //     ]
            // , "language": {
            //     url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
            // }
            ,
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
// modalEdit
$('#modalEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var kelas = button.data('kelas')
    var tagihan_perbulan = button.data('tagihan_perbulan')

    var modal = $(this)
    modal.find('.modal-title').text('Edit Tagihan Kelas ' + kelas)
    modal.find('#edit_kelas').val(kelas)
    modal.find('#edit_numberInput').val(tagihan_perbulan)
})
</script>

<!-- DataTable with Hover -->
<div class="container-fluid" id="container-wrapper">
    <div class="col-lg-12">
        <div class="card mb-2">
            <div class="card-header d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tagihan</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tagihan</li>
                    </ol>
                </div>
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Tagihan</h6>
                    <a href="" class="btn btn-info mb-1" data-toggle="modal" data-tanggal="{{ date('Y-m-d') }}"
                        data-target="#modalForm"><i class="fas fa-plus" style="margin-right: 5px;"></i>Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th class="mini-th">No</th> --}}
                                <th>Kelas</th>
                                <th>Nominal Tagihan</th>
                                <th class="text-center mini-">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan as $t)
                            <tr>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $t->kelas }}</td>
                                <td style="width: 80%;">Rp. {{ number_format($t->tagihan_perbulan, 0, ',', '.') }}
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('tagihan.edit', $t->kelas) }}"
                                        class="btn btn-primary btn-sm mr-2"><i class="fas fa-pen-alt"></i></a>
                                    {{-- <button type="button" class="btn btn-warning btn-sm" title="Ubah"
                                                data-aksi="ubah" data-title="Edit Data" data-toggle="modal"
                                                data-target="#modalEdit" data-kelas="{{ $t->kelas }}"
                                    data-tagihan_perbulan="{{ $t->tagihan_perbulan }}">
                                    <i class="fas fa-edit"></i>
                                    </button> --}}
                                    {{-- <a href="" class="btn btn-info mb-1" data-toggle="modal"
                                                data-target="#modalEdit"><i class="fas fa-plus"
                                                    data-kelas="{{ $t->kelas }}"
                                    style="margin-right:
                                    5px;"></i><i class="fas fa-edit"></i></a> --}}
                                    <!-- <button type="button" class="btn btn-warning btn-sm" title="Ubah" data-aksi="ubah"
                                        data-title="Edit Data" data-toggle="modal" data-target="#modalEdit"
                                        data-kelas="{{ $t->kelas }}" data-tagihan_perbulan="{{ $t->tagihan_perbulan }}">
                                        <i class="fas fa-edit"></i>
                                    </button> -->
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

{{-- Modal Tambah --}}
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Tambah Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateForm" method="POST" action="{{ route('tagihan.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="hts-con-form-group">
                        <div class="form-group w-100">
                            <label for="kelas">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="" disabled {{ old('kelas') == '' ? 'selected' : '' }}>-- Pilih
                                    Kelas --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group w-100">
                            <label for="nominal_pemasukan">Nominal Pemasukan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" name="tagihan_perbulan" id="numberInput"
                                    autocomplete="off">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="d-flex w-25" style="gap: 20px">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        <button class="btn btn-secondary w-100" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal edit -->
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST" action="{{ route('tagihan.update',$t->kelas) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="hts-con-form-group">
                        <div class="form-group w-100">
                            <label for="edit_kelas">Kelas</label>
                            <select class="form-control" id="edit_kelas" name="kelas" disabled>
                                <option value="" disabled>-- Pilih Kelas --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group w-100">
                            <label for="edit_nominal_pemasukan">Nominal Pemasukan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control" name="tagihan_perbulan" id="edit_numberInput"
                                    autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex w-25" style="gap: 20px">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        <button class="btn btn-secondary w-100" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="POST" class="d-flex flex-column">
                        @csrf
                        @method('PUT')
                        <div class="hts-con-form-group">
                            <div class="form-group w-100">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas">
                                    <option value="" disabled>-- Pilih Kelas --</option>
                                    <!-- Options will be dynamically added here -->
                                </select>
                            </div>
                            <div class="form-group w-100">
                                <label for="tagihan_perbulan">Nominal Pemasukan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" name="tagihan_perbulan" id="numberInput"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-25" style="gap: 20px">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            <a href="{{ route('tagihan.index') }}" class="btn btn-secondary w-100">Batal</a>
</div>
</form>
</div>
</div>
</div>
</div> --}}
@endsection