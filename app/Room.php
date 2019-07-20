<?php

namespace App;

use App\Service;
use App\Statu;
use App\Message;
use App\Sponsorship;
use App\User;
use App\Visit;
use Illuminate\Support\Carbon;

// use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // use Sortable;
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    
    // public $sortable = ['title', 'price', 'description', 'n_rooms', 'n_beds', 'n_baths',  'indirizzo', 'service_id','status_id'
    // ]; 
    protected $fillable = [
        'title', 'price', 'description', 'cover', 'house_number', 'locality', 'postal_code', 'state', 'latitude', 'longitude', 'n_rooms', 'n_beds', 'n_baths', 'metri_quadrati', 'street', 'user_id','service_id', 'published'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function services(){
        return $this->belongsToMany('App\Service');
    }
    public function sponsorship(){
        return $this->hasOne('App\Sponsorship');
    }

    public function visits(){
        return $this->hasMany('App\Visit');
    }

    public function status()
    {
        return $this->belongsTo(Statu::class);
    }

    public function scopeRadius($query, $longitude, $latitude, $radius){
        return $query->selectRaw("*, ST_DISTANCE_SPHERE(
              POINT($longitude, $latitude),
              POINT(longitude, latitude)) as distance")->whereRaw("
          ST_DISTANCE_SPHERE(
              POINT($longitude, $latitude),
              POINT(longitude, latitude)) < $radius")->orderBy('distance', 'desc');
      }
  
      public function scopeAllActiveSponsorhips($query){
          $now = Carbon::now();
          return $query->where('published', true)->whereHas('sponsorship', function ($query) use ($now) {
              $query->whereDate('sponsor_expired', '>=' ,$now)->orderBy('created_at', 'ASC');
          });
      }
  
      public function scopeUserActiveSponsorhips($query, $user_id){
          $now = Carbon::now();
          return $query->where('published', true)->where('user_id', $user_id)->whereHas('sponsorship', function ($query) use ($now) {
              $query->whereDate('sponsor_expired', '>=' ,$now)->orderBy('created_at', 'ASC');
          });
      }


}
