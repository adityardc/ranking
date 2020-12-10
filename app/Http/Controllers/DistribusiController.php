<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distribusi;
use App\DistribusiKaryawan;
use App\Mkg;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use PDF;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('distribusi.index');
    }

    public function listData()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $query = DB::table('vw_list_indikator')->whereNotNull('indikator_id')->get();
        } else {
            $query = DB::table('vw_list_indikator')
                ->where('ptpn_id', Auth::user()->ptpn_id)
                ->whereNotNull('indikator_id')->get();
        }        

        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('distribusi.edit', $query->indikator_id);
                })->addColumn('show_url', function($query){
                    return route('distribusi.show', $query->indikator_id);
                })->addColumn('status', function($query){
                    if ($query->usul_approve == 0) {
                        $xyz = "<div class='badge badge-warning mr-1 mb-1'>TAHAP USULAN</div>";
                    } elseif ($query->usul_approve == 1) {
                        $xyz = "<div class='badge badge-primary mr-1 mb-1'>TAHAP SIDANG</div>";
                    } else {
                        $xyz = "<div class='badge badge-success mr-1 mb-1'>SELESAI</div>";
                    }                    

                    return $xyz;
                })->addColumn('tombol', function($query){
                    if ($query->usul_approve == 0) {
                        if (Auth::user()->hasRole('ADMINISTRATOR ANPER')) {
                            $xyz = '<a href="'.route('distribusi.edit', $query->indikator_id).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Input Distribusi Karyawan"><i class="mdi mdi-lead-pencil"></i></a>';
                        } else {
                            $xyz = "-";
                        }
                    } else {
                        $xyz = '<a href="'.route('distribusi.edit', $query->indikator_id).'" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Detail Usulan Karyawan"><i class="mdi mdi-database-search"></i></a> <a href="'.route('distribusi.show', $query->indikator_id).'" class="btn btn-primary btn-xs detail_distribusi" data-toggle="tooltip" data-placement="top" data-original-title="Detail Data Distribusi Penilaian"><i class="mdi mdi-file-find"></i></a>';
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = Distribusi::where('indikator_id', $id)->orderBy('id')->get();
        $rekap = DB::table('vw_update_usulan')->where('divisi_id', $data[0]->divisi_id)->where('indikator_id', $data[0]->indikator_id);

        if ($rekap->count() == 0) {
            $dataArr = [
                'jml_tetap'      => 0,
                'jml_berkala_i'  => 0,
                'jml_berkala_ii' => 0,
                'jml_normal'     => 0,
                'jml_istimewa'   => 0,

                'karpim_tetap'       => 0,
                'karpel_tetap'       => 0,
                'karpim_berkala_i'   => 0,
                'karpel_berkala_i'   => 0,
                'karpim_berkala_ii'  => 0,
                'karpel_berkala_ii'  => 0,
                'karpim_normal'      => 0,
                'karpel_normal'      => 0,
                'karpim_istimewa'    => 0,
                'karpel_istimewa'    => 0,

                'final_jml_tetap'      => 0,
                'final_jml_berkala_i'  => 0,
                'final_jml_berkala_ii' => 0,
                'final_jml_normal'     => 0,
                'final_jml_istimewa'   => 0,

                'final_karpim_tetap'       => 0,
                'final_karpel_tetap'       => 0,
                'final_karpim_berkala_i'   => 0,
                'final_karpel_berkala_i'   => 0,
                'final_karpim_berkala_ii'  => 0,
                'final_karpel_berkala_ii'  => 0,
                'final_karpim_normal'      => 0,
                'final_karpel_normal'      => 0,
                'final_karpim_istimewa'    => 0,
                'final_karpel_istimewa'    => 0,
            ];

            $stat_tetap      = "";
            $stat_berkala_i  = "";
            $stat_berkala_ii = "";
            $stat_normal     = "";
            $stat_istimewa   = "";

            $final_stat_tetap      = "";
            $final_stat_berkala_i  = "";
            $final_stat_berkala_ii = "";
            $final_stat_normal     = "";
            $final_stat_istimewa   = "";
        } else {
            $dataArr = [
                'karpim_tetap'       => $rekap->first()->karpim_tetap,
                'karpel_tetap'       => $rekap->first()->karpel_tetap,
                'karpim_berkala_i'   => $rekap->first()->karpim_berkala_i,
                'karpel_berkala_i'   => $rekap->first()->karpel_berkala_i,
                'karpim_berkala_ii'  => $rekap->first()->karpim_berkala_ii,
                'karpel_berkala_ii'  => $rekap->first()->karpel_berkala_ii,
                'karpim_normal'      => $rekap->first()->karpim_normal,
                'karpel_normal'      => $rekap->first()->karpel_normal,
                'karpim_istimewa'    => $rekap->first()->karpim_istimewa,
                'karpel_istimewa'    => $rekap->first()->karpel_istimewa,

                'jml_tetap'      => $rekap->first()->karpim_tetap + $rekap->first()->karpel_tetap,
                'jml_berkala_i'  => $rekap->first()->karpim_berkala_i + $rekap->first()->karpel_berkala_i,
                'jml_berkala_ii' => $rekap->first()->karpim_berkala_ii + $rekap->first()->karpel_berkala_ii,
                'jml_normal'     => $rekap->first()->karpim_normal + $rekap->first()->karpel_normal,
                'jml_istimewa'   => $rekap->first()->karpim_istimewa + $rekap->first()->karpel_istimewa,

                'final_karpim_tetap'       => $rekap->first()->final_karpim_tetap,
                'final_karpel_tetap'       => $rekap->first()->final_karpel_tetap,
                'final_karpim_berkala_i'   => $rekap->first()->final_karpim_berkala_i,
                'final_karpel_berkala_i'   => $rekap->first()->final_karpel_berkala_i,
                'final_karpim_berkala_ii'  => $rekap->first()->final_karpim_berkala_ii,
                'final_karpel_berkala_ii'  => $rekap->first()->final_karpel_berkala_ii,
                'final_karpim_normal'      => $rekap->first()->final_karpim_normal,
                'final_karpel_normal'      => $rekap->first()->final_karpel_normal,
                'final_karpim_istimewa'    => $rekap->first()->final_karpim_istimewa,
                'final_karpel_istimewa'    => $rekap->first()->final_karpel_istimewa,

                'final_jml_tetap'      => $rekap->first()->final_karpim_tetap + $rekap->first()->final_karpel_tetap,
                'final_jml_berkala_i'  => $rekap->first()->final_karpim_berkala_i + $rekap->first()->final_karpel_berkala_i,
                'final_jml_berkala_ii' => $rekap->first()->final_karpim_berkala_ii + $rekap->first()->final_karpel_berkala_ii,
                'final_jml_normal'     => $rekap->first()->final_karpim_normal + $rekap->first()->final_karpel_normal,
                'final_jml_istimewa'   => $rekap->first()->final_karpim_istimewa + $rekap->first()->final_karpel_istimewa,
            ];

            if (($dataArr['jml_tetap'] >= $data[0]->min_orang) && ($dataArr['jml_tetap'] <= $data[0]->max_orang)) {
                $stat_tetap = "";
            } else {
                $stat_tetap = "class='table-danger'";
            }

            if (($dataArr['jml_berkala_i'] >= $data[1]->min_orang) && ($dataArr['jml_berkala_i'] <= $data[1]->max_orang)) {
                $stat_berkala_i = "";
            } else {
                $stat_berkala_i = "class='table-danger'";
            }

            if (($dataArr['jml_berkala_ii'] >= $data[2]->min_orang) && ($dataArr['jml_berkala_ii'] <= $data[2]->max_orang)) {
                $stat_berkala_ii = "";
            } else {
                $stat_berkala_ii = "class='table-danger'";
            }

            if (($dataArr['jml_normal'] >= $data[3]->min_orang) && ($dataArr['jml_normal'] <= $data[3]->max_orang)) {
                $stat_normal = "";
            } else {
                $stat_normal = "class='table-danger'";
            }

            if (($dataArr['jml_istimewa'] >= $data[4]->min_orang) && ($dataArr['jml_istimewa'] <= $data[4]->max_orang)) {
                $stat_istimewa = "";
            } else {
                $stat_istimewa = "class='table-danger'";
            }




            if (($dataArr['final_jml_tetap'] >= $data[0]->min_orang) && ($dataArr['final_jml_tetap'] <= $data[0]->max_orang)) {
                $final_stat_tetap = "";
            } else {
                $final_stat_tetap = "class='table-danger'";
            }

            if (($dataArr['final_jml_berkala_i'] >= $data[1]->min_orang) && ($dataArr['final_jml_berkala_i'] <= $data[1]->max_orang)) {
                $final_stat_berkala_i = "";
            } else {
                $final_stat_berkala_i = "class='table-danger'";
            }

            if (($dataArr['final_jml_berkala_ii'] >= $data[2]->min_orang) && ($dataArr['final_jml_berkala_ii'] <= $data[2]->max_orang)) {
                $final_stat_berkala_ii = "";
            } else {
                $final_stat_berkala_ii = "class='table-danger'";
            }

            if (($dataArr['final_jml_normal'] >= $data[3]->min_orang) && ($dataArr['final_jml_normal'] <= $data[3]->max_orang)) {
                $final_stat_normal = "";
            } else {
                $final_stat_normal = "class='table-danger'";
            }

            if (($dataArr['final_jml_istimewa'] >= $data[4]->min_orang) && ($dataArr['final_jml_istimewa'] <= $data[4]->max_orang)) {
                $final_stat_istimewa = "";
            } else {
                $final_stat_istimewa = "class='table-danger'";
            }
        }
        
        return view('distribusi.detail', compact('data','rekap','stat_tetap','stat_berkala_i','stat_berkala_ii','stat_normal','stat_istimewa','final_stat_tetap','final_stat_berkala_i','final_stat_berkala_ii','final_stat_normal','final_stat_istimewa','dataArr'));
    }

    public function detail($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cekStatus = DB::table('vw_list_distribusi')->where('indikator_id', $id)->first();
        if ($cekStatus->usul_approve == 0 || $cekStatus->usul_approve == NULL) {
            $data  = Distribusi::where('indikator_id', $id)->orderBy('id')->get();
            $kry   = DistribusiKaryawan::where('divisi_id', $data[0]->divisi_id)->where('indikator_id', $id)->orderBy('nama')->paginate(20);
            $rekap = DB::table('vw_update_usulan')->where('divisi_id', $data[0]->divisi_id)->where('indikator_id', $data[0]->indikator_id)->first();

            return view('distribusi.create', compact(['data','kry','rekap']));
        } else {
            $data  = Distribusi::where('indikator_id', $id)->orderBy('id')->get();
            $kry   = DistribusiKaryawan::where('divisi_id', $data[0]->divisi_id)->where('indikator_id', $id)->orderBy('nama')->paginate(20);
            $rekap = DB::table('vw_update_usulan')->where('divisi_id', $data[0]->divisi_id)->where('indikator_id', $data[0]->indikator_id)->first();

            return view('distribusi.detail_usulan', compact(['data','kry','rekap']));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cekKaryawan = DistribusiKaryawan::where('indikator_id', $id)->whereNull('status')->count();
        if ($cekKaryawan == 0) {
            DistribusiKaryawan::where('usul_approve', 0)->where('indikator_id', $id)->update([
                'usul_approve' => 1
            ]);
            return redirect()->route('distribusi.index')->with('sukses', 'Berhasil, Data Usulan Penilaian berhasil dikirim !');
        } else {
            return back()->with('gagal', 'Gagal, Terdapat Karyawan yang belum mendapatkan penilaian !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_penilaian(Request $request)
    {
        $valid = DB::table('golongans')
                    ->select('golongans.id as id_golongan','golongans.nama_golongan','mkgs.id as id_mkg','mkgs.kode_mkg','golongans.status')
                    ->join('mkgs', 'golongans.id', '=', 'mkgs.golongan_id')
                    ->where('golongans.nama_golongan', '=', $request->gol)
                    ->where('mkgs.kode_mkg', '=', $request->mkg);
        
        if ($valid->count() == 0) { // GOLONGAN DAN MKG TIDAK DITEMUKAN
            return response()->json(['status' => 0]);
        } else { // GOLONGAN DAN MKG DITEMUKAN
            switch ($request->penilaian) {
                case 'TETAP':
                    $varNilai = "TETAP";
                    $golUsul  = $valid->first()->nama_golongan;
                    $mkgUsul  = $valid->first()->kode_mkg;

                    DistribusiKaryawan::where('id', $request->id)->update([
                        'penilaian'       => $varNilai,
                        'gol_usul'        => $golUsul,
                        'mkg_usul'        => $mkgUsul,
                        'status'          => $valid->first()->status,
                        'gol_final'       => $golUsul,
                        'mkg_final'       => $mkgUsul,
                        'penilaian_final' => $varNilai
                    ]);

                    return response()->json(['status' => 4]);
                    break;
                case 'BERKALA I':
                    $next = Mkg::with('golongan')
                            ->where('golongan_id', $valid->first()->id_golongan)
                            ->where('id', '>', $valid->first()->id_mkg)->orderBy('id')->get()->take(1);
    
                    if ($next->count() != 1) { // MASA KERJA MENTOK
                        return response()->json(['status' => 1]);
                    } else {
                        $data     = $next->last();
                        $varNilai = "BERKALA I";
                        $golUsul  = $data->golongan->nama_golongan;
                        $mkgUsul  = $data->kode_mkg;

                        DistribusiKaryawan::where('id', $request->id)->update([
                            'penilaian'       => $varNilai,
                            'gol_usul'        => $golUsul,
                            'mkg_usul'        => $mkgUsul,
                            'status'          => $valid->first()->status,
                            'gol_final'       => $golUsul,
                            'mkg_final'       => $mkgUsul,
                            'penilaian_final' => $varNilai
                        ]);

                        return response()->json(['status' => 4]);
                    }
                    break;
                case 'BERKALA II':
                    $next = Mkg::with('golongan')
                            ->where('golongan_id', $valid->first()->id_golongan)
                            ->where('id', '>', $valid->first()->id_mkg)->orderBy('id')->get()->take(2);
    
                    if ($next->count() != 2) { // MASA KERJA MENTOK
                        return response()->json(['status' => 1]);
                    } else {
                        $data     = $next->last();
                        $varNilai = "BERKALA II";
                        $golUsul  = $data->golongan->nama_golongan;
                        $mkgUsul  = $data->kode_mkg;

                        DistribusiKaryawan::where('id', $request->id)->update([
                            'penilaian'       => $varNilai,
                            'gol_usul'        => $golUsul,
                            'mkg_usul'        => $mkgUsul,
                            'status'          => $valid->first()->status,
                            'gol_final'       => $golUsul,
                            'mkg_final'       => $mkgUsul,
                            'penilaian_final' => $varNilai
                        ]);

                        return response()->json(['status' => 4]);
                    }
                    break;
                case 'NAIK GOLONGAN NORMAL':
                    $max_mkg = Mkg::with('golongan')->where('golongan_id', $valid->first()->id_golongan)->count();
                    $bagi    = floor($max_mkg/2);
    
                    if ((int)$valid->first()->kode_mkg <= $bagi) {
                        return response()->json(['status' => 2]);
                    } else {
                        $next = Mkg::with('golongan')
                                ->where('golongan_id', '>', $valid->first()->id_golongan)->orderBy('id')->first();

                        $varNilai = "NAIK GOLONGAN NORMAL";
                        $golUsul  = $next->golongan->nama_golongan;
                        $mkgUsul  = $next->kode_mkg;

                        DistribusiKaryawan::where('id', $request->id)->update([
                            'penilaian'       => $varNilai,
                            'gol_usul'        => $golUsul,
                            'mkg_usul'        => $mkgUsul,
                            'status'          => $valid->first()->status,
                            'gol_final'       => $golUsul,
                            'mkg_final'       => $mkgUsul,
                            'penilaian_final' => $varNilai
                        ]);

                        return response()->json(['status' => 4]);
                    }
                    
                    break;
                case 'NAIK GOLONGAN ISTIMEWA':
                    $max_mkg = Mkg::with('golongan')->where('golongan_id', $valid->first()->id_golongan)->count();
                    $bagi    = floor($max_mkg/2);
    
                    if ((int)$valid->first()->kode_mkg > $bagi) {
                        return response()->json(['status' => 3]);
                    } else {
                        $next = Mkg::where('golongan_id', '>', $valid->first()->id_golongan)->orderBy('id')->first();

                        $varNilai = "NAIK GOLONGAN ISTIMEWA";
                        $golUsul  = $next->golongan->nama_golongan;
                        $mkgUsul  = $next->kode_mkg;

                        DistribusiKaryawan::where('id', $request->id)->update([
                            'penilaian'       => $varNilai,
                            'gol_usul'        => $golUsul,
                            'mkg_usul'        => $mkgUsul,
                            'status'          => $valid->first()->status,
                            'gol_final'       => $golUsul,
                            'mkg_final'       => $mkgUsul,
                            'penilaian_final' => $varNilai
                        ]);

                        return response()->json(['status' => 4]);
                    }
    
                    break;
                default:
                    DistribusiKaryawan::where('id', $request->id)->update([
                        'penilaian'       => NULL,
                        'gol_usul'        => NULL,
                        'mkg_usul'        => NULL,
                        'status'          => NULL,
                        'gol_final'       => NULL,
                        'mkg_final'       => NULL,
                        'penilaian_final' => NULL
                    ]);

                    return response()->json(['status' => 4]);
                    break;
            }
        }
    }
}
