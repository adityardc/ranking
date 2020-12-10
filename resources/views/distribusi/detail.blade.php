<table class="table table-hover table-striped table-bordered responsive" width="100%">
    <thead style="text-align: center">
        <tr>
            <th colspan="13">TARGET DISTRIBUTION VS CURRENT DISTRIBUTION (KPI) : <span class="text-danger"><b>{{ Auth::user()->ptpn->company }}</b></span>, Divisi : <span class="text-danger"><b>{{ Auth::user()->divisi->nama_divisi }}</b></span></th>
        </tr>
        <tr>
            <th rowspan="2" style="vertical-align: middle;width: 1%">#</th>
            <th rowspan="2" style="vertical-align: middle">KENAIKAN BERKALA</th>
            {{-- <th rowspan="2" style="vertical-align: middle;width: 7%">MIN %</th>
            <th rowspan="2" style="vertical-align: middle;width: 7%">MAX %</th>
            <th rowspan="2" style="vertical-align: middle;width: 7%">MIN (orang)</th>
            <th rowspan="2" style="vertical-align: middle;width: 7%">MAX (orang)</th> --}}
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
            {{-- <td style="text-align: center">{{ $data[0]->min_persen }}</td>
            <td style="text-align: center">{{ $data[0]->max_persen }}</td>
            <td style="text-align: center">{{ $data[0]->min_orang }}</td>
            <td style="text-align: center">{{ $data[0]->max_orang }}</td> --}}
            <td style="text-align: center">{{ $dataArr['karpim_tetap'] }}</td>
            <td style="text-align: center">{{ $dataArr['karpel_tetap'] }}</td>
            <td style="text-align: center">{{ $dataArr['jml_tetap'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpim_tetap'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpel_tetap'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_jml_tetap'] }}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>BERKALA I</td>
            {{-- <td style="text-align: center">{{ $data[1]->min_persen }}</td>
            <td style="text-align: center">{{ $data[1]->max_persen }}</td>
            <td style="text-align: center">{{ $data[1]->min_orang }}</td>
            <td style="text-align: center">{{ $data[1]->max_orang }}</td> --}}
            <td style="text-align: center">{{ $dataArr['karpim_berkala_i'] }}</td>
            <td style="text-align: center">{{ $dataArr['karpel_berkala_i'] }}</td>
            <td style="text-align: center">{{ $dataArr['jml_berkala_i'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpim_berkala_i'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpel_berkala_i'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_jml_berkala_i'] }}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>BERKALA II</td>
            {{-- <td style="text-align: center">{{ $data[2]->min_persen }}</td>
            <td style="text-align: center">{{ $data[2]->max_persen }}</td>
            <td style="text-align: center">{{ $data[2]->min_orang }}</td>
            <td style="text-align: center">{{ $data[2]->max_orang }}</td> --}}
            <td style="text-align: center">{{ $dataArr['karpim_berkala_ii'] }}</td>
            <td style="text-align: center">{{ $dataArr['karpel_berkala_ii'] }}</td>
            <td style="text-align: center">{{ $dataArr['jml_berkala_ii'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpim_berkala_ii'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpel_berkala_ii'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_jml_berkala_ii'] }}</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>NAIK GOLONGAN NORMAL</td>
            {{-- <td style="text-align: center">{{ $data[3]->min_persen }}</td>
            <td style="text-align: center">{{ $data[3]->max_persen }}</td>
            <td style="text-align: center">{{ $data[3]->min_orang }}</td>
            <td style="text-align: center">{{ $data[3]->max_orang }}</td> --}}
            <td style="text-align: center">{{ $dataArr['karpim_normal'] }}</td>
            <td style="text-align: center">{{ $dataArr['karpel_normal'] }}</td>
            <td style="text-align: center">{{ $dataArr['jml_normal'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpim_normal'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpel_normal'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_jml_normal'] }}</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>NAIK GOLONGAN ISTIMEWA</td>
            {{-- <td style="text-align: center">{{ $data[4]->min_persen }}</td>
            <td style="text-align: center">{{ $data[4]->max_persen }}</td>
            <td style="text-align: center">{{ $data[4]->min_orang }}</td>
            <td style="text-align: center">{{ $data[4]->max_orang }}</td> --}}
            <td style="text-align: center">{{ $dataArr['karpim_istimewa'] }}</td>
            <td style="text-align: center">{{ $dataArr['karpel_istimewa'] }}</td>
            <td style="text-align: center">{{ $dataArr['jml_istimewa'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpim_istimewa'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_karpel_istimewa'] }}</td>
            <td style="text-align: center" class="table-warning">{{ $dataArr['final_jml_istimewa'] }}</td>
        </tr>
    </tbody>
    {{-- <tbody>
        <tr>
            <td>1.</td>
            <td>TETAP</td>
            <td style="text-align: center">4</td>
            <td style="text-align: center">10</td>
            <td style="text-align: center">8</td>
            <td style="text-align: center">19</td>
            <td style="text-align: center" class="table-danger">2</td>
            <td style="text-align: center" class="table-danger">28</td>
            <td style="text-align: center" class="table-danger">30</td>
            <td style="text-align: center">2</td>
            <td style="text-align: center">17</td>
            <td style="text-align: center">19</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>BERKALA I</td>
            <td style="text-align: center">10</td>
            <td style="text-align: center">33</td>
            <td style="text-align: center">19</td>
            <td style="text-align: center">62</td>
            <td style="text-align: center">-</td>
            <td style="text-align: center">45</td>
            <td style="text-align: center">45</td>
            <td style="text-align: center">4</td>
            <td style="text-align: center">38</td>
            <td style="text-align: center">42</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>BERKALA II</td>
            <td style="text-align: center">40</td>
            <td style="text-align: center">66</td>
            <td style="text-align: center">75</td>
            <td style="text-align: center">124</td>
            <td style="text-align: center">5</td>
            <td style="text-align: center">73</td>
            <td style="text-align: center">78</td>
            <td style="text-align: center">5</td>
            <td style="text-align: center">102</td>
            <td style="text-align: center">107</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>NAIK GOLONGAN NORMAL</td>
            <td style="text-align: center">2</td>
            <td style="text-align: center">8</td>
            <td style="text-align: center">4</td>
            <td style="text-align: center">15</td>
            <td style="text-align: center" class="table-danger">2</td>
            <td style="text-align: center" class="table-danger">27</td>
            <td style="text-align: center" class="table-danger">29</td>
            <td style="text-align: center">4</td>
            <td style="text-align: center">11</td>
            <td style="text-align: center">15</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>NAIK GOLONGAN ISTIMEWA</td>
            <td style="text-align: center">1</td>
            <td style="text-align: center">3</td>
            <td style="text-align: center">2</td>
            <td style="text-align: center">6</td>
            <td style="text-align: center">1</td>
            <td style="text-align: center">5</td>
            <td style="text-align: center">6</td>
            <td style="text-align: center">1</td>
            <td style="text-align: center">4</td>
            <td style="text-align: center">5</td>
        </tr>
    </tbody> --}}
</table>