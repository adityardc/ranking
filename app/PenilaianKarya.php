<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenilaianKarya extends Model
{
    public function divisi()
    {
        return $this->belongsTo('App\Divisi')->withTrashed();
    }

    public function ptpn()
    {
        return $this->belongsTo('App\Ptpn')->withTrashed();
    }
}
