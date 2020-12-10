<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permissions.index');
    }

    public function listData()
    {
        $query = Permission::all();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('permissions.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('permissions.destroy', $query->id);
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|max:150|unique:permissions,name'
        ],[
            'name.max'      => 'Maksimal 150 karakter !',
            'name.required' => 'Kolom harus diisi !',
            'name.unique'   => 'Permissions sudah terdaftar !'
        ]);

        $ins             = new Permission;
        $ins->name       = $request->name;
        $ins->guard_name = "web";
        $ins->save();

        return back()->with('sukses', 'Data Permissions '.$request->name.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $data = Permission::findOrFail($id);
        return view('permissions.edit', compact('data'));
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
        $request->validate([
            'name' => 'required|max:150|unique:permissions,name,'.$id
        ],[
            'name.max'      => 'Maksimal 150 karakter !',
            'name.required' => 'Kolom harus diisi !',
            'name.unique'   => 'Permissions sudah terdaftar !'
        ]);

        $upd       = Permission::findOrFail($id);
        $upd->name = $request->name;
        $upd->update();

        return redirect()->route('permissions.index')->with('sukses', 'Data Permissions berhasil diubah !');
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
}
