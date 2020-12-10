@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Role Pengguna</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Role Pengguna</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Tambah Role Pengguna</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('role.store') }}">
                    @csrf
                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Nama Role <code>*</code></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Permissions <code>*</code></label>
                        <select class="select2-multiple form-control" name="permission[]" multiple="multiple" required>
                            @foreach ($permission as $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('role.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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
    });
</script>
@endsection