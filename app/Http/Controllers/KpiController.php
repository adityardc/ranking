<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Kpi;
use App\Satuan;
use Illuminate\Http\Request;
use DataTables;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kpi.index');
    }

    public function listData()
    {
        $query = Kpi::with(['kategori','satuan'])->whereHas('kategori', function($q){
            $q->orderBy('nama_kategori');
        })->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('kpi.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('kpi.destroy', $query->id);
                })->addColumn('icon_html', function($query){
                    if ($query->icon == 0) {
                        $x = "<button type='button' class='btn btn-success btn-xs'><i class='mdi mdi-transfer-up'></i></button>";
                    } else {
                        $x = "<button type='button' class='btn btn-danger btn-xs'><i class='mdi mdi-transfer-down'></i></button>";
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
        $kat = Kategori::orderBy('nama_kategori')->get();
        $sat = Satuan::orderBy('id')->get();
        return view('kpi.create', compact(['kat','sat']));
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
            'nama_kpi'    => 'required',
            'kategori_id' => 'required',
            'icon'        => 'required',
            'satuan_id'   => 'required'
        ],[
            'nama_kpi.required'    => 'Kolom harus diisi !',
            'kategori_id.required' => 'Pilih Kategori salah satu !',
            'icon.required'        => 'Pilih Icon salah satu !',
            'satuan_id.required'   => 'Pilih Satuan salah satu !',
        ]);

        $kpi              = new Kpi;
        $kpi->nama_kpi    = $request->nama_kpi;
        $kpi->kategori_id = $request->kategori_id;
        $kpi->icon        = $request->icon;
        $kpi->satuan_id   = $request->satuan_id;
        $kpi->save();

        return back()->with('sukses', 'Data KPI '.$request->nama_kpi.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function show(Kpi $kpi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kpi $kpi)
    {
        $kat = Kategori::orderBy('nama_kategori')->get();
        $sat = Satuan::orderBy('id')->get();
        return view('kpi.edit', compact(['kpi','kat','sat']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kpi $kpi)
    {
        $request->validate([
            'nama_kpi'    => 'required',
            'kategori_id' => 'required',
            'icon'        => 'required',
            'satuan_id'   => 'required'
        ],[
            'nama_kpi.required'    => 'Kolom harus diisi !',
            'kategori_id.required' => 'Pilih Kategori salah satu !',
            'icon.required'        => 'Pilih Icon salah satu !',
            'satuan_id.required'   => 'Pilih Satuan salah satu !',
        ]);

        $kpi->nama_kpi    = $request->nama_kpi;
        $kpi->kategori_id = $request->kategori_id;
        $kpi->icon        = $request->icon;
        $kpi->satuan_id   = $request->satuan_id;
        $kpi->update();

        return redirect()->route('kpi.index')->with('sukses', 'Data KPI berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kpi  $kpi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kpi $kpi)
    {
        $kpi->delete();
        return back()->with('sukses', 'Data KPI berhasil dihapus !');
    }
}
