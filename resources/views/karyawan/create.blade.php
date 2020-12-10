@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Karyawan</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Tambah Karyawan</div>
            <div class="ribbon-content">
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#home1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            <i>Input</i> Karyawan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile1" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <i>Upload</i> Karyawan
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="home1">
                        <form role="form" id="frmBagian" method="POST" action="{{ route('karyawan.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-9 col-md-9">
                                    <div class="form-group has-error">
                                        <label for="exampleInputUsername2">Nama Karyawan <code>*</code></label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" autofocus required>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername2">ID SAP <code>*</code></label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group has-error">
                                        <label for="exampleInputUsername2">Golongan <code>*</code></label>
                                        <select name="gol_awal" id="gol_awal" class="form-control select2-multiple" required>
                                            @foreach ($gol as $itemGol)
                                                <option value="{{ $itemGol->nama_golongan }}">{{ $itemGol->nama_golongan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername2">MKG <code>*</code></label>
                                        <select name="mkg_awal" id="mkg_awal" class="form-control select2-multiple" required>
                                            <option value="00">00</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Divisi/Bagian/unitkerja <code>*</code></label>
                                <select name="divisi_id" id="divisi_id" class="form-control select2-multiple" required>
                                    @foreach ($div as $itemDiv)
                                        <option value="{{ $itemDiv->id }}">{{ $itemDiv->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername2">Sub Bagian/Sub Divisi <code>*</code></label>
                                <input type="text" class="form-control" id="sub_bagian" name="sub_bagian" value="{{ old('sub_bagian') }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('karyawan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="profile1">
                        <form role="form" id="frmBagian" method="POST" action="{{ route('karyawan.mass_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Divisi/Bagian/unitkerja <code>*</code></label>
                                <select name="divisi_id" id="divisi_id" class="form-control select2-multiple-upload" required>
                                    <option value="">.:: PILIH DIVISI/BAGIAN/UNITKERJA TERLEBIH DAHULU ::.</option>
                                    @foreach ($div as $itemDiv)
                                        <option value="{{ $itemDiv->id }}">{{ $itemDiv->nama_divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group has-error">
                                <label>Berkas Karyawan</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileKaryawan" name="fileKaryawan" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="header-title">Ketentuan <i>Upload</i> Berkas Karyawan :</h4>
                            <ol>
                                <li>Berkas harus ber-ekstensi : <code>.xls</code> atau <code>.xlsx</code></li>
                                <li>Format pengisian data karyawan sesuai dengan template yang telah disediakan. jika belum mempunyai berkas template, bisa <i>download</i> melalui tombol <i>Download</i> Template Karyawan dibawah ini.</li>
                            </ol>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <i>Upload</i> Karyawan</button>
                                <button type="button" class="btn btn-warning" onclick="location.href='{{ route('karyawan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                                <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('download_template') }}'"><i class="fa fa-save"></i> <i>Download</i> Template Karyawan</button>
                            </div>
                        </form>
                    </div>
                </div>
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
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
@endsection