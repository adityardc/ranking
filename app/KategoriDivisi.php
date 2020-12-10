<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriDivisi extends Model
{
    public function kategori()
    {
        return $this->belongsTo('App\Kategori')->withTrashed();
    }
}
