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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item active">Permissions</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Permissions</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Data Permissions</div>
            <button class="btn btn-success btn-rounded waves-effect waves-light btn-sm float-right mt-0" onclick="location.href='{{ route('permissions.create') }}'"><span class="btn-label"><i class="mdi mdi-file-plus"></i></span>Tambah Data</button>
            <div class="ribbon-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered responsive" id="tblDivisi" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Permissions</th>
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

    function draft(id){
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Anda yakin akan menghapus data Permissions ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak, batalkan !',
            confirmButtonText: 'Ya, saya yakin !'
        }).then((result) => {
            if (result.value) {
                $('#data-'+id).submit();
            }
        });
    }

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
            "ajax": '{{ route('permissions.data') }}',
            "columns": [
                { data: "id", width: "1%", className: "text-center", searchable: false, orderable: false },
                { data: "name", orderable: false },
                { data: null, width: "1%", orderable: false, className: "text-center",
                    render: function(data){
                        var delete_button = '<a href="'+data.edit_url+'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data"><i class="mdi mdi-lead-pencil"></i></a>';
                        
                        return delete_button;
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
