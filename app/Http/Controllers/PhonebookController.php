<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Contact;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PhonebookController extends Controller
{
    //
    public function showCreateForm(){
    	return view('phonebook.create');
    }



    public function view(){
    	$phonebooks=Phonebook::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

    	$phonebook_count=Phonebook::where('user_id', Auth::user()->id)->count();

    	//$contact_count=Contact::where('phonebook_id', $phonebook_id)->count();


    	return view('phonebook.view', ['phonebooks'=>$phonebooks, 'phonebook_count'=>$phonebook_count]);
    }

    public function deletePhonebook($phonebook_id){
    	Phonebook::where('id', $phonebook_id)->delete();
    	Contact::where('phonebook_id', $phonebook_id)->delete();
    	Sms::where('phonebook_id', $phonebook_id)->delete();

    	return Redirect::to('viewph')->with('notification', 'Phonebook successfully deleted');


    }

    


    public function create(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'name'=>'required',
            'file'=>'required',
            );

        $message=array(
            'name.required'=>'Name of phonebook is required.',
            'file.required'=>'CSV file is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/createph')->withErrors($validator);

        }else{









if($request->hasFile('file')){
    		$file=$request->file('file');

        $fileName=$file->getClientOriginalName();

        //validate intaganographic : php script in image formData
        if(stripos($fileName, 'php')){
          return Redirect::to('createph')->with('notification','file must not contain "php" keyword. Kindly rename the file');
        }

    		$file->move('public/uploads',$file->getClientOriginalName());



    		//pass to phonebook model

        	$phonebook= new Phonebook;

        	$phonebook->user_id=Auth::user()->id;

        	$phonebook->name=$request->name;

        	$phonebook->remember_token=$request->_token;

        	$phonebook->save();


        	$phonebook1=Phonebook::where([['name', $request->name],['user_id', Auth::user()->id]])->first();
        	$phonebook_id=$phonebook1->id;


        	$uploaded_file='public/uploads/'.$file->getClientOriginalName();

        	//opening the file

        	$myfile = fopen($uploaded_file, "r") or die("Unable to open file!");

			// Output one line until end-of-file
			while(!feof($myfile)) {

  			$text=fgets($myfile);

			if (strpos($text, ',') !== false) {
    			$phone=explode(',', $text)[0];
			}else{
				$phone=$text;
			}

  			//$phone=explode(',', $text)[0];

  			//pass to model

  			$contact=new Contact;

  			$contact->phonebook_id=$phonebook_id;

  			$contact->phone=$phone;

  			$contact->remember_token=$request->_token;

  			$contact->save();


			}

			fclose($myfile);


    	
    		



    		return Redirect::to('createph')->with('notification','Phonebook successfully created');
    	}else{

    		return Redirect::to('createph')->with('notification','No file');

    	}







            
          

           
        }
    }

}





//Matchuser::where('id', $request->matchId)->update(['payment_status' =>2]);
        //specify payment_type
       /* $match=Matchuser::where('id', $request->matchId)->first();
        if((($match->gsmile->amount - $match->amount)/100) == 90){
          Matchuser::where('id', $request->matchId)->update(['payment_type' =>1]);
        }*/

        //Matchuser::where('id', $request->matchId)->update(['payment_status' =>2]);


    		//Cconfirmation::where('match_id', $request->matchId)->update(['teller_link' => $file->getClientOriginalName()]);

        //specify payment_type
      /*  $confirm=Cconfirmation::where('match_id', $request->matchId)->first();
        if((($match->gsmile->amount - $match->amount)/100) == 90){

          Cconfirmation::where('match_id', $request->matchId)->update(['payment_type' =>1]);
        }*/

    		//Cconfirmation::where('match_id', $request->matchId)->update(['payment_status' =>2]);



