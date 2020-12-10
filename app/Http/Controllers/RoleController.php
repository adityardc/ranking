<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index');
    }

    public function listData()
    {        
        $query = Role::with('permissions')->get();
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('role.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('role.destroy', $query->id);
                })->addColumn('macam', function($query){
                    $x = "";
                    foreach ($query->permissions as $key => $value) {
                        $x .= "<div class='badge badge-primary mr-1 mb-1'>".$value->name."</div>";
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
        $permission = Permission::get();
        return view('role.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return back()->with('sukses', 'Data Role '.$request->name.' berhasil ditambahkan !');
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
        $data            = Role::where('id', $id)->first();
        $permission      = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                        ->all();

        return view('role.edit', compact('data','permission','rolePermissions'));
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
        $this->validate($request, [
            'name'       => 'required|unique:roles,name,'.$id,
            'permission' => 'required',
        ]);

        $role       = Role::where('id', $id)->first();
        $role->name = $request->name;
        $role->update();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')->with('sukses', 'Data Role berhasil diubah !');
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
