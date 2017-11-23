<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientService extends Model
{
    public function adminP()
    {
    	 return $this->belongsTo('App\AdminPanel','admin_panel_id');
    }

    public function adminsubP()
    {
    	 return $this->belongsTo('App\AdminPanelSub','admin_panel_sub_id');
    }

    public function patient()
    {
    	 return $this->belongsTo('App\Patient','patient_id');
    }

    public function xrayservice1001()
    {
         return $this->belongsTo('App\AdminPanel','admin_panel_sub_id');
    }

}
