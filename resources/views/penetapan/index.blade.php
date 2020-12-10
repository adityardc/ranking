@extends('layouts.admin')

@section('css')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian Kinerja</a></li>
            <li class="breadcrumb-item active">Sidang Komite/Penetapan Penilaian Karyawan</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Sidang Komite/Penetapan Penilaian Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Data Sidang Komite/Penetapan Penilaian Karyawan</div>
            <div class="ribbon-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered responsive" id="tblDivisi" width="100%">
                        <thead style="text-align: center">
                            <tr>
                                <th>#</th>
                                <th>Perusahaan</th>
                                <th>Divisi</th>
                                <th>Tahun Penilaian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="full-width-modalLabel">Tabel Data Penetapan Distribusi Penilaian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript">
    function htmlDecode(data){
        var txt = document.createElement('textarea');
        txt.innerHTML = data;
        return txt.value;
    }

    function batal(){
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Anda yakin akan membatalkan usulan penilaian karyawan ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak, batalkan !',
            confirmButtonText: 'Ya, saya yakin !'
        }).then((result) => {
            if (result.value) {
                $('#frmBatal').submit();
            }
        });
    }

    $('body').on('click', '.detail_distribusi', function(event){
        event.preventDefault();

        var me = $(this);
        var url = me.attr('href');

        $.ajax({
            url: url,
            dataType: 'html',
            success: function(data){
                $('#modalContent').html(data);
            }
        });

        $('#full-width-modal').modal('show');
    });

    $(document).ready(function(){
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $('#tblDivisi').DataTable({
            initComplete: function() {
                var api = this.api();
                $('#tblDivisi_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            "processing": true,
            "serverSide": true,
            "ajax": '{{ route('penetapan.data') }}',
            "columns": [
                { data: "indikator_id", width: "1%", className: "text-center", searchable: false, orderable: false },
                { data: "company", width: "30%", orderable: false },
                { data: "nama_divisi", width: "30%", className: "text-center", orderable: false },
                { data: "tahun", width: "10%", className: "text-center", orderable: false },
                { data: "status", width: "1%", orderable: false, className: "text-center",
                    render: function(data){
                        return htmlDecode(data);
                    }
                },
                { data: "tombol", width: "10%", orderable: false, className: "text-center",
                    render: function(data){
                        return htmlDecode(data);
                    }
                }
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>
@endsection
