@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian Kinerja</a></li>
            <li class="breadcrumb-item active">Sidang Komite/Penetapan Penilaian Karyawan</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Sidang Komite/Penetapan Penilaian Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box ribbon-box">
                <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Hasil Sidang Komite/ Penetapan Penilaian Karyawan</div>
                <div class="ribbon-content">
                    <table class="table table-bordered">
                        <tr>
                            <td class="table-danger" style="width: 20%;text-align: center" colspan="2">
                                <b>TETAP</b>
                            </td>
                            <td class="table-warning" style="width: 20%;text-align: center" colspan="2">
                                <b>BERKALA I</b>
                            </td>
                            <td class="table-secondary" style="width: 20%;text-align: center" colspan="2">
                                <b>BERKALA II</b>
                            </td>
                            <td class="table-primary" style="width: 20%;text-align: center" colspan="2">
                                <b>NAIK GOLONGAN NORMAL</b>
                            </td>
                            <td class="table-success" style="width: 20%;text-align: center" colspan="2">
                                <b>NAIK GOLONGAN ISTIMEWA</b>
                            </td>
                        </tr>
                        <tr style="text-align: center">
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_tetap < $data[0]->min_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 < $data[0]->min_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MIN : {{ $data[0]->min_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_tetap > $data[0]->max_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 > $data[0]->max_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MAX : {{ $data[0]->max_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_berkala_i < $data[1]->min_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 < $data[1]->min_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MIN : {{ $data[1]->min_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_berkala_i > $data[1]->max_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 > $data[1]->max_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MAX : {{ $data[1]->max_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_berkala_ii < $data[2]->min_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 < $data[2]->min_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MIN : {{ $data[2]->min_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_berkala_ii > $data[2]->max_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 > $data[2]->max_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MAX : {{ $data[2]->max_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_normal < $data[3]->min_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 < $data[3]->min_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MIN : {{ $data[3]->min_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_normal > $data[3]->max_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 > $data[3]->max_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MAX : {{ $data[3]->max_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_istimewa < $data[4]->min_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 < $data[4]->min_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MIN : {{ $data[4]->min_orang }} org
                            </td>
                            <td @if ($rekap != NULL)
                                {!! ($rekap->final_istimewa > $data[4]->max_orang) ? "class='table-danger'" : "" !!}
                                @else
                                {!! (0 > $data[4]->max_orang) ? "class='table-danger'" : "" !!}
                                @endif
                            >
                                MAX : {{ $data[4]->max_orang }} org
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->final_tetap : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->final_berkala_i : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->final_berkala_ii : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->final_normal : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->final_istimewa : 0 }}</b></td>
                        </tr>
                        <tr style="text-align: center">
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->final_karpim_tetap : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->final_karpel_tetap : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->final_karpim_berkala_i : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->final_karpel_berkala_i : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->final_karpim_berkala_ii : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->final_karpel_berkala_ii : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->final_karpim_normal : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->final_karpel_normal : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->final_karpim_istimewa : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->final_karpel_istimewa : 0 }} org
                            </td>
                        </tr>
                    </table><hr>
                    <div class="row float-right">
                        <div class="col-md-12">
                            <form action="#" method="POST">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label class="sr-only" for="inlineFormInput">Name</label>
                                        <select name="search_key" id="search_key" class="form-control mb-2">
                                            <option value="nik">NIK</option>
                                            <option value="nama">NAMA</option>
                                            <option value="usulan">USULAN PENILAIAN</option>
                                            <option value="final">FINAL PENILAIAN</option>
                                        </select>
                                    </div>
                                    <div class="col-auto" id="rowNilai">
                                        <label class="sr-only" for="inlineFormInput">Name</label>
                                        <select name="nilai" id="nilai" class="form-control mb-2">
                                            <option value="tetap">TETAP</option>
                                            <option value="berkala_i">BERKALA I</option>
                                            <option value="berkala_ii">BERKALA II</option>
                                            <option value="normal">NAIK GOLONGAN NORMAL</option>
                                            <option value="istimewa">NAIK GOLONGAN ISTIMEWA</option>
                                        </select>
                                    </div>
                                    <div class="col-auto" id="rowNama">
                                        <label class="sr-only" for="inlineFormInput">Name</label>
                                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="nama">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mb-2">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered responsive" width="100%" id="tblDivisi">
                            <thead style="text-align: center">
                                <th style="width: 1%">No.</th>
                                <th style="width: 1%">NIK</th>
                                <th>Nama Karyawan</th>
                                <th style="width: 15%">Sub Bagian</th>
                                <th style="width: 7%">Gol. Awal</th>
                                <th style="width: 7%">Gol. Usulan</th>
                                <th style="width: 7%">Gol. Final</th>
                                <th style="width: 15%">Usulan</th>
                                <th style="width: 15%">Final</th>
                            </thead>
                            <tbody>
                                @foreach ($kry as $item => $valKar)
                                    <tr>
                                        <td style="text-align: center">{{ $item+1 }}</td>
                                        <td style="text-align: center" {!! $valKar->format_tabel_sidang !!}>{{ $valKar->nik }}</td>
                                        <td {!! $valKar->format_tabel_sidang !!}>{{ $valKar->nama }}</td>
                                        <td>{{ $valKar->sub_bagian }}</td>
                                        <td style="text-align: center">{{ $valKar->gol_awal."/".$valKar->mkg_awal }}</td>
                                        <td style="text-align: center">{{ ($valKar->gol_usul == "") ? "" : $valKar->gol_usul."/".$valKar->mkg_usul }}</td>
                                        <td style="text-align: center">{{ ($valKar->gol_final == "") ? "" : $valKar->gol_final."/".$valKar->mkg_final }}</td>
                                        <td style="text-align: center">
                                            {{ $valKar->penilaian }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $valKar->penilaian_final }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('penetapan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                        <span class="float-right">
                            <a href="{{ route('penetapan.cetak_sidang', $data[0]->indikator_id) }}" target="_blank" class="btn btn-success" ><i class="mdi mdi-printer"></i> CETAK</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function(){
        $('body').tooltip({selector: '[data-toggle="tooltip"]'});
        $('#rowNilai').hide();

        $('#search_key').change(function(){
            if ($(this).val() == "nik") {
                $('#rowNilai').hide();
                $('#rowNama').show();
            } else if ($(this).val() == "nama") {
                $('#rowNilai').hide();
                $('#rowNama').show();
            } else if ($(this).val() == "usulan") {
                $('#rowNilai').show();
                $('#rowNama').hide();
            } else {
                $('#rowNilai').show();
                $('#rowNama').hide();
            }
        });
    });
</script>
@endsection
