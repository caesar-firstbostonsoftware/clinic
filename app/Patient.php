<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function lastvisit()
    {
    	 return $this->belongsTo('App\PatientVisit','id','patient_id')->orderBy('visitid','asc');
    }

    public function company()
    {
    	 return $this->belongsTo('App\Company','company_id');
    }
}
