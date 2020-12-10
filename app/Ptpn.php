<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ptpn extends Model
{
    use SoftDeletes;

    public function setCompanyAttribute($value)
    {
    	$this->attributes['company'] = strtoupper($value);
    }

    public function setCompanyCodeAttribute($value)
    {
    	$this->attributes['company_code'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
    	$this->attributes['description'] = strtoupper($value);
    }

    public function setAddressAttribute($value)
    {
    	$this->attributes['address'] = strtoupper($value);
    }
}
