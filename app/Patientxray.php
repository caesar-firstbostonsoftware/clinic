<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patientxray extends Model
{
    public function doctor()
    {
    	 return $this->belongsTo('App\Doctor','physician_id');
    }

    public function patient()
    {
    	 return $this->belongsTo('App\Patient','patient_id');
    }

    public function xraydate()
    {
    	 return $this->hasMany('App\PatientXrayLog','xray_id')->latest()->take(1);
    }
}
