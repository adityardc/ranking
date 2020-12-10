@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Divisi</a></li>
            <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Divisi</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Divisi</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('divisi.update', $divisi->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                    
                    <div class="row">
                        <div class="col-sm-9 col-md-9">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Nama Divisi <code>*</code></label>
                                <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" value="{{ $divisi->nama_divisi }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Kode Divisi <code>*</code></label>
                                <input type="text" class="form-control" id="kode_divisi" name="kode_divisi" value="{{ $divisi->kode_divisi }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Perusahaan</label>
                        <select name="ptpn_id" id="ptpn_id" class="form-control select2-multiple" required>
                            @foreach ($ptpn as $item)
                                <option value="{{ $item->id }}" {{ ($divisi->ptpn_id == $item->id) ? "selected='selected'" : "" }}>{{ $item->company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Komoditas</label>
                        <select name="komoditas[]" id="komoditas" class="form-control select2-multiple" multiple="multiple" required>
                            @foreach ($kat as $val)
                                <option value="{{ $val->id }}" {{ (in_array($val->id, $userRole)) ? "selected='selected'" : "" }}>{{ $val->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('divisi.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
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