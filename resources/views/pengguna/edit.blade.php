@extends('layouts.admin')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pengguna Aplikasi</a></li>
            <li class="breadcrumb-item active">Ubah Pengguna Aplikasi</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Pengguna Aplikasi</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Pengguna Aplikasi</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('pengguna.update', $user->uuid) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Nama Pengguna Aplikasi <code>*</code></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" autofocus required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Alamat Email <code>*</code></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">ID SAP / Username <code>*</code></label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Perusahaan <code>*</code></label>
                        <select name="ptpn_id" id="ptpn_id" class="form-control select2-multiple" required>
                            <option value="">.:: PILIH PERUSAHAAN TERLEBIH DAHULU ::.</option>
                            @foreach ($ptpn as $valPtpn)
                                <option value="{{ $valPtpn->id }}" {{ ($user->ptpn_id == $valPtpn->id) ? "selected='selected'" : "" }}>{{ $valPtpn->company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Divisi/Bagian/Unitkerja <code>*</code></label>
                        {{-- <select name="divisi_id" id="divisi_id" class="form-control select2-multiple" required>
                            @foreach ($divisi as $valDivisi)
                                <option value="{{ $valDivisi->id }}">{{ $valDivisi->nama_divisi }}</option>
                            @endforeach
                        </select> --}}
                        <select name="divisi_id" id="divisi_id" class="form-control select2-multiple" required>
                            <option value="{{ $user->divisi_id }}">{{ $user->divisi->nama_divisi }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Role Aplikasi <code>*</code></label>
                        <select name="roles[]" multiple="multiple" id="roles" class="select2-multiple form-control" required>
                            @foreach ($roles as $val)
                                <option value="{{ $val }}" {{ (in_array($val, $userRole)) ? "selected='selected'" : "" }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('pengguna.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrapValidator.js') }}"></script>
<script>
    // Function mencegah submit form dari tombol enter
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
    }
    document.onkeypress = stopRKey;

    $(document).ready(function(){
        $('.select2-multiple').select2();

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#ptpn_id').on('change', function(){
            $.post('{{ URL::to('pengguna/dataBagian') }}', {_token: $('meta[name="csrf-token"]').attr('content'), id: $(this).val()}, function(e){
                $('#divisi_id').html(e);
            });
        });
    });
</script>
@endsection