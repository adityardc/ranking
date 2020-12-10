@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian Karya</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Penilaian Karya</h4>
<div class="row">
    <div class="col-lg-9">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Tambah Penilaian Karya</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('penilaian_karya.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername2">Perusahaan</label>
                        <select name="ptpn_id" id="ptpn_id" class="form-control select2-multiple" required>
                            @foreach ($ptpn as $item)
                                <option value="{{ $item->id }}" {{ (old('ptpn_id') == $item->id) ? "selected='selected'" : "" }}>{{ $item->company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-hover table-striped table-bordered" id="tblDetail_ba" width="100%">
                        <thead>
                            <th colspan="7" style="text-align: center">PENILAIAN KARYA</th>
                        </thead>
                        <tbody>
                            <tr style="text-align: center">
                                <td rowspan="2" style="vertical-align: middle">PENILAIAN KARYA</td>
                                <td colspan="2">< RKAP</td>
                                <td colspan="2">= RKAP >= 10 %</td>
                                <td colspan="2">> 10 %</td>
                            </tr>
                            <tr style="text-align: center">
                                <td>MIN (%)</td>
                                <td>MAX (%)</td>
                                <td>MIN (%)</td>
                                <td>MAX (%)</td>
                                <td>MIN (%)</td>
                                <td>MAX (%)</td>
                            </tr>
                            <tr>
                                <td>TETAP</td>
                                <td style="width: 11%"><input type="number" name="tetap_kurang_min" class="form-control" min="0" max="100" value="{{ old('tetap_kurang_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_kurang_max" class="form-control" min="0" max="100" value="{{ old('tetap_kurang_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_sama_min" class="form-control" min="0" max="100" value="{{ old('tetap_sama_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_sama_max" class="form-control" min="0" max="100" value="{{ old('tetap_sama_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_lebih_min" class="form-control" min="0" max="100" value="{{ old('tetap_lebih_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_lebih_max" class="form-control" min="0" max="100" value="{{ old('tetap_lebih_max') }}" required></td>
                            </tr>
                            <tr>
                                <td>I BERKALA</td>
                                <td style="width: 11%"><input type="number" name="berkala_1_kurang_min" class="form-control" min="0" max="100" value="{{ old('berkala_1_kurang_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_kurang_max" class="form-control" min="0" max="100" value="{{ old('berkala_1_kurang_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_sama_min" class="form-control" min="0" max="100" value="{{ old('berkala_1_sama_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_sama_max" class="form-control" min="0" max="100" value="{{ old('berkala_1_sama_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_lebih_min" class="form-control" min="0" max="100" value="{{ old('berkala_1_lebih_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_lebih_max" class="form-control" min="0" max="100" value="{{ old('berkala_1_lebih_max') }}" required></td>
                            </tr>
                            <tr>
                                <td>II BERKALA</td>
                                <td style="width: 11%"><input type="number" name="berkala_2_kurang_min" class="form-control" min="0" max="100" value="{{ old('berkala_2_kurang_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_kurang_max" class="form-control" min="0" max="100" value="{{ old('berkala_2_kurang_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_sama_min" class="form-control" min="0" max="100" value="{{ old('berkala_2_sama_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_sama_max" class="form-control" min="0" max="100" value="{{ old('berkala_2_sama_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_lebih_min" class="form-control" min="0" max="100" value="{{ old('berkala_2_lebih_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_lebih_max" class="form-control" min="0" max="100" value="{{ old('berkala_2_lebih_max') }}" required></td>
                            </tr>
                            <tr>
                                <td>NAIK GOLONGAN NORMAL</td>
                                <td style="width: 11%"><input type="number" name="naik_normal_kurang_min" class="form-control" min="0" max="100" value="{{ old('naik_normal_kurang_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_kurang_max" class="form-control" min="0" max="100" value="{{ old('naik_normal_kurang_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_sama_min" class="form-control" min="0" max="100" value="{{ old('naik_normal_sama_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_sama_max" class="form-control" min="0" max="100" value="{{ old('naik_normal_sama_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_lebih_min" class="form-control" min="0" max="100" value="{{ old('naik_normal_lebih_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_lebih_max" class="form-control" min="0" max="100" value="{{ old('naik_normal_lebih_max') }}" required></td>
                            </tr>
                            <tr>
                                <td>NAIK GOLONGAN ISTIMEWA</td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_kurang_min" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_kurang_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_kurang_max" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_kurang_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_sama_min" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_sama_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_sama_max" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_sama_max') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_lebih_min" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_lebih_min') }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_lebih_max" class="form-control" min="0" max="100" value="{{ old('naik_istimewa_lebih_max') }}" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> SIMPAN</button>
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('penilaian_karya.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
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