<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serology extends Model
{
    public function adminpanel()
    {
    	 return $this->belongsTo('App\AdminPanel','admin_panel_id');
    }

    public function doctor()
    {
    	 return $this->belongsTo('App\Doctor','doctor_id');
    }

    public function user()
    {
    	 return $this->belongsTo('App\Doctor','user_id');
    }
}
