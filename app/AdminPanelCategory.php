<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPanelCategory extends Model
{
    public function adminpanel()
    {
    	 return $this->hasMany('App\AdminPanel','admin_panel_cat_id');
    }
}
