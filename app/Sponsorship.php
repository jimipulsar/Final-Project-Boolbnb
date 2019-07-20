<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
use App\SponsorshipType;
use Carbon\Carbon;


class Sponsorship extends Model
{
    public function room(){
       return $this->belongsTo('App\Room');
    }

    public function sponsorshipsType(){
      return $this->belongsTo('App\SponsorshipsType');
    }

    public function scopeIsActiveSponsorship($query, $room_id){
        $now = Carbon::now();
        if($query->where('room_id',$room_id)->whereDate('sponsor_expired', '>=' ,$now)->first()){
            return true;
        }
        return false;
    }

}
