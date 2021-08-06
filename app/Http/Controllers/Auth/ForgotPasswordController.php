<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\User;
use App\Mail\Forgot;
use App\Websitesetting;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm(){
        return view('auth.passwords.forgote');
    }

    public function sendResetLinkEmail(Request $request){
        $data = $request->all();
        $getWebInfo = Websitesetting::select('website_name', 'website_logo', 'email', 'address', 'mobile')->first();
        
        //echo $data['email'];
        $user = User::where('email',$data['email'])->first();

        if($user){
            //$user = User::where('email',$data['email'])->first();

         $content = [
             'title'         => 'Forgot Password Link', 
             'body'          => 'The body of your message.',
             'address'       => $getWebInfo->address,
             'mobile'        => $getWebInfo->mobile,
             'email'        => $getWebInfo->email,
             'website_name'  => $getWebInfo->website_name,
             'website_logo'  => $getWebInfo->website_logo,
             'user'           => $user,
        ];
        //$receiverAddress = array('manish@nrt.co.in');
        $receiverAddress = array($user->email);

        //return view('emails.forgot',compact('content'));
        $mail = Mail::to($receiverAddress)->send(new Forgot($content) );
        if (count(Mail::failures()) > 0) {
            //echo "There was one or more failures. They were: <br />";
            foreach (Mail::failures as $email_address) {
              //  echo " - $email_address <br />";
            }
             return redirect()->route('password.request')
            ->with('error',
             'mail Failed');
        }else {
             return redirect()->route('password.request')
            ->with('message',
             'Change Password link send in your mail');
        }
      }else{
          return redirect()->route('password.request')
            ->with('error',
             'Invalid User..');  
    }
    

        /////////////    

    }

    public function showForgotForm($id){
        try {
             $user_id = decrypt($id);
        } catch (\RuntimeException  $e) {
            //echo "string";
            return redirect('error/pageNotFound');
        }
        
        $user = User::where('id',$user_id)->first();
        return view('auth.passwords.forgotPassword',compact('user'));
        //echo "string";
    }
    public function changeForgotPassword(Request $request){
        $data = $request->all();
        $user = User::findOrFail($data['userId']); 
         $this->validate($request, [
            'password'=>'required|min:6|confirmed',
        ]);
        $input = $request->only(['password']);
        $user->fill($input)->save();
          return redirect()->route('password.request')
            ->with('message',
             'Password update successfully.');
    }


}
