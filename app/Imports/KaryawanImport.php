<?php

namespace App\Imports;

use App\DistribusiKaryawan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KaryawanImport implements ToModel, WithStartRow
{
    private $rows = 0;

    public function __construct($param)
    {
        $this->divisi = $param;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
        return new DistribusiKaryawan([
            'nama'          => $row[1],
            'nik'           => $row[2],
            'divisi_id'     => $this->divisi,
            'ptpn_id'       => Auth::user()->ptpn_id,
            'sub_bagian'    => $row[3],
            'gol_awal'      => $row[4],
            'mkg_awal'      => $row[5],
            'usul_approve'  => 0,
            'final_approve' => 0
        ]);
    }

    public function getRowCount() : int
    {
        return $this->rows;
    }

    public function startRow(): int
    {
        return 2;
    }
}
