@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Karyawan</a></li>
            <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Karyawan</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('karyawan.update', $karyawan->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-sm-9 col-md-9">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Nama Karyawan <code>*</code></label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $karyawan->nama }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="exampleInputUsername2">ID SAP <code>*</code></label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ $karyawan->nik }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Golongan <code>*</code></label>
                                <select name="gol_awal" id="gol_awal" class="form-control select2-multiple" required>
                                    @foreach ($gol as $itemGol)
                                        <option value="{{ $itemGol->nama_golongan }}" {{ ($itemGol->nama_golongan == $karyawan->gol_awal) ? "selected='selected'" : "" }}>{{ $itemGol->nama_golongan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputUsername2">MKG <code>*</code></label>
                                <select name="mkg_awal" id="mkg_awal" class="form-control select2-multiple" required>
                                    <option value="00" {{ ($karyawan->mkg_awal == "00") ? "selected='selected'" : "" }}>00</option>
                                    <option value="01" {{ ($karyawan->mkg_awal == "01") ? "selected='selected'" : "" }}>01</option>
                                    <option value="02" {{ ($karyawan->mkg_awal == "02") ? "selected='selected'" : "" }}>02</option>
                                    <option value="03" {{ ($karyawan->mkg_awal == "03") ? "selected='selected'" : "" }}>03</option>
                                    <option value="04" {{ ($karyawan->mkg_awal == "04") ? "selected='selected'" : "" }}>04</option>
                                    <option value="05" {{ ($karyawan->mkg_awal == "05") ? "selected='selected'" : "" }}>05</option>
                                    <option value="06" {{ ($karyawan->mkg_awal == "06") ? "selected='selected'" : "" }}>06</option>
                                    <option value="07" {{ ($karyawan->mkg_awal == "07") ? "selected='selected'" : "" }}>07</option>
                                    <option value="08" {{ ($karyawan->mkg_awal == "08") ? "selected='selected'" : "" }}>08</option>
                                    <option value="09" {{ ($karyawan->mkg_awal == "09") ? "selected='selected'" : "" }}>09</option>
                                    <option value="10" {{ ($karyawan->mkg_awal == "10") ? "selected='selected'" : "" }}>10</option>
                                    <option value="11" {{ ($karyawan->mkg_awal == "11") ? "selected='selected'" : "" }}>11</option>
                                    <option value="12" {{ ($karyawan->mkg_awal == "12") ? "selected='selected'" : "" }}>12</option>
                                    <option value="13" {{ ($karyawan->mkg_awal == "13") ? "selected='selected'" : "" }}>13</option>
                                    <option value="14" {{ ($karyawan->mkg_awal == "14") ? "selected='selected'" : "" }}>14</option>
                                    <option value="15" {{ ($karyawan->mkg_awal == "15") ? "selected='selected'" : "" }}>15</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-error">
                        <label for="exampleInputUsername2">Divisi/Bagian/unitkerja <code>*</code></label>
                        <select name="divisi_id" id="divisi_id" class="form-control select2-multiple-upload" required>
                            @foreach ($div as $itemDiv)
                                <option value="{{ $itemDiv->id }}" {{ ($karyawan->divisi_id == $itemDiv->id) ? "selected='selected'" : "" }}>{{ $itemDiv->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername2">Sub Bagian/Sub Divisi <code>*</code></label>
                        <input type="text" class="form-control" id="sub_bagian" name="sub_bagian" value="{{ $karyawan->sub_bagian }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('karyawan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
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