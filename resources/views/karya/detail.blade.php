<table class="table table-hover table-striped table-bordered" id="tblDetail_ba" width="100%">
    <thead>
        <th colspan="7" style="text-align: center">DISTRIBUSI PENILAIAN : <span class="text-danger"><b><u>{{ $ptpn }}</u></b></span></th>
    </thead>
    <tbody>
        <tr style="text-align: center">
            <td rowspan="2" style="vertical-align: middle">DISTRIBUSI PENILAIAN</td>
            <td colspan="2">< RKAP</td>
            <td colspan="2">= RKAP >= 10 %</td>
            <td colspan="2">> 10 %</td>
        </tr>
        <tr style="text-align: center">
            <td>MIN</td>
            <td>MAX</td>
            <td>MIN</td>
            <td>MAX</td>
            <td>MIN</td>
            <td>MAX</td>
        </tr>
        <tr>
            <td>TETAP</td>
            <td style="width: 11%;text-align: center">{{ $data[0]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[0]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[1]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[1]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[2]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[2]->max }} %</td>
        </tr>
        <tr>
            <td>I BERKALA</td>
            <td style="width: 11%;text-align: center">{{ $data[3]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[3]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[4]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[4]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[5]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[5]->max }} %</td>
        </tr>
        <tr>
            <td>II BERKALA</td>
            <td style="width: 11%;text-align: center">{{ $data[6]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[6]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[7]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[7]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[8]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[8]->max }} %</td>
        </tr>
        <tr>
            <td>NAIK GOLONGAN NORMAL</td>
            <td style="width: 11%;text-align: center">{{ $data[9]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[9]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[10]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[10]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[11]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[11]->max }} %</td>
        </tr>
        <tr>
            <td>NAIK GOLONGAN ISTIMEWA</td>
            <td style="width: 11%;text-align: center">{{ $data[12]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[12]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[13]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[13]->max }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[14]->min }} %</td>
            <td style="width: 11%;text-align: center">{{ $data[14]->max }} %</td>
        </tr>
    </tbody>
</table>