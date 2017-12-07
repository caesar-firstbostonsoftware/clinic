<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urinalyses extends Model
{
    public function phy()
    {
    	 return $this->belongsTo('App\Doctor','physician_id');
    }

    public function user()
    {
    	 return $this->belongsTo('App\Doctor','user_id');
    }

    public function patient()
    {
    	 return $this->belongsTo('App\Patient','patient_id');
    }

    public function doctor()
    {
         return $this->belongsTo('App\Doctor','physician_id');
    }
}
