<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    public function patient()
    {
    	 return $this->belongsTo('App\Patient','patient_id');
    }

    public function receipt()
    {
    	 return $this->belongsTo('App\ReceiptNumber','patient_id','patient_id');
    }

    public function service()
    {
    	 return $this->hasMany('App\PatientService','patient_id','patient_id');
    }
}
