<?php

namespace App\Http\Controllers;

use App\Distribusi;
use App\DistribusiKaryawan;
use App\Divisi;
use App\Indikator;
use App\Kpi;
use App\PenilaianIndikator;
use App\PenilaianKarya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('indikator.index');
    }

    public function listData()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $query = DB::table('vw_list_indikator')->orderBy('tahun','desc')->orderBy('divisi_id')->get();
        } else {
            $query = DB::table('vw_list_indikator')->where('ptpn_id', Auth::user()->ptpn_id)->orderBy('tahun','desc')->orderBy('divisi_id')->get();
        } 
                
        return Datatables::of($query)->addColumn('status', function($query){
                    if ($query->tahun == NULL) {
                        $x = "<div class='badge badge-danger mr-1 mb-1'><i class='mdi mdi-close-box-multiple'></i></div>";
                    } else {
                        $x = "<div class='badge badge-success mr-1 mb-1'><i class='mdi mdi-check-box-multiple-outline'></i></div>";
                    }
                    return $x;
                })->addColumn('progress', function($query){
                    if ($query->usul_approve == 0) {
                        $xyz = "<div class='badge badge-warning mr-1 mb-1'>TAHAP USULAN</div>";
                    } elseif ($query->usul_approve == 1) {
                        $xyz = "<div class='badge badge-primary mr-1 mb-1'>TAHAP SIDANG</div>";
                    } else {
                        $xyz = "<div class='badge badge-success mr-1 mb-1'>SELESAI</div>";
                    }                    

                    return $xyz;
                })->addColumn('aksi', function($query){
                    if ($query->tahun == NULL) {
                        if (Auth::user()->hasRole('ADMINISTRATOR ANPER')) {
                            $xyz = '<a href="'.route('indikator.edit', $query->divisi_id).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data"><i class="mdi mdi-lead-pencil"></i></a>';
                        } else {
                            $xyz = "-";
                        }
                    } else {
                        if (Auth::user()->hasRole('ADMINISTRATOR ANPER')) {
                            $xyz = '<form id="frmHapus-'.$query->indikator_id.'" method="POST" action="'.route('indikator.destroy', $query->indikator_id).'">'.csrf_field().'<input type="hidden" name="_method" value="delete"> <button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Data" onclick="draft('.$query->indikator_id.')"><i class="mdi mdi-trash-can"></i></button> <a href="'.route('indikator.show', $query->indikator_id).'" class="btn btn-primary btn-xs detail_distribusi" data-toggle="tooltip" data-placement="top" data-original-title="Detail Data Penilaian"><i class="mdi mdi-file-find"></i></a></form>';
                        } else {
                            $xyz = '<a href="'.route('indikator.show', $query->indikator_id).'" class="btn btn-primary btn-xs detail_distribusi" data-toggle="tooltip" data-placement="top" data-original-title="Detail Data Penilaian"><i class="mdi mdi-file-find"></i></a>';
                        }
                    }
                    return $xyz;
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_data = Auth::user();
        $cekKarya  = PenilaianKarya::where('ptpn_id', $user_data->ptpn_id)->count();
        $cekKry    = DistribusiKaryawan::where('divisi_id', $user_data->divisi_id)->where('usul_approve', 0);

        if ($cekKarya != 0) {
            if ($cekKry->count() != 0) {
                $tahun         = Carbon::now()->year;
                $indikator_div = $user_data->divisi->kategoridivisis->pluck('kategori_id','kategori_id')->all();
                $kpi           = Kpi::whereIn('kategori_id', $indikator_div)->get();
                $kry           = $cekKry->count();
                return view('indikator.create', compact(['user_data','tahun','kpi','kry']));
            } else {
                return back()->with('gagal', 'Data Karyawan tidak ditemukan !');
            }
        } else {
            return back()->with('gagal', 'Data Penilaian Karya '.$user_data->ptpn->company.' tidak ditemukan !');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cekTahun = Indikator::where('tahun', $request->tahun)->where('divisi_id', Auth::user()->divisi_id)->count();
        if ($cekTahun == 0) {    
            $indi               = new Indikator;
            $indi->tahun        = $request->tahun;
            $indi->ptpn_id      = Auth::user()->ptpn_id;
            $indi->divisi_id    = Auth::user()->divisi_id;
            $indi->kategori_id  = "0";
            $indi->jml_karyawan = $request->jml_karyawan;
            $indi->save();

            if(!empty($request->rkapp) && !empty($request->realisasi)){
                $arrData_poll = [];
                foreach ($request->rkapp as $key_poll => $value_poll) {
                    $var_rkapp    = floatval(str_replace(',', '', $request->rkapp[$key_poll]));
                    $var_real     = floatval(str_replace(',', '', $request->realisasi[$key_poll]));
                    $var_selisih  = $var_real - $var_rkapp;
                    $var_persen   = round($var_real / $var_rkapp * 100);
                    $var_kpi      = round($var_persen-100);

                    if ($request->icon[$key_poll] == 1 && $var_kpi <= 0) { // FAVORABLE dan NILAI NEGATIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } elseif($request->icon[$key_poll] == 1 && $var_kpi > 0) { // FAVORABLE dan NILAI POSITIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } else {
                        $xx = $var_kpi;
                    }
                    

                    $arrData_poll[] = [
                        'indikator_id'   => $indi->id,
                        'kpi_id'         => $key_poll,
                        'rkapp'          => $var_rkapp,
                        'realisasi'      => $var_real,
                        'kurleb'         => $var_selisih,
                        'persen_selisih' => $var_persen,
                        'real_kpi'       => $xx,
                        'rata_rata'      => 0,
                        'favor'          => 0,
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now(),
                    ];   
                }
                
                PenilaianIndikator::insert($arrData_poll);
            }

            $rata = DB::table('vw_rata_rata_kpi')->where('indikator_id', $indi->id)->where('tahun', $request->tahun)->first();

            if ($rata->rata_rata < 0) {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'KURANG')->orderBy('id')->get();
            } elseif($rata->rata_rata >= 0 && $rata->rata_rata <= 10) {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'SAMA')->orderBy('id')->get();
            } else {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'LEBIH')->orderBy('id')->get();
            }
            
            $arrData_karya = [];
            foreach ($karya as $item => $val) {
                $arrData_karya[] = [
                    'ptpn_id'      => Auth::user()->ptpn_id,
                    'divisi_id'    => Auth::user()->divisi_id,
                    'indikator_id' => $indi->id,
                    'rangking'     => $val->rangking,
                    'min_persen'   => $val->min,
                    'max_persen'   => $val->max,
                    'min_orang'    => round((($val->min/100)*$request->jml_karyawan), 0),
                    'max_orang'    => round((($val->max/100)*$request->jml_karyawan), 0),
                    'created_at'   => \Carbon\Carbon::now(),
                    'updated_at'   => \Carbon\Carbon::now()
                ];   
            }
            DB::table('distribusis')->insert($arrData_karya);
            
            return redirect()->route('indikator.index')->with('sukses', 'Berhasil, Indikator Penilaian Tahun '.$request->tahun.' berhasil disimpan.');
        } else {
            return back()->with('gagal', 'Tahun Penilaian '.$request->tahun.' Sudah Terdaftar !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function show(Indikator $indikator)
    {
        $rata = DB::table('vw_rata_rata_kpi')->where('indikator_id', $indikator->id)->where('tahun', $indikator->tahun)->first();
        return view('indikator.detail', compact('indikator','rata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun         = Carbon::now()->year;
        $data          = DB::table('vw_list_indikator')->where('divisi_id', $id)->where('ptpn_id', Auth::user()->ptpn_id)->whereNull('tahun')->first();
        $indikator_div = Auth::user()->divisi->kategoridivisis->pluck('kategori_id','kategori_id')->all();
        $kpi           = Kpi::whereIn('kategori_id', $indikator_div)->get();
        $kat           = Divisi::with('kategoridivisis')->where('id', $id)->first();
        return view('indikator.edit', compact(['data','tahun','kat','kpi']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indikator $indikator)
    {
        $cekTahun = Indikator::where('id', '<>',$indikator->id)->where('tahun', $request->tahun)->where('divisi_id', Auth::user()->divisi_id)->count();
        if ($cekTahun == 0) {    
            $indikator->tahun        = $request->tahun;
            $indikator->jml_karyawan = $request->jml_karyawan;
            $indikator->update();

            if(!empty($request->rkapp) && !empty($request->realisasi)){
                foreach ($request->rkapp as $key_poll => $value_poll) {
                    $var_rkapp   = floatval(str_replace(',', '', $request->rkapp[$key_poll]));
                    $var_real    = floatval(str_replace(',', '', $request->realisasi[$key_poll]));
                    $var_selisih = $var_real - $var_rkapp;
                    $var_persen  = round($var_real / $var_rkapp * 100);
                    $var_kpi     = round($var_persen-100);

                    if ($request->icon[$key_poll] == 1 && $var_kpi <= 0) { // FAVORABLE dan NILAI NEGATIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } elseif($request->icon[$key_poll] == 1 && $var_kpi > 0) { // FAVORABLE dan NILAI POSITIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } else {
                        $xx = $var_kpi;
                    }

                    PenilaianIndikator::where('id', $key_poll)->update([
                        'rkapp'          => $var_rkapp,
                        'realisasi'      => $var_real,
                        'kurleb'         => $var_selisih,
                        'persen_selisih' => $var_persen,
                        'real_kpi'       => $xx,
                        'favor'          => 0,
                    ]);  
                }

                $rata = DB::table('vw_rata_rata_kpi')->where('indikator_id', $indikator->id)->where('tahun', $request->tahun)->first();

                if ($rata->rata_rata < 0) {
                    $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'KURANG')->orderBy('id')->get();
                } elseif($rata->rata_rata >= 0 && $rata->rata_rata <= 10) {
                    $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'SAMA')->orderBy('id')->get();
                } else {
                    $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'LEBIH')->orderBy('id')->get();
                }

                Distribusi::where('indikator_id', $indikator->id)->where('rangking', 'TETAP')->update([
                    'min_persen' => $karya[0]->min,
                    'max_persen' => $karya[0]->max,
                    'min_orang'  => round((($karya[0]->min/100)*$request->jml_karyawan), 0),
                    'max_orang'  => round((($karya[0]->max/100)*$request->jml_karyawan), 0),
                ]);

                Distribusi::where('indikator_id', $indikator->id)->where('rangking', 'BERKALA I')->update([
                    'min_persen' => $karya[1]->min,
                    'max_persen' => $karya[1]->max,
                    'min_orang'  => round((($karya[1]->min/100)*$request->jml_karyawan), 0),
                    'max_orang'  => round((($karya[1]->max/100)*$request->jml_karyawan), 0),
                ]);

                Distribusi::where('indikator_id', $indikator->id)->where('rangking', 'BERKALA II')->update([
                    'min_persen' => $karya[2]->min,
                    'max_persen' => $karya[2]->max,
                    'min_orang'  => round((($karya[2]->min/100)*$request->jml_karyawan), 0),
                    'max_orang'  => round((($karya[2]->max/100)*$request->jml_karyawan), 0),
                ]);

                Distribusi::where('indikator_id', $indikator->id)->where('rangking', 'NAIK NORMAL')->update([
                    'min_persen' => $karya[3]->min,
                    'max_persen' => $karya[3]->max,
                    'min_orang'  => round((($karya[3]->min/100)*$request->jml_karyawan), 0),
                    'max_orang'  => round((($karya[3]->max/100)*$request->jml_karyawan), 0),
                ]);

                Distribusi::where('indikator_id', $indikator->id)->where('rangking', 'NAIK ISTIMEWA')->update([
                    'min_persen' => $karya[4]->min,
                    'max_persen' => $karya[4]->max,
                    'min_orang'  => round((($karya[4]->min/100)*$request->jml_karyawan), 0),
                    'max_orang'  => round((($karya[4]->max/100)*$request->jml_karyawan), 0),
                ]);
            }
            
            return redirect()->route('indikator.index')->with('sukses', 'Berhasil, Indikator Penilaian Tahun '.$request->tahun.' berhasil diubah.');
        } else {
            return back()->with('gagal', 'Tahun Penilaian '.$request->tahun.' Sudah Terdaftar !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Indikator::where('id', $id)->delete();
        Distribusi::where('indikator_id', $id)->delete();
        DistribusiKaryawan::where('indikator_id', $id)->update([
            'indikator_id'    => NULL,
            'penilaian'       => NULL,
            'gol_usul'        => NULL,
            'mkg_usul'        => NULL,
            'gol_final'       => NULL,
            'mkg_final'       => NULL,
            'usul_approve'    => 0,
            'final_approve'   => 0,
            'status'          => NULL,
            'penilaian_final' => NULL,
        ]);
        PenilaianIndikator::where('indikator_id', $id)->delete();

        return back()->with('sukses', 'Data Penilaian KPI berhasil dihapus !');
    }

    public function store_indikator(Request $request, $id)
    {
        $cekTahun = DB::table('vw_list_indikator')->where('tahun', $request->tahun)->where('divisi_id', $id)->count();
        if ($cekTahun == 0) {    
            $indi               = new Indikator;
            $indi->tahun        = $request->tahun;
            $indi->ptpn_id      = Auth::user()->ptpn_id;
            $indi->divisi_id    = $id;
            $indi->kategori_id  = "0";
            $indi->jml_karyawan = $request->jml_karyawan;
            $indi->save();

            DistribusiKaryawan::where('divisi_id', $id)->where('ptpn_id', Auth::user()->ptpn_id)->where('usul_approve', 0)->update([
                'indikator_id' => $indi->id
            ]);

            if(!empty($request->rkapp) && !empty($request->realisasi)){
                $arrData_poll = [];
                foreach ($request->rkapp as $key_poll => $value_poll) {
                    $var_rkapp    = floatval(str_replace(',', '', $request->rkapp[$key_poll]));
                    $var_real     = floatval(str_replace(',', '', $request->realisasi[$key_poll]));
                    $var_selisih  = $var_real - $var_rkapp;
                    $var_persen   = round($var_real / $var_rkapp * 100);
                    $var_kpi      = round($var_persen-100);

                    if ($request->icon[$key_poll] == 1 && $var_kpi <= 0) { // FAVORABLE dan NILAI NEGATIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } elseif($request->icon[$key_poll] == 1 && $var_kpi > 0) { // FAVORABLE dan NILAI POSITIF
                        $xx = $var_kpi+($var_kpi*-2);
                    } else {
                        $xx = $var_kpi;
                    }                    

                    $arrData_poll[] = [
                        'indikator_id'   => $indi->id,
                        'kpi_id'         => $key_poll,
                        'rkapp'          => $var_rkapp,
                        'realisasi'      => $var_real,
                        'kurleb'         => $var_selisih,
                        'persen_selisih' => $var_persen,
                        'real_kpi'       => $xx,
                        'rata_rata'      => 0,
                        'favor'          => 0,
                        'created_at'     => Carbon::now(),
                        'updated_at'     => Carbon::now(),
                    ];   
                }
                
                PenilaianIndikator::insert($arrData_poll);
            }

            $rata = DB::table('vw_rata_rata_kpi')->where('indikator_id', $indi->id)->where('tahun', $request->tahun)->first();

            if ($rata->rata_rata < 0) {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'KURANG')->orderBy('id')->get();
            } elseif($rata->rata_rata >= 0 && $rata->rata_rata <= 10) {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'SAMA')->orderBy('id')->get();
            } else {
                $karya = PenilaianKarya::where('ptpn_id', Auth::user()->ptpn_id)->where('jenis_rkap', 'LEBIH')->orderBy('id')->get();
            }
            
            $arrData_karya = [];
            foreach ($karya as $item => $val) {
                $arrData_karya[] = [
                    'ptpn_id'      => Auth::user()->ptpn_id,
                    'divisi_id'    => $id,
                    'indikator_id' => $indi->id,
                    'rangking'     => $val->rangking,
                    'min_persen'   => $val->min,
                    'max_persen'   => $val->max,
                    'min_orang'    => round((($val->min/100)*$request->jml_karyawan), 0),
                    'max_orang'    => round((($val->max/100)*$request->jml_karyawan), 0),
                    'created_at'   => \Carbon\Carbon::now(),
                    'updated_at'   => \Carbon\Carbon::now()
                ];   
            }
            DB::table('distribusis')->insert($arrData_karya);
            
            return redirect()->route('indikator.index')->with('sukses', 'Berhasil, Indikator Penilaian Tahun '.$request->tahun.' berhasil disimpan.');
        } else {
            return back()->with('gagal', 'Tahun Penilaian '.$request->tahun.' Sudah Terdaftar !');
        }
    }
}
