@extends('layouts.admin')

@section('css')
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Manajemen Master Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Distribusi Penilaian</a></li>
            <li class="breadcrumb-item active">Ubah Data</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Distribusi Penilaian</h4>
<div class="row">
    <div class="col-lg-9">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Form Ubah Distribusi Penilaian</div>
            <div class="ribbon-content">
                <form role="form" id="frmBagian" method="POST" action="{{ route('penilaian_karya.update', $data->first()->ptpn->id) }}">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="exampleInputUsername2">Perusahaan</label>
                        <input type="text" class="form-control" value="{{ $ptpn }}" disabled>
                    </div>
                    <table class="table table-hover table-striped table-bordered" id="tblDetail_ba" width="100%">
                        <thead>
                            <th colspan="7" style="text-align: center">DISTRIBUSI PENILAIAN</th>
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
                                <td style="width: 11%"><input type="number" name="tetap_kurang_min" class="form-control" min="0" max="100" value="{{ $data[0]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_kurang_max" class="form-control" min="0" max="100" value="{{ $data[0]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_sama_min" class="form-control" min="0" max="100" value="{{ $data[1]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_sama_max" class="form-control" min="0" max="100" value="{{ $data[1]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_lebih_min" class="form-control" min="0" max="100" value="{{ $data[2]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="tetap_lebih_max" class="form-control" min="0" max="100" value="{{ $data[2]->max }}" required></td>
                            </tr>
                            <tr>
                                <td>I BERKALA</td>
                                <td style="width: 11%"><input type="number" name="berkala_1_kurang_min" class="form-control" min="0" max="100" value="{{ $data[3]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_kurang_max" class="form-control" min="0" max="100" value="{{ $data[3]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_sama_min" class="form-control" min="0" max="100" value="{{ $data[4]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_sama_max" class="form-control" min="0" max="100" value="{{ $data[4]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_lebih_min" class="form-control" min="0" max="100" value="{{ $data[5]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_1_lebih_max" class="form-control" min="0" max="100" value="{{ $data[5]->max }}" required></td>
                            </tr>
                            <tr>
                                <td>II BERKALA</td>
                                <td style="width: 11%"><input type="number" name="berkala_2_kurang_min" class="form-control" min="0" max="100" value="{{ $data[6]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_kurang_max" class="form-control" min="0" max="100" value="{{ $data[6]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_sama_min" class="form-control" min="0" max="100" value="{{ $data[7]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_sama_max" class="form-control" min="0" max="100" value="{{ $data[7]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_lebih_min" class="form-control" min="0" max="100" value="{{ $data[8]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="berkala_2_lebih_max" class="form-control" min="0" max="100" value="{{ $data[8]->max }}" required></td>
                            </tr>
                            <tr>
                                <td>NAIK GOLONGAN NORMAL</td>
                                <td style="width: 11%"><input type="number" name="naik_normal_kurang_min" class="form-control" min="0" max="100" value="{{ $data[9]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_kurang_max" class="form-control" min="0" max="100" value="{{ $data[9]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_sama_min" class="form-control" min="0" max="100" value="{{ $data[10]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_sama_max" class="form-control" min="0" max="100" value="{{ $data[10]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_lebih_min" class="form-control" min="0" max="100" value="{{ $data[11]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_normal_lebih_max" class="form-control" min="0" max="100" value="{{ $data[11]->max }}" required></td>
                            </tr>
                            <tr>
                                <td>NAIK GOLONGAN ISTIMEWA</td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_kurang_min" class="form-control" min="0" max="100" value="{{ $data[12]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_kurang_max" class="form-control" min="0" max="100" value="{{ $data[12]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_sama_min" class="form-control" min="0" max="100" value="{{ $data[13]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_sama_max" class="form-control" min="0" max="100" value="{{ $data[13]->max }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_lebih_min" class="form-control" min="0" max="100" value="{{ $data[14]->min }}" required></td>
                                <td style="width: 11%"><input type="number" name="naik_istimewa_lebih_max" class="form-control" min="0" max="100" value="{{ $data[14]->max }}" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> UBAH</button>
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