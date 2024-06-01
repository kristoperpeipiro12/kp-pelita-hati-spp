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
                "dom": '<"d-block d-lg-flex justify-content-between"lf<"btn btn-sm"B>r>t<"d-block d-lg-flex justify-content-between"ip>',
                "buttons": [{
                        extend: 'excelHtml5',
                        filename: 'Data Pengeluaran - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni,
                        text: 'Export XLSX',
                        className: 'btn bg-success text-white',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                            stripHtml: true,
                            modifier: {
                                page: 'current'
                            }
                        }
                    }, {
                        extend: 'pdfHtml5',
                        filename: 'Data Pengeluaran - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni,
                        text: 'Export PDF',
                        className: 'btn bg-danger text-white',
                        message: 'Data Pengeluaran - SD Kristen Pelita Hati',
                        messageBottom: 'Data dibuat otomatis oleh sistem : ' +
                            tanggalHariIni + ' ' + waktuHariIni + ' WIB',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                            stripHtml: true,
                            modifier: {
                                page: 'current'
                            }
                        },
                        orientation: 'portrait',
                        pageSize: 'LEGAL',
                        customize: function(doc) {
                            doc.pageMargins = [20, 20, 20, 20];
                            doc.defaultStyle.fontSize = 10;
                            doc.styles.tableHeader.fontSize = 10;
                            doc.styles.title.fontSize = 14;
                            doc.content[0].text = doc.content[0].text.trim();
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [
                                        'Data Pengeluaran - SD Kristen Pelita Hati', {
                                            alignment: 'right',
                                            text: ['Page ', {
                                                text: page
                                                    .toString()
                                            }, ' of ', {
                                                text: pages
                                                    .toString()
                                            }]
                                        }
                                    ],
                                    margin: [10, 0]
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

            $('#filterJenisTransaksi').on('change', function() {
                var selectedJenisTransaksi = $(this).val();
                table.column(5).search(selectedJenisTransaksi).draw();
            });
        });
    </script>

    <div class="container-fluid" id="container-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="h3 mb-0 text-gray-800">Pengeluaran</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item"><a href="#">Pengeluaran</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pengeluaran</li>
                            </ol>
                        </div>

                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-11"></div>
                            <div class="col-lg-1">
                                <a href="{{ route('pengeluaran.create') }}" class="btn btn-info">
                                    <i class="fas fa-plus mr-2"></i>Tambah
                                </a>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush table-hover" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="mini-th">No</th>
                                                <th>Nama</th>
                                                <th>Pengeluaran(Rp)</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th class="text-center mini-th">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengeluaran as $keluar)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Auth::user()->username }}</td>
                                                    <td>Rp. {{ number_format($keluar->pengeluaran, 0, ',', '.') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($keluar->tanggal)->format('d-m-Y') }}</td>
                                                    <td>{{ $keluar->keterangan }}</td>
                                                    <td class="d-flex justify-content-center">
                                                        <a href="{{ route('pengeluaran.edit', $keluar->id_pengeluaran) }}"
                                                            class="btn btn-primary btn-sm mr-2"><i
                                                                class="fas fa-pen-alt"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm ml-2"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $keluar->id_pengeluaran }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="deleteModal{{ $keluar->id_pengeluaran }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                </h5>
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
                                                                <form
                                                                    action="{{ route('pengeluaran.delete', $keluar->id_pengeluaran) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
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
