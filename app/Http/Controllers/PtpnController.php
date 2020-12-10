<?php

namespace App\Http\Controllers;

use App\Ptpn;
use Illuminate\Http\Request;
use DataTables;

class PtpnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ptpn.index');
    }

    public function listData()
    {
        $query = Ptpn::orderBy('id')->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('ptpn.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('ptpn.destroy', $query->id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ptpn.create');
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
            'company'      => 'required|max:150',
            'company_code' => 'required|max:10',
            'description'  => 'required',
            'address'      => 'required'
        ],[
            'company.max'           => 'Maksimal 150 karakter !',
            'company.required'      => 'Kolom Nama Perusahaan harus diisi !',
            'company_code.required' => 'Kolom Kode Perusahaan harus diisi !',
            'company_code.max'      => 'Maksimal 10 karakter !',
            'description.required'  => 'Kolom Deskripsi Perusahaan harus diisi !',
            'address.required'      => 'Kolom Alamat Perusahaan harus diisi !',
        ]);

        $ptpn               = new Ptpn;
        $ptpn->company      = $request->company;
        $ptpn->company_code = $request->company_code;
        $ptpn->description  = $request->description;
        $ptpn->address      = $request->address;
        $ptpn->save();

        return back()->with('sukses', 'Data Perusahaan berhasil ditambah !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ptpn  $ptpn
     * @return \Illuminate\Http\Response
     */
    public function show(Ptpn $ptpn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ptpn  $ptpn
     * @return \Illuminate\Http\Response
     */
    public function edit(Ptpn $ptpn)
    {
        return view('ptpn.edit', compact('ptpn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ptpn  $ptpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ptpn $ptpn)
    {
        $request->validate([
            'company'      => 'required|max:150',
            'company_code' => 'required|max:10',
            'description'  => 'required',
            'address'      => 'required'
        ],[
            'company.max'           => 'Maksimal 150 karakter !',
            'company.required'      => 'Kolom Nama Perusahaan harus diisi !',
            'company_code.required' => 'Kolom Kode Perusahaan harus diisi !',
            'company_code.max'      => 'Maksimal 10 karakter !',
            'description.required'  => 'Kolom Deskripsi Perusahaan harus diisi !',
            'address.required'      => 'Kolom Alamat Perusahaan harus diisi !',
        ]);

        $ptpn->company      = $request->company;
        $ptpn->company_code = $request->company_code;
        $ptpn->description  = $request->description;
        $ptpn->address      = $request->address;
        $ptpn->update();

        return redirect()->route('ptpn.index')->with('sukses', 'Data Perusahaan berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ptpn  $ptpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ptpn $ptpn)
    {
        $ptpn->delete();

        return back()->with('sukses', 'Data Perusahaan berhasil dihapus !');
    }
}
