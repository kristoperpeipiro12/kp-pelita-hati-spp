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
                    , filename: 'Data Pemasukan - SD Kristen Pelita Hati - update ' +
                        tanggalHariIni
                    , text: 'Export XLSX'
                    , exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                        , stripHtml: true
                        , modifier: {
                            page: 'current'
                        }
                    }
                }
                , {
                    extend: 'pdfHtml5'
                    , filename: 'Data Pemasukan - SD Kristen Pelita Hati - update ' +
                        tanggalHariIni
                    , text: 'Export PDF'
                    , message: 'Data Pemasukan - SD Kristen Pelita Hati'
                    , messageBottom: 'Data dibuat otomatis oleh sistem : ' +
                        tanggalHariIni + ' ' + waktuHariIni + ' WIB'
                    , exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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
                                    'Data Pemasukan - SD Kristen Pelita Hati'
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Pemasukan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Pemasukan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pemasukan</li>
                        </ol>
                    </div>
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-2 pt-3">
                            <div class="form-group d-flex align-items-center">
                                <label for="filterJenisTransaksi" class="d-flex align-items-center mt-2 mr-2">Jenis Transaksi</label>
                                <select id="filterJenisTransaksi" class="form-control form-control-sm" style="width: 120px;">
                                    <option value="">Semua</option>
                                    @php
                                    $jenisTransferList = ['Kontan', 'Transfer'];
                                    @endphp
                                    @foreach ($jenisTransferList as $jenisTF)
                                    <option value="{{ $jenisTF }}">
                                        {{ $jenisTF }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7"></div>

                        <div class="col-lg-1">
                            <a href="{{ route('pemasukan.create') }}" class="btn btn-info">
                                <i class="fas fa-plus mr-2"></i>Tambah
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush table-hover" style="" id="dataTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="mini-th">No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Periode Pembayaran</th>
                                            <th>Jumlah Bayar (Rp)</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Status</th>
                                            <th>Foto Bukti</th>
                                            <th class="text-center mini-th">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemasukan as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nis }}</td>
                                            <td>{{ optional($p->siswa)->nama }}</td>
                                            <td>{{ optional($p->siswa)->kelas }}</td>
                                            <td>{{ $p->bulan_tagihan }}/{{ $p->tahun_tagihan }}</td>
                                            <td>Rp. {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_bayar)->format('d-m-Y') }}</td>
                                            <td>{{ $p->jenis_transaksi}}</td>
                                            <td class="d-flex justify-content-center">
                                                @if ($p->konfirmasi == "Pending")
                                                <a href="{{ route('pemasukan.konfirmasi.terima', $p->id) }}" class="btn btn-success btn-sm mr-2">
                                                    <i class="fas "></i>
                                                </a>
                                                <a href="{{ route('pemasukan.konfirmasi.tolak', $p->id) }}" class="btn btn-success btn-sm mr-2">
                                                    <i class="fas "></i>
                                                </a>
                                                @else
                                                    {{ $p->konfirmasi }}
                                                @endif
                                            </td>
                                            <td><img src="{{ (empty($p->foto)) ? '' : asset('storage/bukti/' . $p->foto) }}" alt="" width="65"></td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('pemasukan.edit', $p->id) }}" class="btn btn-primary btn-sm mr-2">
                                                    <i class="fas fa-pen-alt"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#deleteModal{{ $p->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <form action="{{ route('pemasukan.delete', $p->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
