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
            "paging": true
            , "responsive": false
            , "searching": true
            , "deferRender": true
            , "lengthMenu": [
                [10, 25, 50, 100, 500, -1]
                , ['10', '25', '50', '100', '500', 'Semua']
            ]
            , "dom": '<"d-block d-lg-flex justify-content-between"lf<"btn btn-sm"B>r>t<"d-block d-lg-flex justify-content-between"ip>'
            , "buttons": [{
                        extend: 'excelHtml5'
                        , filename: 'Data Siswa Lulus - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni
                        , text: 'XLSX'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            , stripHtml: true
                            , modifier: {
                                page: 'current'
                            }
                        }
                    }
                    , {
                        extend: 'pdfHtml5'
                        , filename: 'Data Siswa Lulus - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni
                        , text: 'PDF'
                        , message: 'Data Siswa Lulus - SD Kristen Pelita Hati'
                        , messageBottom: 'Data dibuat otomatis oleh sistem : ' +
                            tanggalHariIni + ' ' + waktuHariIni + ' WIB'
                        , exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            , stripHtml: true
                            , modifier: {
                                page: 'current'
                            }
                        }
                        , orientation: 'landscape'
                        , pageSize: 'LEGAL'
                        , customize: function(doc) {
                            doc.pageMargins = [20, 20, 20, 20];
                            doc.defaultStyle.fontSize = 10;
                            doc.styles.tableHeader.fontSize = 10;
                            doc.styles.title.fontSize = 14;
                            doc.content[0].text = doc.content[0].text.trim();
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [
                                        'Data Siswa Lulus - SD Kristen Pelita Hati'
                                        , {
                                            alignment: 'right'
                                            , text: ['Page ', {
                                                text: page
                                                    .toString()
                                            }, ' of ', {
                                                text: pages
                                                    .toString()
                                            }]
                                        }
                                    ]
                                    , margin: [10, 0]
                                }
                            });
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['vLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['hLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['vLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['paddingLeft'] = function(i) {
                                return 4;
                            };
                            objLayout['paddingRight'] = function(i) {
                                return 4;
                            };
                            doc.content[1].layout = objLayout;
                        }
                    },

                ]
                // , "language": {
                //     url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                // }
            , "columnDefs": [{
                "searchable": false
                , "orderable": false
                , "targets": 0
            }]
            , "order": [
                [1, 'asc']
            ]

        });

        table.on('order.dt search.dt', function() {
            table.column(0, {
                order: 'applied'
                , search: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#filterJenisKelamin').on('change', function() {
            var selectedJK = $(this).val();
            table.column(5).search(selectedJK).draw();
        });

        $('#filterKelas').on('change', function() {
            var selectedKelas = $(this).val();
            table.column(7).search(selectedKelas).draw();
        });
    });

</script>


<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Data Siswa Lulus</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Master Data</li>
                            <li class="breadcrumb-item active" aria-current="page">Siswa Lulus</li>
                        </ol>
                    </div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-2 pt-3">
                            <div class="form-group d-flex align-items-center">
                                <label for="filterJenisKelamin" class="d-flex align-items-center mt-2 mr-2">Jenis Kelamin</label>
                                <select id="filterJenisKelamin" class="form-control form-control-sm" style="width: 120px;">
                                    <option value="">Semua</option>
                                    @php
                                    $jkList = ['Laki-laki', 'Perempuan'];
                                    @endphp
                                    @foreach ($jkList as $jk)
                                    <option value="{{ $jk }}">{{ $jk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8"></div>

                        <div class="col-lg-2 text-right">
                            <a href="{{ route('admin.siswa.hapus-lulus') }}" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Hapus Data
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-hover" id="dataTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="mini-th">No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No HP</th>
                                            <th class="mini-th">Status</th>
                                            <th class="text-center mini-th">Foto</th>
                                            <th class="text-center mini-th">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswaLulus as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nis }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                                            <td>{{ $item->jenis_kelamin }}</td>
                                            <td>{{ $item->nohp }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td><img src="{{ (empty($item->foto)) ? '' : asset('storage/foto-siswa/' . $item->foto) }}" alt="" width="65"></td>
                                            <td class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal{{ $item->nis }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal{{ $item->nis }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('admin.siswa.hapus-lulus-nis', $item->nis) }}" method="POST">
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

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection
