<?php

namespace App\Http\Controllers\Customer;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Mail\forgetpassword;
use App\Models\New_Customer;
use Illuminate\Http\Request;
use App\Mail\CustomerConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class ForgotPasswordController
{
  public function getEmail()
  {    
    
    return view('auth.passwords.email');           
  }
  
 public function postEmail( Request $request)
  { 
      $request->validate([
          'email'=>'required|email'
      ]);

      $customer = New_Customer::where('email', $request->email)->first();              

      if ($customer != null) {
          $customer->verify_otp = rand(100000, 999999);
          Mail::to($customer->email)->send(new forgetpassword($customer->verify_otp));
          $message = "Your OTP for " . config('app.name') . " Reset Password is :" . $customer->verify_otp;
          $this->sendsms($customer->phone, $customer->name, $message);
          $customer->save();
          $request->session()->flash('success','Reset Password Link Has Been Sent To Your Mail !!');
          return redirect('/')->with('succes', 'We sent you a link for change passaword in your email.');
      } else {
        $request->session()->flash('error','Something Went Wrong !!');
          return back()->with('error', 'Your email is not matched with Our Record.');
      }
  }

  public function sendSMS($phone, $user, $message)
    {
        $args = http_build_query(array(
            'token' => 'v2_D6dwvR99byLEZwjvr2qc7upDQyn.g7y8',
            'from'  => 'Mystore',
            'to'    =>  $phone,
            'text'  => 'Dear ' . $user . ',' . $message
        ));
        $url = "http://api.sparrowsms.com/v2/sms/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }

}
