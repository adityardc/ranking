<table class="table table-hover table-striped table-bordered responsive" width="100%">
    <thead style="text-align: center">
        <tr>
            <th colspan="13">TARGET DISTRIBUTION VS CURRENT DISTRIBUTION (KPI) : <span class="text-danger"><b>{{ Auth::user()->ptpn->company }}</b></span>, Divisi : <span class="text-danger"><b>{{ Auth::user()->divisi->nama_divisi }}</b></span></th>
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