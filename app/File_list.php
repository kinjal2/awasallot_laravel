<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File_list extends Model
{
    //
    protected $table ='master.file_list';


    public function user()
    {
      //  return $this->belongsTo('App\User', 'id', 'uid');
    }
}

