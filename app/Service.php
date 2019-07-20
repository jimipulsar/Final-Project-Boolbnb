<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;

class Service extends Model
{

  public function rooms()
  {
    return $this->belongsToMany('App\Room');
  }

  // protected $fillable = [
  // 'service_id',
  // 'status_id',
  // 'title'
  // ];

}
