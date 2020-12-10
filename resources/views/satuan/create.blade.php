@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Satuan Indikator</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Satuan Indikator</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Tambah Data Satuan Indikator</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('satuan.store') }}">
                    @csrf

                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Kode Satuan <code>*</code></label>
                        <input type="text" class="form-control" id="kode_satuan" name="kode_satuan" value="{{ old('kode_satuan') }}" autofocus required>
                    </div>
                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Deskripsi <code>*</code></label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('satuan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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