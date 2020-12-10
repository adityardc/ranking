<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;
use DataTables;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan.index');
    }

    public function listData()
    {
        $query = Jabatan::orderBy('nama_jabatan')->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('jabatan.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('jabatan.destroy', $query->id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
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
            'nama_jabatan' => 'required|max:150|unique:jabatans,nama_jabatan'
        ],[
            'nama_jabatan.unique'   => 'Nama Jabatan sudah terdaftar !',
            'nama_jabatan.max'      => 'Maksimal 150 karakter !',
            'nama_jabatan.required' => 'Kolom harus diisi !',
        ]);

        $divisi               = new Jabatan;
        $divisi->nama_jabatan = $request->nama_jabatan;
        $divisi->save();

        return back()->with('sukses', 'Data Jabatan '.$request->nama_jabatan.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact(['jabatan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:150'
        ],[
            'nama_jabatan.max'      => 'Maksimal 150 karakter !',
            'nama_jabatan.required' => 'Kolom harus diisi !'
        ]);

        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->update();

        return redirect()->route('jabatan.index')->with('sukses', 'Data Jabatan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return back()->with('sukses', 'Data Jabatan berhasil dihapus !');
    }
}
