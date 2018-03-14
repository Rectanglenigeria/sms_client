<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Sms;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class SmsController extends Controller
{
    //

    public function showSendForm(){

    	$phonebooks=Phonebook::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

    	return view('sms.create', ['phonebooks'=>$phonebooks]);
    }



    public function showAchieved(){
    	$smses=Sms::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
    	return view('sms.achieved.view', ['smses'=>$smses]);
    }


    public function fasttrackShowSendForm($phonebook_id){
    	$phonebooks=Phonebook::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

    	return view('sms.create', ['phonebooks'=>$phonebooks, 'fphonebook_id'=>$phonebook_id]);

    }


    public function deleteSMS($id){
    	Sms::where('id', $id)->delete();
    	return Redirect::to('/achieved')->with('notification', 'sms deleted successfully');
    }

    public function resendSMS($id){
    	$sms=Sms::where('id', $id)->first();

    	//make api calls to ebulksms endpoint
         //get phonebook contacts
         $contacts=Contact::where('phonebook_id', $sms->phonebook_id)->orderBy('id', 'desc')->get();

         //foreach loop
         $count=1;
         foreach($contacts as $contact){
         	//make api call

         	 $json_url = "http://api.ebulksms.com:8080/sendsms.json";
              $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
              $username = null;
              $apikey = null;

                  $username = "smilesteadily@gmail.com";
                  $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
                  $sendername = substr($sms->sennder, 0, 11);
                  $recipients = $contact->phone;
                  $message = $sms->body;
                  $flash = 0;
                  if (get_magic_quotes_gpc()) {
                      $message = stripslashes($message);
                  }
                  $message = substr($message, 0, 160);
              #Use the next line for HTTP POST with JSON
                  $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
              #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                  //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);
              $count++;
         }



        //return to view

         return Redirect::to('/sendsms')->with('notification', 'SMS resent to '.$count.' contacts successfully' );



    }



    public function send(Request $request){

    	$formData=$request->all();

        $rule=array(
            'phonebook_id'=>'required',
            'sender'=>'required|max:11',
            'title'=>'required',
            'body'=>'required|max:160',
            );

        $message=array(
            'phonebook_id.required'=>'Phonebook is required.',
            'sender.required'=>"Sender's name is required.",
            'sender.max'=>"Sender's name cannot be more that 160 in length",
            'title.required'=>'Title is required.',
            'body.required'=>'Body is required.',
            'body.max'=>'SMS cannot be more that 160 in length',

            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/sendsms')->withErrors($validator);

        }else{


        if($request->phonebook_id==null){
        	return Redirect::to('/sendsms')->with('notification', 'Phonebook is required');

        }


       //pass sms to model
        $sms=new Sms;
        $sms->user_id=Auth::user()->id;
        $sms->phonebook_id=$request->phonebook_id;
        $sms->sender=$request->sender;
        $sms->title=$request->title;
        $sms->body=$request->body;
        $sms->remember_token=$request->_token;
        $sms->save();

        //make api calls to ebulksms endpoint
         //get phonebook contacts
         $contacts=Contact::where('phonebook_id', $request->phonebook_id)->orderBy('id', 'desc')->get();

         //foreach loop
         $count=1;
         foreach($contacts as $contact){
         	//make api call

         	 $json_url = "http://api.ebulksms.com:8080/sendsms.json";
              $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
              $username = null;
              $apikey = null;

                  $username = "smilesteadily@gmail.com";
                  $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
                  $sendername = substr($request->sender, 0, 11);
                  $recipients = $contact->phone;
                  $message = $request->body;
                  $flash = 0;
                  if (get_magic_quotes_gpc()) {
                      $message = stripslashes($message);
                  }
                  $message = substr($message, 0, 160);
              #Use the next line for HTTP POST with JSON
                  $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
              #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                  //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);
              $count++;
         }



        //return to view

         return Redirect::to('/sendsms')->with('notification', 'SMS sent to '.$count.' contacts successfully' );


            
          

           
        }

    }






     //SMS gateway RestFul API functions

    public function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $gsm = array();
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    foreach ($arr_recipient as $recipient) {
      $mobilenumber = trim($recipient);
      if (substr($mobilenumber, 0, 1) == '0'){
          $mobilenumber = $country_code . substr($mobilenumber, 1);
      }
      elseif (substr($mobilenumber, 0, 1) == '+'){
          $mobilenumber = substr($mobilenumber, 1);
      }
      $generated_id = uniqid('int_', false);
      $generated_id = substr($generated_id, 0, 30);
      $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
    }
    $message = array(
      'sender' => $sendername,
      'messagetext' => $messagetext,
      'flash' => "{$flash}",
    );

    $request = array('SMS' => array(
          'auth' => array(
              'username' => $username,
              'apikey' => $apikey
          ),
          'message' => $message,
          'recipients' => $gsm
    ));
    $json_data = json_encode($request);
    if ($json_data) {
      $response = $this->doPostRequest($url, $json_data, array('Content-Type: application/json'));
      $result = json_decode($response);
      return $result->response->status;
    } else {
      return false;
    }
    }

    //Function to connect to SMS sending server using HTTP POST

    public function doPostRequest($url, $data, $headers = array('Content-Type: application/x-www-form-urlencoded'))
    {
    $php_errormsg = '';
    if (is_array($data)) {
      $data = http_build_query($data, '', '&');
    }
    $params = array('http' => array(
          'method' => 'POST',
          'content' => $data)
    );
    if ($headers !== null) {
      $params['http']['header'] = $headers;
    }
    $ctx = stream_context_create($params);
    $fp = fopen($url, 'rb', false, $ctx);
    if (!$fp) {
      return "Error: gateway is inaccessible";
    }
    //stream_set_timeout($fp, 0, 250);
    try {
      $response = stream_get_contents($fp);
      if ($response === false) {
          throw new Exception("Problem reading data from $url, $php_errormsg");
      }
      return $response;
    } catch (Exception $e) {
      $response = $e->getMessage();
      return $response;
    }
    }
}
