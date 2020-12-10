@extends('layouts.admin')

@section('breadcrumb')
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penilaian Kinerja</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Penetapan Distribusi Penilaian</a></li>
            <li class="breadcrumb-item active">Distribusi Penilaian Karyawan</li>
        </ol>
    </div>
@endsection

@section('content')
<h4 class="page-title">Halaman Penetapan Distribusi Penilaian Karyawan</h4>
<div class="row">
    <div class="col-lg-6">
        @include('layouts.message')
    </div>
</div>
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box ribbon-box">
                <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Distribusi Penetapan Penilaian Karyawan</div>
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
                        <tr class="text-center">
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->tetap : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->berkala_i : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->berkala_ii : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->normal : 0 }}</b></td>
                            <td colspan="2"><b>{{ ($rekap != NULL) ? $rekap->istimewa : 0 }}</b></td>
                        </tr>
                        <tr style="text-align: center">
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->karpim_tetap : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->karpel_tetap : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->karpim_berkala_i : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->karpel_berkala_i : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->karpim_berkala_ii : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->karpel_berkala_ii : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->karpim_normal : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->karpel_normal : 0 }} org
                            </td>
                            <td>
                                PIM : {{ ($rekap != NULL) ? $rekap->karpim_istimewa : 0 }} org
                            </td>
                            <td>
                                PEL : {{ ($rekap != NULL) ? $rekap->karpel_istimewa : 0 }} org
                            </td>
                        </tr>
                    </table><hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered responsive" width="100%" id="tblDivisi">
                            <thead style="text-align: center">
                                <th style="width: 1%">No.</th>
                                <th style="width: 1%">NIK</th>
                                <th>Nama Karyawan</th>
                                <th style="width: 20%">Sub Bagian</th>
                                <th style="width: 7%">Gol. Awal</th>
                                <th style="width: 7%">Gol. Usul</th>
                                <th style="width: 20%">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($kry as $item => $valKar)
                                    <tr>
                                        <td style="text-align: center">{{ $item+1 }}</td>
                                        <td style="text-align: center" {!! $valKar->format_tabel_usul !!}>{{ $valKar->nik }}</td>
                                        <td {!! $valKar->format_tabel_usul !!}>{{ $valKar->nama }}</td>
                                        <td>{{ $valKar->sub_bagian }}</td>
                                        <td style="text-align: center">{{ $valKar->gol_awal."/".$valKar->mkg_awal }}</td>
                                        <td style="text-align: center">{{ ($valKar->gol_usul == "") ? "" : $valKar->gol_usul."/".$valKar->mkg_usul }}</td>
                                        <td style="text-align: center">
                                            {{ $valKar->penilaian }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        {{ $kry->links() }}
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-warning" onclick="location.href='{{ route('distribusi.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
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
    });
</script>
@endsection
