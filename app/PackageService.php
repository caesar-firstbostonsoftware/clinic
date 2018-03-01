<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    public function service()
    {
    	 return $this->belongsTo('App\AdminPanel','service_id');
    }
}
