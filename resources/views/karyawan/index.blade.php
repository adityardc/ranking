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
            <li class="breadcrumb-item active">Karyawan</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
        <form action="{{ route('karyawan.mass_delete', Auth::user()->divisi_id) }}" method="POST" id="frmMassDelete">
            @csrf
            {{ method_field('DELETE') }}
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Data Karyawan</div>
            @can('karyawan-create')
            <button class="btn btn-success btn-rounded waves-effect waves-light btn-sm float-right mt-0" onclick="location.href='{{ route('karyawan.create') }}'"><span class="btn-label"><i class="mdi mdi-file-plus"></i></span>Tambah Data</button> 
            
            {{-- <button class="btn btn-danger btn-rounded waves-effect waves-light btn-sm float-right mt-0" onclick="hapus({{ Auth::user()->divisi_id }})"><span class="btn-label"><i class="mdi mdi-trash-can"></i></span>Hapus Data</button> --}}
            <button class="btn btn-danger btn-rounded waves-effect waves-light btn-sm float-right mt-0" id="btnModalHapus"><span class="btn-label"><i class="mdi mdi-trash-can"></i></span>Hapus Data</button>
            @endcan
            <div class="ribbon-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered responsive" id="tblKaryawan" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID SAP</th>
                                <th>Nama</th>
                                <th>Gol</th>
                                <th>Divisi</th>
                                <th>Sub Divisi</th>
                                @can('karyawan-edit','karyawan-delete')
                                <th>Aksi</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="frmHapusKaryawan">
    <div class="modal fade" id="modalHapusKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Karyawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @csrf

                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Pilih Divisi/Bagian/unitkerja</label>
                        <select name="divisi_id" id="divisi_id" class="form-control" required>
                            @foreach ($div as $itemDiv)
                                <option value="{{ $itemDiv->id }}">{{ $itemDiv->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="btnHapusKaryawan">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>
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
            text: "Anda yakin akan menghapus data Karyawan ini ?",
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

        var t = $('#tblKaryawan').DataTable({
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
            "ajax": '{{ route('karyawan.data') }}',
            "columns": [
                { data: "id", width: "1%", className: "text-center", searchable: false, orderable: false },
                { data: "nik", width: "8%", className: "text-center" },
                { data: "nama", orderable: false },
                { data: "gol", width: "5%", className: "text-center" },
                { data: "divisi.nama_divisi", width: "20%", orderable: false },
                { data: "sub_bagian", width: "20%", orderable: false },
                @can('karyawan-edit','karyawan-delete')
                { data: null, width: "8%", orderable: false, className: "text-center",
                    render: function(data){
                        var delete_button = '<form id="data-'+data.id+'" method="POST" action="'+data.destroy_url+'">{{ csrf_field() }}<input type="hidden" name="_method" value="delete"><a href="'+data.edit_url+'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data"><i class="mdi mdi-lead-pencil"></i></a> <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Data" onclick="draft('+data.id+')"><i class="mdi mdi-trash-can"></i></button></form>';
                        
                        return delete_button;
                    }
                }
                @endcan
            ],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $('body').on('click', '#btnModalHapus', function () {
            $('#modalHapusKaryawan').modal('show');
        });

        $('#btnHapusKaryawan').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#frmHapusKaryawan').serialize(),
                url: "{{ route('karyawan.mass_delete') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#frmHapusKaryawan').trigger("reset");
                    $('#modalHapusKaryawan').modal('hide');
                    Swal.fire({
                        title: 'Berhasil !',
                        text: "Data Karyawan berhasil dihapus.",
                        icon: 'success',
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: 'Oke !'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
