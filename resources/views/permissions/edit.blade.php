@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Permissions</a></li>
            <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Permissions</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Permissions</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('permissions.update', $data->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-sm-9 col-md-9">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Nama Permissions <code>*</code></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('permissions.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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
<script type="text/javascript" src="{{ asset('js/bootstrapValidator.js') }}"></script>
<script>
    // Function mencegah submit form dari tombol enter
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
    }
    document.onkeypress = stopRKey;
</script>
@endsection