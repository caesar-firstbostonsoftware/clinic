<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastMedicalHistory extends Model
{
    public function surgery1001()
    {
        return $this->hasMany('App\Surgery','pmh_id','id');
    }
    public function hospitalization()
    {
        return $this->hasMany('App\Hospitalization','pmh_id','id');
    }
    public function disease()
    {
        return $this->hasMany('App\Disease','pmh_id','id');
    }
    public function vaccination1001()
    {
        return $this->hasMany('App\Vaccination','pmh_id','id');
    }
}
