<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //user contact page
    public function contact(){
        // dd($id);
        // $userName = $request->userName;
        // dd($userName);
        return view('USER.ContactFolder.contact');
    }

    //send message button
    public function sendMessage(Request $request){
        $userName = $request->userName;
        $userEmail = $request->userEmail;
        $userMessage = $request->userMessage;
        $data = [
            'name' => $userName,
            'email' => $userEmail,
            'message' => $userMessage,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $insertData = Contact::insert([$data]);
        // if($insertData){
        //     // return view('USER.MainFolder.home');
        //     echo '<h1 style="color:red; text-align:center;">Successfully sent your message. Thank You!</h1>';
        // }
        return redirect()->route('user#home')->with(['messageSent'=>'Your message has been sent successfully. Thank you!']);
    }
}
