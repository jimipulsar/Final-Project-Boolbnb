<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\User;
use App\Room;

class Message extends Model
{
   // use SoftDeletes;

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function room(){
      return $this->belongsTo('App\Room');
    }
}
