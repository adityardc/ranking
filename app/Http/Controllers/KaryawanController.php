<?php

namespace App\Http\Controllers;

use App\DistribusiKaryawan;
use App\Divisi;
use App\User;
use App\Golongan;
use App\Imports\KaryawanImport;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $div = Divisi::where('ptpn_id', Auth::user()->ptpn_id)->get();
        return view('karyawan.index', compact('div'));
    }

    public function listData()
    {
        // $query = DistribusiKaryawan::with('divisi')->where('divisi_id', Auth::user()->divisi_id)->where('usul_approve', 0)->orderBy('nama')->get();
        $query = DistribusiKaryawan::with(['ptpn','divisi'])->where('ptpn_id', Auth::user()->ptpn_id)->whereNull('status')->get();

    	return Datatables::of($query)
                ->addColumn('edit_url', function($query){
                    return route('karyawan.edit', $query->id);
                })->addColumn('destroy_url', function($query){
                    return route('karyawan.destroy', $query->id);
                })->addColumn('gol', function($query){
                    return $query->gol_awal."/".$query->mkg_awal;
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gol = Golongan::orderBy('nama_golongan')->get();
        $div = Divisi::where('ptpn_id', Auth::user()->ptpn_id)->get();
        return view('karyawan.create', compact(['gol','div']));
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
            'nik'       => 'required|unique:distribusi_karyawans,nik',
            'nama'      => 'required|max:150',
            'gol_awal'  => 'required',
            'mkg_awal'  => 'required',
            'divisi_id' => 'required'
        ],[
            'nik.required'       => 'Kolom ID SAP harus diisi !',
            'nik.unique'         => 'ID SAP Karyawan sudah terdaftar !',
            'nama.required'      => 'Kolom Nama Karyawan harus diisi !',
            'nama.max'           => 'Kolom Nama Karyawan maksimal 150 karakter !',
            'gol_awal.required'  => 'Pilih Golongan terlebih dahulu !',
            'mkg_awal.required'  => 'Pilih Mkg terlebih dahulu !',
            'divisi_id.required' => 'Pilih Nama Divisi terlebih dahulu !',
        ]);

        $ins                = new DistribusiKaryawan;
        $ins->nama          = $request->nama;
        $ins->nik           = $request->nik;
        $ins->gol_awal      = $request->gol_awal;
        $ins->mkg_awal      = $request->mkg_awal;
        $ins->divisi_id     = $request->divisi_id;
        $ins->ptpn_id       = Auth::user()->ptpn_id;
        $ins->sub_bagian    = $request->sub_bagian;
        $ins->usul_approve  = 0;
        $ins->final_approve = 0;
        $ins->save();

        return back()->with('sukses', 'Berhasil, Karyawan '.$request->nama.' berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(User $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(DistribusiKaryawan $karyawan)
    {
        $gol = Golongan::orderBy('nama_golongan')->get();
        $div = Divisi::where('ptpn_id', Auth::user()->ptpn_id)->get();
        return view('karyawan.edit', compact(['karyawan','gol','div']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DistribusiKaryawan $karyawan)
    {
        $request->validate([
            'nik'       => 'required|unique:distribusi_karyawans,id,'.$karyawan->id,
            'nama'      => 'required|max:150',
            'gol_awal'  => 'required',
            'mkg_awal'  => 'required',
            'divisi_id' => 'required'
        ],[
            'nik.required'       => 'Kolom ID SAP harus diisi !',
            'nik.unique'         => 'ID SAP Karyawan sudah terdaftar !',
            'nama.required'      => 'Kolom Nama Karyawan harus diisi !',
            'nama.max'           => 'Kolom Nama Karyawan maksimal 150 karakter !',
            'gol_awal.required'  => 'Pilih Golongan terlebih dahulu !',
            'mkg_awal.required'  => 'Pilih Mkg terlebih dahulu !',
            'divisi_id.required' => 'Pilih Nama Divisi terlebih dahulu !'
        ]);

        $karyawan->nama       = $request->nama;
        $karyawan->nik        = $request->nik;
        $karyawan->gol_awal   = $request->gol_awal;
        $karyawan->mkg_awal   = $request->mkg_awal;
        $karyawan->divisi_id  = $request->divisi_id;
        $karyawan->sub_bagian = $request->sub_bagian;
        $karyawan->update();

        return redirect()->route('karyawan.index')->with('sukses', 'Data Karyawan '.$karyawan->nama.' berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistribusiKaryawan $karyawan)
    {
        $karyawan->delete();
        return back()->with('sukses', 'Data Karyawan '.$karyawan->nama.' berhasil dihapus !');
    }

    public function download_template()
    {
        return response()->download("assets/libs/Template Data Karyawan.xlsx");
    }

    public function mass_store(Request $request)
    {
        $request->validate([
            'fileKaryawan' => 'required|mimes:xls,xlsx',
        ],[
            'fileKaryawan.required' => 'File Upload tidak boleh kosong !',
            'fileKaryawan.mimes'    => 'File Upload harus ber-extensi : .xls atau .xlsx !',
        ]);

        if ($request->hasFile('fileKaryawan')) {
            $file       = $request->file('fileKaryawan');
            $fileImport = new KaryawanImport($request->divisi_id);

            try{
                Excel::import($fileImport, $file);
                return back()->with("sukses", "Upload Data Berhasil. Jumlah baris : ".$fileImport->getRowCount());

                // Excel::load($request->file('fileKaryawan')->getRealPath(), function ($reader) {
                //     foreach ($reader->toArray() as $key => $row) {
                //         $data['nama']       = $row['nama'];
                //         $data['nik']        = $row['nik'];
                //         $data['sub_bagian'] = $row['sub_bagian'];
                //         $data['gol_awal']   = $row['gol_awal'];
                //         $data['mkg_awal']   = $row['mkg_awal'];
    
                //         if(!empty($data)) {
                //             DB::table('distribusi_karyawans')->insert($data);
                //         }
                //     }
                // });
            }catch(\Maatwebsite\Excel\Validators\ValidationException $e){
                // $failures = $e->failures();

                // foreach ($failures as $failure) {
                //     $failure->row(); // row that went wrong
                //     $failure->attribute(); // either heading key (if using heading row concern) or column index
                //     $failure->errors(); // Actual error messages from Laravel validator
                //     $failure->values(); // The values of the row that has failed.
                // }

                // dd("salah");
                return back()->with("gagal, Format unggah tidak sesuai template.");
            }
        } else {
            return back()->with('gagal', 'Silahkan pilih berkas terlebih dahulu !');
        }
    }

    public function mass_delete(Request $request)
    {
        DistribusiKaryawan::where('ptpn_id', Auth::user()->ptpn_id)->where('divisi_id', $request->divisi_id)->whereNull('status')->delete();
        return response()->json($request->divisi_id);
    }
}
