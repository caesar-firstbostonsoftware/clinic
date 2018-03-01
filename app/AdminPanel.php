<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPanel extends Model
{
    public function price123()
    {
    	 return $this->belongsTo('App\ServicePrice','id','admin_panel_sub_id');
    }

    public function package()
    {
    	 return $this->hasMany('App\PackageService','package_id');
    }
}
