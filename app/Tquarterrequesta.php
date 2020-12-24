<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tquarterrequesta extends Model
{
    //
    protected $table ='master.t_quarter_request_a';
  
    protected $primaryKey = ['quartertype', 'requestid','uid','rivision_id'];
    public $incrementing = false;
}
