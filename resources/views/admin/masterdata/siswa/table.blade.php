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
            "dom": '<"d-block d-lg-flex justify-content-between overflow-hidden"lf<"btn btn-sm"B>r>t<"d-block d-lg-flex justify-content-between"ip>',
            "buttons": [{
                        extend: 'excelHtml5',
                        filename: 'Data Siswa - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni,
                        text: 'Export XLSX',
                        className: 'btn bg-success text-white',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            stripHtml: true,
                            modifier: {
                                page: 'current'
                            }
                        }
                    }, {
                        extend: 'pdfHtml5',
                        filename: 'Data Siswa - SD Kristen Pelita Hati - update ' +
                            tanggalHariIni,
                        text: 'Export PDF',
                        className: 'btn bg-danger text-white',
                        message: 'Data Siswa - SD Kristen Pelita Hati',
                        messageBottom: 'Data dibuat otomatis oleh sistem : ' +
                            tanggalHariIni + ' ' + waktuHariIni + ' WIB',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                            stripHtml: true,
                            modifier: {
                                page: 'current'
                            }
                        },
                        orientation: 'landscape',
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
                                        'Data Siswa - SD Kristen Pelita Hati', {
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

                ]
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
