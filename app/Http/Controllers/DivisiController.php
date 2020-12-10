<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Kategori;
use App\KategoriDivisi;
use App\Ptpn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('divisi.index');
    }

    public function listData()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $query = Divisi::with('ptpn')->orderBy('id')->get();
        } else {
            $query = Divisi::with('ptpn')->where('ptpn_id', Auth::user()->ptpn_id)->orderBy('id')->get();
        }
        
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('divisi.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('divisi.destroy', $query->id);
                })->addColumn('kat', function($query){
                    $x = "";
                    foreach ($query->kategoridivisis as $val) {
                        $x .= "<span class='badge badge-pill badge-primary'><b>".$val->kategori->nama_kategori."</b></span> ";
                    }

                    return $x;
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $ptpn = Ptpn::orderBy('id')->get();
        } else {
            $ptpn = Ptpn::orderBy('id')->where('id', Auth::user()->ptpn_id)->get();
        }
        
        $kat  = Kategori::orderBy('nama_kategori')->get();
        return view('divisi.create', compact(['ptpn','kat']));
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
            'nama_divisi' => 'required|max:150',
            'kode_divisi' => 'required|max:150'
        ],[
            'nama_divisi.max'      => 'Maksimal 150 karakter !',
            'nama_divisi.required' => 'Kolom harus diisi !',
            'kode_divisi.required' => 'Kolom harus diisi !',
            'kode_divisi.max'      => 'Maksimal 150 karakter !'
        ]);

        $divisi              = new Divisi;
        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->kode_divisi = $request->kode_divisi;
        $divisi->ptpn_id     = $request->ptpn_id;
        $divisi->save();

        $arrData_poll = [];
        $katdiv       = $request->komoditas;

        for ($i=0; $i < count($katdiv); $i++) {
            if ($katdiv[$i] != NULL) {
                $arrData_poll[] = [
                    'divisi_id'   => $divisi->id,
                    'kategori_id' => $katdiv[$i],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ];
            }
        }

        KategoriDivisi::insert($arrData_poll);

        return back()->with('sukses', 'Data Divisi '.$request->nama_divisi.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Divisi $divisi)
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR')) {
            $ptpn = Ptpn::orderBy('id')->get();
        } else {
            $ptpn = Ptpn::orderBy('id')->where('id', Auth::user()->ptpn_id)->get();
        }
        
        $kat      = Kategori::orderBy('nama_kategori')->get();
        $userRole = $divisi->kategoridivisis->pluck('kategori_id','kategori_id')->all();
        return view('divisi.edit', compact(['ptpn','divisi','kat','userRole']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divisi $divisi)
    {
        $request->validate([
            'nama_divisi' => 'required|max:150',
            'kode_divisi' => 'required|max:150'
        ],[
            'nama_divisi.max'      => 'Maksimal 150 karakter !',
            'nama_divisi.required' => 'Kolom harus diisi !',
            'kode_divisi.required' => 'Kolom harus diisi !',
            'kode_divisi.max'      => 'Maksimal 150 karakter !'
        ]);

        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->kode_divisi = $request->kode_divisi;
        $divisi->ptpn_id     = $request->ptpn_id;
        $divisi->update();

        $arrData_poll = [];
        $katdiv       = $request->komoditas;

        for ($i=0; $i < count($katdiv); $i++) {
            if ($katdiv[$i] != NULL) {
                $arrData_poll[] = [
                    'divisi_id'   => $divisi->id,
                    'kategori_id' => $katdiv[$i],
                    'created_at'  => Carbon::now(),
                    'updated_at'  => Carbon::now(),
                ];
            }
        }

        KategoriDivisi::where('divisi_id', $divisi->id)->delete();
        KategoriDivisi::insert($arrData_poll);

        return redirect()->route('divisi.index')->with('sukses', 'Data Divisi berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        return back()->with('sukses', 'Data Divisi berhasil dihapus !');
    }
}
