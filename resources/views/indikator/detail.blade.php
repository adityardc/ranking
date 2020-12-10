<form role="form" id="frmBagian">
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <div class="form-group has-error">
                <label for="exampleInputUsername2">Tahun Penilaian</label><br>
                <button type="button" class="btn btn-primary btn-xs"><b>{{ $indikator->tahun }}</b></button>
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div class="form-group has-error">
                <label for="exampleInputUsername2">Jumlah Karyawan</label><br>
                <button type="button" class="btn btn-danger btn-xs"><b>{{ $indikator->jml_karyawan }}</b></button>
            </div>
        </div>
        <div class="col-sm-3 col-md-3">
            <div class="form-group">
                <label for="exampleInputUsername2">Perusahaan</label><br>
                <button type="button" class="btn btn-warning btn-xs"><b>{{ $indikator->ptpn->company }}</b></button>
            </div>
        </div>
        <div class="col-sm-5 col-md-5">
            <div class="form-group">
                <label for="exampleInputUsername2">Divisi</label><br>
                <button type="button" class="btn btn-success btn-xs"><b>{{ $indikator->divisi->nama_divisi }}</b></button>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputUsername2">Komoditas</label><br>
        @foreach ($indikator->divisi->kategoridivisis as $val)
            <button type='button' class='btn btn-info btn-xs waves-effect waves-light'><b>{{ $val->kategori->nama_kategori }}</b></button>
        @endforeach
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" width="100%">
            <thead style="text-align: center">
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
</form>