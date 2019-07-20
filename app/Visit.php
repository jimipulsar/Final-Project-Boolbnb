<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['ip', 'room_id','created_ad', 'updated_at'];

    public function room(){
        return $this->belongsTo('App\Room');
    }
}
