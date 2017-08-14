<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function xray_p()
    {
        return $this->hasMany('App\Patientxray','physician_id','id');
    }
}
