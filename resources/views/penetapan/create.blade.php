@extends('layouts.admin')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
<div class="row">
    <div class="col-lg-12">
        <div class="card-box ribbon-box">
            <div class="ribbon ribbon-blue float-left"><i class="mdi mdi-access-point mr-1"></i> Tabel Usulan Penetapan Penilaian Karyawan</div>
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
                            <th style="width: 20%">Sub Bagian</th>
                            <th style="width: 7%">Gol. Awal</th>
                            <th style="width: 7%">Gol. Usulan</th>
                            <th style="width: 7%">Gol. Final</th>
                            <th style="width: 20%">Aksi</th>
                        </thead>
                        <tbody>
                            <form action="{{ route('penetapan.update', $data[0]->indikator_id) }}" method="POST" id="frmDistribusi">
                                @csrf
                                {{ method_field('PUT') }}

                                @foreach ($kry as $item => $valKar)
                                    <tr>
                                        <td style="text-align: center">{{ $item+1 }}</td>
                                        <td style="text-align: center">{{ $valKar->nik }}</td>
                                        <td>{{ $valKar->nama }}</td>
                                        <td>{{ $valKar->sub_bagian }}</td>
                                        <td style="text-align: center">{{ $valKar->gol_awal."/".$valKar->mkg_awal }}</td>
                                        <td style="text-align: center">{{ $valKar->gol_usul."/".$valKar->mkg_usul }}</td>
                                        <td style="text-align: center">{{ ($valKar->gol_final == "") ? "" : $valKar->gol_final."/".$valKar->mkg_final }}</td>
                                        <td>
                                            <select name="penilaian" id="penilaian" data-indikator="{{ $data[0]->indikator_id }}" data-id="{{ $valKar->id }}" data-gol="{{ $valKar->gol_awal }}" data-mkg="{{ $valKar->mkg_awal }}" class="form-control modalNilai">
                                                <option value="0" {{ ($valKar->penilaian_final == "") ? "selected='selected'" : "" }}>.:: PILIH PENILAIAN ::.</option>
                                                <option value="TETAP" {{ ($valKar->penilaian_final == "TETAP") ? "selected='selected'" : "" }}>TETAP</option>
                                                <option value="BERKALA I" {{ ($valKar->penilaian_final == "BERKALA I") ? "selected='selected'" : "" }}>BERKALA I</option>
                                                <option value="BERKALA II" {{ ($valKar->penilaian_final == "BERKALA II") ? "selected='selected'" : "" }}>BERKALA II</option>
                                                <option value="NAIK GOLONGAN NORMAL" {{ ($valKar->penilaian_final == "NAIK GOLONGAN NORMAL") ? "selected='selected'" : "" }}>NAIK GOLONGAN NORMAL</option>
                                                <option value="NAIK GOLONGAN ISTIMEWA" {{ ($valKar->penilaian_final == "NAIK GOLONGAN ISTIMEWA") ? "selected='selected'" : "" }}>NAIK GOLONGAN ISTIMEWA</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    {{ $kry->links() }}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-warning" onclick="location.href='{{ route('penetapan.index') }}'"><i class="mdi mdi-step-backward"></i> BATAL/KEMBALI</button>
                    <span class="float-right">
                        <button type="button" class="btn btn-success" onclick="setuju()"><i class="mdi mdi-send"></i> SETUJUI</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
    function setuju(){
        Swal.fire({
            title: 'Konfirmasi?',
            text: "Anda yakin menyetujui usulan penilaian karyawan ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak, batalkan !',
            confirmButtonText: 'Ya, saya yakin !'
        }).then((result) => {
            if (result.value) {
                $('#frmDistribusi').submit();
            }
        });
    }

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

        $(".modalNilai").change(function(){
            var id_user      = $(this).attr('data-id');
            var id_indikator = $(this).attr('data-indikator');
            var id_penilaian = $(this).val();
            var id_gol       = $(this).attr('data-gol');
            var id_mkg       = $(this).attr('data-mkg');

            if (id_penilaian == "") {
                Swal.fire(
                    'Gagal!',
                    'Update Penilaian Gagal, silahkan pilih kenaikan golongan.',
                    'error'
                )
            } else {
                $.ajax({
                    url: '{{ URL::to('penetapan/update_penilaian') }}',
                    type: "POST",
                    cache: false,
                    async: false,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id_user,
                        indikator: id_indikator,
                        penilaian: id_penilaian,
                        gol: id_gol,
                        mkg: id_mkg,
                    },
                    success: function (response) {
                        if (response.status == 0) {
                            Swal.fire(
                                'Gagal!',
                                'Golongan dan Masa kerja tidak valid.',
                                'error'
                            )
                        } else if (response.status == 1) {
                            Swal.fire(
                                'Gagal!',
                                'Masa kerja karyawan sudah maksimal.',
                                'error'
                            )  
                        } else if (response.status == 2) {
                            Swal.fire(
                                'Gagal!',
                                'Masa kerja karyawan tidak memenuhi syarat untuk Kenaikan Golongan Normal.',
                                'error'
                            )  
                        } else if (response.status == 3) {
                            Swal.fire(
                                'Gagal!',
                                'Masa kerja karyawan tidak memenuhi syarat untuk Kenaikan Golongan Istimewa.',
                                'error'
                            )  
                        } else {
                            Swal.fire({
                                title: 'Berhasil !',
                                text: "Penilaian Karyawan berhasil disimpan.",
                                icon: 'success',
                                showCancelButton: false,
                                allowOutsideClick: false,
                                confirmButtonText: 'Oke !'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                });   
            }
        });

        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
    });
</script>
@endsection
