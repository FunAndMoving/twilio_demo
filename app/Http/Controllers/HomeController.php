<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersPhoneNumber;
use App\Models\Message_logs;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;


class HomeController extends Controller
{
    public function show()
    {
        $users = UsersPhoneNumber::all();
        return view('index', compact("users"));
    }
    /**
     * Store a new user phone number.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storePhoneNumber(Request $request)
    {
        //run validation on data sent in
        $validatedData = $request->validate([
            'phone_number' => 'required|unique:users_phone_number',
        ]);
        $user_phone_number_model = new UsersPhoneNumber($request->all());
        $user_phone_number_model->save();
        $this->sendMessage('User registration successful!!', $request->phone_number);
        return back()->with(['success' => "{$request->phone_number} registered"]);
    }
    /**
     * Send message to a selected users
     */
    public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'users' => 'required',
            'body' => 'required',
        ]);
        $recipients = $validatedData["users"];
        // iterate over the array of recipients and send a twilio request for each
        foreach ($recipients as $recipient) {
            $this->sendMessage($validatedData["body"], $recipient);
        }
        return back()->with(['success' => "Messages on their way!"]);
    }
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients Number of recipient
     */
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        //dd($recipients);
        $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
        Message_logs::create([
            'user_id' => 1,
            'direction' => 'inbound',
            'sender' => $twilio_number, 
            'recipient'=>$recipients,
            'message_body' => $message,
        ]);
    }

    public function get_list()
    {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $messages = $twilio->messages
                        ->read([],20);
        // dd($messages);
        // foreach ($messages as $record) {
        //     print($record);
        // }
        return view('sent_message_list', compact("messages"));
    }

    public function received_message()
    {
        $response = new MessagingResponse();
        dd($response);
    }

}
