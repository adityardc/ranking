<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satuan.index');
    }

    public function listData()
    {
        $query = Satuan::orderBy('id')->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('satuan.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('satuan.destroy', $query->id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('satuan.create');
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
            'kode_satuan' => 'required|max:50',
            'deskripsi'   => 'required|max:150'
        ],[
            'kode_satuan.max'      => 'Maksimal 50 karakter !',
            'kode_satuan.required' => 'Kolom harus diisi !',
            'deskripsi.required'   => 'Kolom harus diisi !',
            'deskripsi.max'        => 'Maksimal 150 karakter !'
        ]);

        $ins              = new Satuan;
        $ins->kode_satuan = $request->kode_satuan;
        $ins->deskripsi   = $request->deskripsi;
        $ins->save();

        return back()->with('sukses', 'Berhasil, Data Satuan berhasil disimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        return view('satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'kode_satuan' => 'required|max:50',
            'deskripsi'   => 'required|max:150'
        ],[
            'kode_satuan.max'      => 'Maksimal 50 karakter !',
            'kode_satuan.required' => 'Kolom harus diisi !',
            'deskripsi.required'   => 'Kolom harus diisi !',
            'deskripsi.max'        => 'Maksimal 150 karakter !'
        ]);

        $satuan->kode_satuan = $request->kode_satuan;
        $satuan->deskripsi   = $request->deskripsi;
        $satuan->update();

        return redirect()->route('satuan.index')->with('sukses', 'Berhasil, Data Satuan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        return back()->with('sukses', 'Berhasil, Data Satuan berhasil dihapus !');
    }
}
