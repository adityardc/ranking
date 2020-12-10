<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
</head>
<body style="margin-bottom: 100mm" onload="window.print()">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-hover table-striped table-bordered" width="100%" style="font-size: 12px">
          <thead style="text-align: center">
            <tr>
                <th colspan="13">PENILAIAN INDIKATOR KPI : <span class="text-danger"><b>{{ Auth::user()->ptpn->company }}</b></span>, Divisi : <span class="text-danger"><b>{{ $indikator->divisi->nama_divisi }}</b></span></th>
            </tr>
              <th>#</th>
              <th>Indikator Penentu</th>
              <th style="width: 15%">RKAPP</th>
              <th style="width: 15%">REALISASI</th>
              <th style="width: 15%">+/-</th>
              <th style="width: 5%">%</th>
              <th style="width: 10%">REAL % KPI</th>
          </thead>
          <tbody>
              @foreach ($indikator->penilaians as $item => $val)
              <tr>
                  <td style="text-align: center;width: 1%">{{ $item+1 }}</td>
                  <td>{{ $val->kpi->nama_kpi }}</td>
                  <td style="text-align: right">{{ $val->format_rkapp }}</td>
                  <td style="text-align: right">{{ $val->format_realisasi }}</td>
                  <td style="text-align: right">{{ $val->format_kurleb }}</td>
                  <td style="text-align: center">{{ $val->persen_selisih }}</td>
                  <td style="text-align: center">{{ $val->format_real_kpi }}</td>
              </tr>
              @endforeach
              <tr>
                  <td colspan="6" style="text-align: right"><b>RATA-RATA</b></td>
                  <td style="text-align: center">{{ $rata->rata_rata }}</td>
              </tr>
          </tbody>
      </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-hover table-striped table-bordered responsive" width="100%" style="font-size: 12px">
          <thead style="text-align: center">
              <tr>
                  <th colspan="13">TARGET DISTRIBUTION VS CURRENT DISTRIBUTION (KPI)</th>
              </tr>
              <tr>
                  <th rowspan="2" style="vertical-align: middle;width: 1%">#</th>
                  <th rowspan="2" style="vertical-align: middle">KENAIKAN BERKALA</th>
                  <th rowspan="2" style="vertical-align: middle;width: 7%">MIN %</th>
                  <th rowspan="2" style="vertical-align: middle;width: 7%">MAX %</th>
                  <th rowspan="2" style="vertical-align: middle;width: 7%">MIN (orang)</th>
                  <th rowspan="2" style="vertical-align: middle;width: 7%">MAX (orang)</th>
                  <th colspan="3" style="vertical-align: middle">USULAN AWAL</th>
                  <th colspan="3" style="vertical-align: middle" class="table-warning">HASIL SIDANG</th>
              </tr>
              <tr>
                  <th style="width: 5%">KARPIM</th>
                  <th style="width: 5%">KARPEL</th>
                  <th style="width: 5%">JLH</th>
                  <th style="width: 5%" class="table-warning">KARPIM</th>
                  <th style="width: 5%" class="table-warning">KARPEL</th>
                  <th style="width: 5%" class="table-warning">JLH</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>1.</td>
                  <td>TETAP</td>
                  <td style="text-align: center">{{ $data[0]->min_persen }}</td>
                  <td style="text-align: center">{{ $data[0]->max_persen }}</td>
                  <td style="text-align: center">{{ $data[0]->min_orang }}</td>
                  <td style="text-align: center">{{ $data[0]->max_orang }}</td>
                  <td style="text-align: center" {!! $stat_tetap !!}>{{ $dataArr['karpim_tetap'] }}</td>
                  <td style="text-align: center" {!! $stat_tetap !!}>{{ $dataArr['karpel_tetap'] }}</td>
                  <td style="text-align: center" {!! $stat_tetap !!}>{{ $dataArr['jml_tetap'] }}</td>
                  <td style="text-align: center" {!! $final_stat_tetap !!}>{{ $dataArr['final_karpim_tetap'] }}</td>
                  <td style="text-align: center" {!! $final_stat_tetap !!}>{{ $dataArr['final_karpel_tetap'] }}</td>
                  <td style="text-align: center" {!! $final_stat_tetap !!}>{{ $dataArr['final_jml_tetap'] }}</td>
              </tr>
              <tr>
                  <td>2.</td>
                  <td>BERKALA I</td>
                  <td style="text-align: center">{{ $data[1]->min_persen }}</td>
                  <td style="text-align: center">{{ $data[1]->max_persen }}</td>
                  <td style="text-align: center">{{ $data[1]->min_orang }}</td>
                  <td style="text-align: center">{{ $data[1]->max_orang }}</td>
                  <td style="text-align: center" {!! $stat_berkala_i !!}>{{ $dataArr['karpim_berkala_i'] }}</td>
                  <td style="text-align: center" {!! $stat_berkala_i !!}>{{ $dataArr['karpel_berkala_i'] }}</td>
                  <td style="text-align: center" {!! $stat_berkala_i !!}>{{ $dataArr['jml_berkala_i'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_i !!}>{{ $dataArr['final_karpim_berkala_i'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_i !!}>{{ $dataArr['final_karpel_berkala_i'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_i !!}>{{ $dataArr['final_jml_berkala_i'] }}</td>
              </tr>
              <tr>
                  <td>3.</td>
                  <td>BERKALA II</td>
                  <td style="text-align: center">{{ $data[2]->min_persen }}</td>
                  <td style="text-align: center">{{ $data[2]->max_persen }}</td>
                  <td style="text-align: center">{{ $data[2]->min_orang }}</td>
                  <td style="text-align: center">{{ $data[2]->max_orang }}</td>
                  <td style="text-align: center" {!! $stat_berkala_ii !!}>{{ $dataArr['karpim_berkala_ii'] }}</td>
                  <td style="text-align: center" {!! $stat_berkala_ii !!}>{{ $dataArr['karpel_berkala_ii'] }}</td>
                  <td style="text-align: center" {!! $stat_berkala_ii !!}>{{ $dataArr['jml_berkala_ii'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_ii !!}>{{ $dataArr['final_karpim_berkala_ii'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_ii !!}>{{ $dataArr['final_karpel_berkala_ii'] }}</td>
                  <td style="text-align: center" {!! $final_stat_berkala_ii !!}>{{ $dataArr['final_jml_berkala_ii'] }}</td>
              </tr>
              <tr>
                  <td>4.</td>
                  <td>NAIK GOLONGAN NORMAL</td>
                  <td style="text-align: center">{{ $data[3]->min_persen }}</td>
                  <td style="text-align: center">{{ $data[3]->max_persen }}</td>
                  <td style="text-align: center">{{ $data[3]->min_orang }}</td>
                  <td style="text-align: center">{{ $data[3]->max_orang }}</td>
                  <td style="text-align: center" {!! $stat_normal !!}>{{ $dataArr['karpim_normal'] }}</td>
                  <td style="text-align: center" {!! $stat_normal !!}>{{ $dataArr['karpel_normal'] }}</td>
                  <td style="text-align: center" {!! $stat_normal !!}>{{ $dataArr['jml_normal'] }}</td>
                  <td style="text-align: center" {!! $final_stat_normal !!}>{{ $dataArr['final_karpim_normal'] }}</td>
                  <td style="text-align: center" {!! $final_stat_normal !!}>{{ $dataArr['final_karpel_normal'] }}</td>
                  <td style="text-align: center" {!! $final_stat_normal !!}>{{ $dataArr['final_jml_normal'] }}</td>
              </tr>
              <tr>
                  <td>5.</td>
                  <td>NAIK GOLONGAN ISTIMEWA</td>
                  <td style="text-align: center">{{ $data[4]->min_persen }}</td>
                  <td style="text-align: center">{{ $data[4]->max_persen }}</td>
                  <td style="text-align: center">{{ $data[4]->min_orang }}</td>
                  <td style="text-align: center">{{ $data[4]->max_orang }}</td>
                  <td style="text-align: center" {!! $stat_istimewa !!}>{{ $dataArr['karpim_istimewa'] }}</td>
                  <td style="text-align: center" {!! $stat_istimewa !!}>{{ $dataArr['karpel_istimewa'] }}</td>
                  <td style="text-align: center" {!! $stat_istimewa !!}>{{ $dataArr['jml_istimewa'] }}</td>
                  <td style="text-align: center" {!! $final_stat_istimewa !!}>{{ $dataArr['final_karpim_istimewa'] }}</td>
                  <td style="text-align: center" {!! $final_stat_istimewa !!}>{{ $dataArr['final_karpel_istimewa'] }}</td>
                  <td style="text-align: center" {!! $final_stat_istimewa !!}>{{ $dataArr['final_jml_istimewa'] }}</td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-borderless" width="100%" style="font-size: 12px">
          <tr style="text-align: center">
            <td style="width: 30%"><b>DISUSUN OLEH</b></td>
            <td style="width: 30%"><b>DIPERIKSA OLEH</b></td>
            <td style="width: 30%"><b>DIKETAHUI OLEH</b></td>
          </tr>
        </table>
      </div>
    </div><br><br>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-borderless" width="100%" style="font-size: 12px">
          <tr style="text-align: center;border-collapse: separate">
            <td style="width: 30%"><b><u>Ka. BAGIAN/DIVISI/DISTRIK MANAGER/MANAGER</u></b></td>
            <td style="width: 30%"><b><u>DISTRIK MANAGER/BAGIAN SDM</u></b></td>
            <td style="width: 30%"><b><u>BAGIAN SDM/SEVP</u></b></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-hover table-striped table-bordered responsive" width="100%" style="font-size: 12px">
          <thead style="text-align: center">
              <tr>
                  <th colspan="13">DAFTAR KARYAWAN</th>
              </tr>
              <tr>
                <th style="width: 1%">No.</th>
                <th style="width: 1%">NIK</th>
                <th>Nama Karyawan</th>
                <th style="width: 20%">Sub Bagian</th>
                <th style="width: 7%">Gol. Awal</th>
                <th style="width: 7%">Gol. Usul</th>
                <th style="width: 7%">Gol. Final</th>
                <th style="width: 10%">Usulan</th>
                <th style="width: 10%">Final</th>
              </tr>
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
    </div>
  </div>
</body>
</html>