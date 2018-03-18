<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chemistry extends Model
{
    public function doctor()
    {
    	 return $this->belongsTo('App\Doctor','doc_id');
    }

    public function user()
    {
    	 return $this->belongsTo('App\Doctor','user_id');
    }
}
