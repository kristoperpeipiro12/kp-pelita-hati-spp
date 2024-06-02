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
                // , "dom": '<"d-block d-lg-flex justify-content-between"lf<"btn btn-sm"B>r>t<"d-block d-lg-flex justify-content-between"ip>'
                // , "buttons": [{
                //         extend: 'excelHtml5'
                //         , filename: 'Data Pengeluaran - SD Kristen Pelita Hati - update ' +
                //             tanggalHariIni
                //         , text: 'Export XLSX'
                //         , exportOptions: {
                //             columns: [0, 1, 2, 3, 4]
                //             , stripHtml: true
                //             , modifier: {
                //                 page: 'current'
                //             }
                //         }
                //     }
                //     , {
                //         extend: 'pdfHtml5'
                //         , filename: 'Data Pengeluaran - SD Kristen Pelita Hati - update ' +
                //             tanggalHariIni
                //         , text: 'Export PDF'
                //         , message: 'Data Pengeluaran - SD Kristen Pelita Hati'
                //         , messageBottom: 'Data dibuat otomatis oleh sistem : ' +
                //             tanggalHariIni + ' ' + waktuHariIni + ' WIB'
                //         , exportOptions: {
                //             columns: [0, 1, 2, 3, 4]
                //             , stripHtml: true
                //             , modifier: {
                //                 page: 'current'
                //             }
                //         }
                //         , orientation: 'portrait'
                //         , pageSize: 'LEGAL'
                //         , customize: function(doc) {
                //             doc.pageMargins = [20, 20, 20, 20];
                //             doc.defaultStyle.fontSize = 10;
                //             doc.styles.tableHeader.fontSize = 10;
                //             doc.styles.title.fontSize = 14;
                //             doc.content[0].text = doc.content[0].text.trim();
                //             doc['footer'] = (function(page, pages) {
                //                 return {
                //                     columns: [
                //                         'Data Pengeluaran - SD Kristen Pelita Hati'
                //                         , {
                //                             alignment: 'right'
                //                             , text: ['Page ', {
                //                                 text: page
                //                                     .toString()
                //                             }, ' of ', {
                //                                 text: pages
                //                                     .toString()
                //                             }]
                //                         }
                //                     ]
                //                     , margin: [10, 0]
                //                 }
                //             });
                //             var objLayout = {};
                //             objLayout['hLineWidth'] = function(i) {
                //                 return .5;
                //             };
                //             objLayout['vLineWidth'] = function(i) {
                //                 return .5;
                //             };
                //             objLayout['hLineColor'] = function(i) {
                //                 return '#aaa';
                //             };
                //             objLayout['vLineColor'] = function(i) {
                //                 return '#aaa';
                //             };
                //             objLayout['paddingLeft'] = function(i) {
                //                 return 4;
                //             };
                //             objLayout['paddingRight'] = function(i) {
                //                 return 4;
                //             };
                //             doc.content[1].layout = objLayout;
                //         }
                //     },

                // ]
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

        $('#filterJenisTransaksi').on('change', function() {
            var selectedJenisTransaksi = $(this).val();
            table.column(5).search(selectedJenisTransaksi).draw();
        });
    });

</script>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemasukan</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Yayasan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pemasukan</li>
        </ol>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Daftar Pemasukan</h6> --}}


            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="mini-th">No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pemasukan(Rp)</th>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemasukan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nis }}</td>
                            <td>{{ $p->siswa->nama }}</td>
                            <td>{{ $p->siswa->kelas }}</td>
                            <td>Rp. {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $p->jenis_transaksi}}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
