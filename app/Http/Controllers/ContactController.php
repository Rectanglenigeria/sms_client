<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class ContactController extends Controller
{
    //

    public function view($phonebook_id){
    	$contacts=Contact::where('phonebook_id', $phonebook_id)->orderBy('id', 'desc')->paginate(50);

    	$phonebook_name=Phonebook::where('id', $phonebook_id)->first();
    	$phonebook_name=$phonebook_name->name;

    	return view('contact.view', ['contacts'=>$contacts, 'phonebook_name'=>$phonebook_name]);
    }


    public function delete($id){
    	$phonebook_id=Contact::where('id', $id)->first()->phonebook_id;
    	Contact::where('id', $id)->delete();

    	return Redirect::to('contact/view/'.$phonebook_id)->with('notification', 'Contact successfully deleted');


    }


}
