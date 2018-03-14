<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    //

     protected $fillable = [
        'phonebook_id', 'title', 'body',
    ];

    public function phonebook()
    {
    	return $this->belongsTo('App\Phonebook', 'phonebook_id');
    }

}
