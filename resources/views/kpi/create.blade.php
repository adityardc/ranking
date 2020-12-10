@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Indikator KPI</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Indikator KPI</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Tambah Indikator KPI</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('kpi.store') }}">
                    @csrf
                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Nama KPI <code>*</code></label>
                        <textarea name="nama_kpi" id="nama_kpi" cols="30" rows="5" class="form-control" required autofocus></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Satuan Indikator</label>
                                <select name="satuan_id" id="satuan_id" class="form-control select2-multiple" required>
                                    <option value="">.:: PILIH SATUAN INDIKATOR ::.</option>
                                    @foreach ($sat as $itemSat)
                                        <option value="{{ $itemSat->id }}">{{ $itemSat->kode_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Komoditas</label>
                                <select name="kategori_id" id="kategori_id" class="form-control select2-multiple" required>
                                    <option value="">.:: PILIH KOMODITAS ::.</option>
                                    @foreach ($kat as $itemKat)
                                        <option value="{{ $itemKat->id }}">{{ $itemKat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Icon</label>
                        <select name="icon" id="icon" class="form-control" required>
                            <option value="">.:: PILIH ICON ::.</option>
                            <option value="0">SEMAKIN NAIK SEMAKIN BAIK</option>
                            <option value="1">SEMAKIN TURUN SEMAKIN BAIK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('kpi.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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