<?php

namespace App\Http\Controllers;

use App\Divisi;
use App\Ptpn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengguna.index');
    }

    public function listData()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR')) {
            $query = User::with(['divisi', 'ptpn'])->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->hasRole('ADMINISTRATOR HOLDING')) {
            $query = User::with(['divisi','ptpn','roles'])
                ->whereHas('roles', function($q){
                    $q->where('name', '!=', 'SUPER ADMINISTRATOR');
                })->orderBy('id', 'desc')->get();
        } else {
            if (Auth::user()->hasRole('ADMINISTRATOR ANPER')) {
                $query = User::with(['divisi','ptpn','roles'])
                ->where('ptpn_id', Auth::user()->ptpn_id)
                ->whereHas('roles', function($q){
                    $q->where('name', '!=', 'SUPER ADMINISTRATOR');
                    $q->where('name', '!=', 'ADMINISTRATOR HOLDING');
                })->orderBy('id', 'desc')->get();
            } else {
                $query = User::with(['divisi','ptpn','roles'])
                ->whereHas('roles', function($q){
                    $q->where('name', '!=', 'SUPER ADMINISTRATOR');
                    $q->where('name', '!=', 'ADMINISTRATOR HOLDING');
                })->orderBy('id', 'desc')->get();
            }
        }
        
        return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('pengguna.edit', $query->uuid);
                })->addColumn('destroy_url', function($query){
                    return route('pengguna.destroy', $query->uuid);
                })->addColumn('hapus_pengguna', function($query){
                    return route('pengguna.hapus', $query->uuid);
                })->addColumn('role', function($query){
                    $x = "";
                    foreach ($query->getRoleNames() as $val) {
                        $x .= "<span class='badge badge-pill badge-danger'><b>".$val."</b></span> ";
                    }

                    return $x;
                })->make(true);
    }

    public function getBagian(Request $request)
    {
        if ($request->id != NULL) {
            $return = '<option value="">.:: PILIH DIVISI/BAGIAN/UNITKERJA ::.</option>';
            foreach(Divisi::where('ptpn_id', $request->id)->get() as $row)
                        $return .= "<option value=".$row->id.">".$row->nama_divisi."</option>";
        } else {
            $return = '<option value="">.:: PILIH DIVISI/BAGIAN/UNITKERJA ::.</option>';
        }
        
        return response()->json($return);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('SUPER ADMINISTRATOR')) {
            $role   = Role::pluck('name','name')->all();
            $divisi = Divisi::orderBy('id')->get();
            $ptpn   = Ptpn::orderBy('id')->get();
        } elseif (Auth::user()->hasRole('ADMINISTRATOR HOLDING')) {
            $role   = Role::where('name', '<>', 'SUPER ADMINISTRATOR')->pluck('name','name')->all();
            $divisi = Divisi::orderBy('id')->get();
            $ptpn   = Ptpn::orderBy('id')->get();
        } else {
            $role   = Role::where('name', '<>', 'SUPER ADMINISTRATOR')->where('name', '<>', 'ADMINISTRATOR HOLDING')->pluck('name','name')->all();
            $divisi = Divisi::where('ptpn_id', Auth::user()->ptpn_id)->orderBy('id')->get();
            $ptpn   = Ptpn::where('id', Auth::user()->ptpn_id)->orderBy('id')->get();
        }

        return view('pengguna.create', compact(['divisi','role','ptpn']));
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
            'name'      => 'required|max:150',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'required|unique:users,username',
        ],[
            'name.required'     => 'Kolom nama harus diisi !',
            'name.max'          => 'Kolom nama maksimal 250 karakter !',
            'email.required'    => 'Kolom email harus diisi !',
            'email.email'       => 'Kolom email tidak valid !',
            'email.unique'      => 'Email sudah digunakan !',
            'username.required' => 'Kolom Username harus diisi !',
            'username.unique'   => 'Username sudah terdaftar !',
        ]);

        $ins            = new User;
        $ins->name      = $request->name;
        $ins->email     = $request->email;
        $ins->divisi_id = $request->divisi_id;
        $ins->ptpn_id   = $request->ptpn_id;
        $ins->username  = $request->username;
        $ins->uuid      = (string) Str::uuid();
        $ins->password  = bcrypt("ptpnsukses");
        $ins->sap_id    = $request->username;
        $ins->save();

        $ins->assignRole($request->roles);

        return back()->with('sukses', 'Pengguna Aplikasi berhasil ditambahkan.');
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
        $user     = User::where('uuid', $id)->first();

        if (Auth::user()->hasRole('SUPER ADMINISTRATOR|ADMINISTRATOR HOLDING')) {
            $roles  = Role::pluck('name','name')->all();
            $divisi = Divisi::orderBy('id')->get();
            $ptpn   = Ptpn::orderBy('id')->get();
        } else {
            $roles  = Role::where('name', '<>', 'SUPER ADMINISTRATOR')->where('name', '<>', 'ADMINISTRATOR HOLDING')->pluck('name','name')->all();
            $divisi = Divisi::where('ptpn_id', Auth::user()->ptpn_id)->orderBy('id')->get();
            $ptpn   = Ptpn::where('id', Auth::user()->ptpn_id)->orderBy('id')->get();
        }

        $userRole = $user->roles->pluck('name','name')->all();
    	return view('pengguna.edit', compact(['user','roles','userRole','divisi','ptpn']));
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
            'name'      => 'required|max:150',
            'email'     => 'required|max:150|unique:users,email,'.$id.',uuid',
            'username'  => 'required|unique:users,username,'.$id.',uuid',
        ],[
            'name.required'     => 'Kolom nama harus diisi !',
            'name.max'          => 'Kolom nama maksimal 250 karakter !',
            'email.required'    => 'Kolom email harus diisi !',
            'email.max'         => 'Kolom email maksimal 250 karakter !',
            'email.unique'      => 'Email sudah digunakan !',
            'username.required' => 'Kolom email harus diisi !',
            'username.unique'   => 'Email sudah digunakan !',
        ]);

        $upd            = User::where('uuid', $id)->first();
        $upd->name      = $request->name;
        $upd->email     = $request->email;
        $upd->ptpn_id   = $request->ptpn_id;
        $upd->divisi_id = $request->divisi_id;
        $upd->username  = $request->username;

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $upd->assignRole($request->input('roles'));

        $upd->update();

        return redirect()->route('pengguna.index')->with('sukses', 'Pengguna Aplikasi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reset             = User::where('uuid', $id)->first();
        $reset->password   = bcrypt("ptpnsukses");
        $reset->updated_at = $reset->created_at;
        $reset->update();

        return back()->with('sukses', 'Data Password berhasil direset !');
    }

    public function hapus_pengguna($id)
    {
        User::where('uuid', $id)->delete();
        return back()->with('sukses', 'Data Pengguna Aplikasi berhasil dihapus !');
    }
}
