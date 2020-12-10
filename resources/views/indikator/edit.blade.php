@extends('layouts.admin')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian Kinerja</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian KPI</a></li>
            <li class="breadcrumb-item active">Ubah Data Penilaian KPI</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Penilaian KPI</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Penilaian KPI</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('indikator.store_indikator', $data->divisi_id) }}">
                    @csrf

                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Perusahaan</label><br>
                                <button type="button" class="btn btn-warning btn-xs"><b>{{ Auth::user()->ptpn->company }}</b></button>
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-5">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Divisi/Bagian/Unitkerja</label><br>
                                <button type="button" class="btn btn-success btn-xs"><b>{{ $data->nama_divisi }}</b></button>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Komoditas</label><br>
                                @foreach ($kat->kategoridivisis as $val)
                                    <button type='button' class='btn btn-primary btn-xs waves-effect waves-light'><b>{{ $val->kategori->nama_kategori }}</b></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group has-error">
                                <label for="exampleInputUsername2">Tahun Penilaian <code>*</code></label>
                                <select name="tahun" id="tahun" class="form-control">
                                    @for($x=$tahun;$x>=2019;$x--)
                                        <option value={{ $x }} {{ ($data->tahun == $x) ? "selected='selected'" : "" }}>{{ $x }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="exampleInputUsername2">Jumlah Karyawan</label><br>
                                <button type='button' class='btn btn-danger btn-xs waves-effect waves-light'><span><b>{{ $data->jml_karyawan }}</b></span></button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-striped table-bordered" id="tblDetail_ba" width="100%">
                        <thead>
                            <th style="width: 1%">#</th>
                            <th>Indikator Penentu</th>
                            <th style="width: 1%;text-align: center">Satuan</th>
                            <th style="width: 17%;text-align: center">RKAPP</th>
                            <th style="width: 17%;text-align: center">Realisasi</th>
                        </thead>
                        <tbody>
                            @foreach ($kpi as $item => $valKpi)
                            <tr>
                                <td>{{ $item+1 }}</td>
                                <td>
                                    {{ $valKpi->nama_kpi }}
                                    <input type="text" name="icon[{{ $valKpi->id }}]" value="{{ $valKpi->icon }}" style="display: none">
                                </td>
                                <td style="text-align: center">
                                    {{ $valKpi->satuan->kode_satuan }}
                                </td>
                                <td>
                                    <input type="text" class="form-control autonumber text-right" data-a-sep="." data-a-dec="," name="rkapp[{{ $valKpi->id }}]" required>
                                </td>
                                </td>
                                <td>
                                    <input type="text" class="form-control autonumber text-right" data-a-sep="." data-a-dec="," name="realisasi[{{ $valKpi->id }}]" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="jml_karyawan" value="{{ $data->jml_karyawan }}"><i class="fa fa-save"></i> SIMPAN</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('indikator.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/input-mask/jquery.inputmask.min.js') }}"></script>
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
        var i = 1;
        $('.select2-multiple').select2();
        $(".autonumber").inputmask({
            'alias': 'decimal',
            rightAlign: true,
            'groupSeparator': '.',
            'autoGroup': true
        });
    });
</script>
@endsection