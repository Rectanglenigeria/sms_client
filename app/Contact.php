<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    protected $fillable = [
        'phonebook_id', 'number',
    ];


    public function phonebook()
    {
    	return $this->belongsTo('App\Phonebook', 'phonebook_id');
    }

   

}
