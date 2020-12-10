<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = Auth::user();
        $x = "";
        foreach ($dataUser->getRoleNames() as $val) {
            $x .= $val;
        }
        return view('beranda.index', compact(['dataUser','x']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function change_password()
    {
        $id  = Auth::user()->id;
        $url = url('ganti_password/'.$id.'/update_password');
        return view('layouts.change_password', compact(['id','url']));
    }

    public function update_password(Request $request, $id)
    {
        $request->validate([
            'pwd1' => 'required|max:150',
            'pwd2' => 'required|max:150|same:pwd1'
        ],[
            'pwd1.max'      => 'Maksimal 150 karakter !',
            'pwd1.required' => 'Kolom harus diisi !',
            'pwd2.required' => 'Kolom harus diisi !',
            'pwd2.same'     => 'Password tidak sama !',
            'pwd2.max'      => 'Maksimal 150 karakter !'
        ]);

        $us             = User::findOrFail($id);
        $us->password   = bcrypt($request->pwd1);
        $us->updated_at = Carbon::now();
        $us->update();

        return redirect()->route('beranda')->with('sukses', 'Password berhasil diubah.');
    }

    public function edit_profile($id)
    {
        $data = User::where('uuid', $id)->first();
        return view('beranda.edit_profile', compact('data'));
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|max:150',
            'email'    => 'required|email|unique:users,email,'.$id.',uuid',
            'username' => 'required|unique:users,username,'.$id.',uuid',
            'pwd1'     => 'max:150',
            'pwd2'     => 'max:150|same:pwd1'
        ],[
            'name.required'     => 'Kolom nama harus diisi !',
            'name.max'          => 'Kolom nama maksimal 250 karakter !',
            'email.required'    => 'Kolom email harus diisi !',
            'email.email'       => 'Kolom email tidak valid !',
            'email.unique'      => 'Email sudah digunakan !',
            'username.required' => 'Kolom Username harus diisi !',
            'username.unique'   => 'Username sudah terdaftar !',
            'pwd1.max'          => 'Maksimal 150 karakter !',
            'pwd2.same'         => 'Password tidak sama !',
            'pwd2.max'          => 'Maksimal 150 karakter !'
        ]);

        $upd = User::where('uuid', $id)->first();
        $upd->name = $request->name;
        $upd->email = $request->email;
        $upd->username = $request->username;

        if ($request->pwd1 != NULL) {
            $upd->password = bcrypt($request->pwd1);
        }

        $upd->update();

        return redirect()->route('beranda')->with('sukses', 'Data Profile Pengguna Aplikasi berhasil diubah !');
    }
}
