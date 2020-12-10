<?php

namespace App\Http\Controllers;

use App\PenilaianKarya;
use App\Ptpn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianKaryaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('karya.index');
    }

    public function listData()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $query = DB::table('penilaian_karyas')
                    ->select('penilaian_karyas.ptpn_id', 'ptpns.company')
                    ->join('ptpns', 'ptpns.id', '=', 'penilaian_karyas.ptpn_id')
                    ->groupBy('penilaian_karyas.ptpn_id', 'ptpns.company')
                    ->get();
        } else {
            $query = DB::table('penilaian_karyas')
                    ->select('penilaian_karyas.ptpn_id', 'ptpns.company')
                    ->join('ptpns', 'ptpns.id', '=', 'penilaian_karyas.ptpn_id')
                    ->where('penilaian_karyas.ptpn_id', Auth::user()->ptpn_id)
                    ->groupBy('penilaian_karyas.ptpn_id', 'ptpns.company')
                    ->get();
        }

        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('penilaian_karya.edit', $query->ptpn_id);
                })->addColumn('show_url', function($query){
                    return route('penilaian_karya.show', $query->ptpn_id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ptpn = Ptpn::orderBy('company')->get();
        return view('karya.create', compact('ptpn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ptpn_id' => 'required',
        ],[
            'ptpn_id.required' => 'Kolom harus diisi !',
        ]);

        $cek = PenilaianKarya::where('ptpn_id', $request->ptpn_id)->count();
        if ($cek == 0) {
            $simpan = array(
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "TETAP",
                    'jenis_rkap' => "KURANG",
                    'min'        => $request->tetap_kurang_min,
                    'max'        => $request->tetap_kurang_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "TETAP",
                    'jenis_rkap' => "SAMA",
                    'min'        => $request->tetap_sama_min,
                    'max'        => $request->tetap_sama_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "TETAP",
                    'jenis_rkap' => "LEBIH",
                    'min'        => $request->tetap_lebih_min,
                    'max'        => $request->tetap_lebih_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA I",
                    'jenis_rkap' => "KURANG",
                    'min'        => $request->berkala_1_kurang_min,
                    'max'        => $request->berkala_1_kurang_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA I",
                    'jenis_rkap' => "SAMA",
                    'min'        => $request->berkala_1_sama_min,
                    'max'        => $request->berkala_1_sama_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA I",
                    'jenis_rkap' => "LEBIH",
                    'min'        => $request->berkala_1_lebih_min,
                    'max'        => $request->berkala_1_lebih_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA II",
                    'jenis_rkap' => "KURANG",
                    'min'        => $request->berkala_2_kurang_min,
                    'max'        => $request->berkala_2_kurang_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA II",
                    'jenis_rkap' => "SAMA",
                    'min'        => $request->berkala_2_sama_min,
                    'max'        => $request->berkala_2_sama_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "BERKALA II",
                    'jenis_rkap' => "LEBIH",
                    'min'        => $request->berkala_2_lebih_min,
                    'max'        => $request->berkala_2_lebih_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK NORMAL",
                    'jenis_rkap' => "KURANG",
                    'min'        => $request->naik_normal_kurang_min,
                    'max'        => $request->naik_normal_kurang_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK NORMAL",
                    'jenis_rkap' => "SAMA",
                    'min'        => $request->naik_normal_sama_min,
                    'max'        => $request->naik_normal_sama_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK NORMAL",
                    'jenis_rkap' => "LEBIH",
                    'min'        => $request->naik_normal_lebih_min,
                    'max'        => $request->naik_normal_lebih_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK ISTIMEWA",
                    'jenis_rkap' => "KURANG",
                    'min'        => $request->naik_istimewa_kurang_min,
                    'max'        => $request->naik_istimewa_kurang_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK ISTIMEWA",
                    'jenis_rkap' => "SAMA",
                    'min'        => $request->naik_istimewa_sama_min,
                    'max'        => $request->naik_istimewa_sama_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'ptpn_id'    => $request->ptpn_id,
                    'rangking'   => "NAIK ISTIMEWA",
                    'jenis_rkap' => "LEBIH",
                    'min'        => $request->naik_istimewa_lebih_min,
                    'max'        => $request->naik_istimewa_lebih_max,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
            );
    
            PenilaianKarya::insert($simpan);

            return back()->with('sukses', 'Berhasil, Data berhasil disimpan !');
        } else {
            return back()->with('gagal', 'Gagal, Data Perusahaan sudah terdaftar !')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PenilaianKarya  $penilaianKarya
     * @return \Illuminate\Http\Response
     */
    public function show($penilaianKarya)
    {
        $data = PenilaianKarya::where('ptpn_id', $penilaianKarya)->orderBy('id')->get();
        $ptpn = $data->first()->ptpn->company;
        return view('karya.detail', compact(['data','ptpn']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PenilaianKarya  $penilaianKarya
     * @return \Illuminate\Http\Response
     */
    public function edit($penilaianKarya)
    {
        $data = PenilaianKarya::where('ptpn_id', $penilaianKarya)->orderBy('id')->get();
        $ptpn = $data->first()->ptpn->company;
        return view('karya.edit', compact(['data','ptpn']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PenilaianKarya  $penilaianKarya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penilaianKarya)
    {
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'TETAP')->where('jenis_rkap', 'KURANG')->update(array('min' => $request->tetap_kurang_min, 'max' => $request->tetap_kurang_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'TETAP')->where('jenis_rkap', 'SAMA')->update(array('min' => $request->tetap_sama_min, 'max' => $request->tetap_sama_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'TETAP')->where('jenis_rkap', 'LEBIH')->update(array('min' => $request->tetap_lebih_min, 'max' => $request->tetap_lebih_max));

        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA I')->where('jenis_rkap', 'KURANG')->update(array('min' => $request->berkala_1_kurang_min, 'max' => $request->berkala_1_kurang_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA I')->where('jenis_rkap', 'SAMA')->update(array('min' => $request->berkala_1_sama_min, 'max' => $request->berkala_1_sama_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA I')->where('jenis_rkap', 'LEBIH')->update(array('min' => $request->berkala_1_lebih_min, 'max' => $request->berkala_1_lebih_max));

        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA II')->where('jenis_rkap', 'KURANG')->update(array('min' => $request->berkala_2_kurang_min, 'max' => $request->berkala_2_kurang_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA II')->where('jenis_rkap', 'SAMA')->update(array('min' => $request->berkala_2_sama_min, 'max' => $request->berkala_2_sama_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'BERKALA II')->where('jenis_rkap', 'LEBIH')->update(array('min' => $request->berkala_2_lebih_min, 'max' => $request->berkala_2_lebih_max));

        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK NORMAL')->where('jenis_rkap', 'KURANG')->update(array('min' => $request->naik_normal_kurang_min, 'max' => $request->naik_normal_kurang_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK NORMAL')->where('jenis_rkap', 'SAMA')->update(array('min' => $request->naik_normal_sama_min, 'max' => $request->naik_normal_sama_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK NORMAL')->where('jenis_rkap', 'LEBIH')->update(array('min' => $request->naik_normal_lebih_min, 'max' => $request->naik_normal_lebih_max));

        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK ISTIMEWA')->where('jenis_rkap', 'KURANG')->update(array('min' => $request->naik_istimewa_kurang_min, 'max' => $request->naik_istimewa_kurang_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK ISTIMEWA')->where('jenis_rkap', 'SAMA')->update(array('min' => $request->naik_istimewa_sama_min, 'max' => $request->naik_istimewa_sama_max));
        DB::table('penilaian_karyas')->where('ptpn_id', $penilaianKarya)->where('rangking', 'NAIK ISTIMEWA')->where('jenis_rkap', 'LEBIH')->update(array('min' => $request->naik_istimewa_lebih_min, 'max' => $request->naik_istimewa_lebih_max));

        return redirect()->route('penilaian_karya.index')->with('sukses', 'Berhasil, Data Penilaian Karya berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PenilaianKarya  $penilaianKarya
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenilaianKarya $penilaianKarya)
    {
        //
    }
}
