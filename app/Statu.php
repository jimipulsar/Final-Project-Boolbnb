<?php

namespace App;
use App\Service;

use Illuminate\Database\Eloquent\Model;

class Statu extends Model
{
  public function services()
  {
      return $this->hasMany(Service::class);
  }
  public function rooms()
  {
    return $this->hasMany('App\Room');
  }

  protected $fillable = [
  'status_id',
  'title',
  'status'
  ];
}
