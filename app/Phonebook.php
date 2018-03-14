<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    //

     protected $fillable = [
        'user_id', 'name',
    ];


    public function contact()
    {
    	return $this->hasMany('App\Contact', 'phonebook_id');
    }
}
