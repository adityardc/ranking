<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index');
    }

    public function listData()
    {
        $query = Kategori::orderBy('nama_kategori')->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('kategori.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('kategori.destroy', $query->id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama_kategori' => 'required|max:150'
        ],[
            'nama_kategori.max'      => 'Maksimal 150 karakter !',
            'nama_kategori.required' => 'Kolom harus diisi !'
        ]);

        $divisi                = new Kategori;
        $divisi->nama_kategori = $request->nama_kategori;
        $divisi->save();

        return back()->with('sukses', 'Data Kategori '.$request->nama_kategori.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:150'
        ],[
            'nama_kategori.max'      => 'Maksimal 150 karakter !',
            'nama_kategori.required' => 'Kolom harus diisi !'
        ]);

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return redirect()->route('kategori.index')->with('sukses', 'Data Kategori berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return back()->with('sukses', 'Data Kategori berhasil dihapus !');
    }
}
