<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;
use App\Http\Controllers\Email\EmailsController;


class SubscriptionsController extends Controller
{
    protected $emailSender;

    public function __construct(EmailsController $emailSender){
		\Log::info("Req=SubscriptionsController@__construct called");
		$this->emailSender = $emailSender;
    }
    
    public function create(Request $request)
    {
		\Log::info("Req=SubscriptionsController@create called");
        $request->validate([
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:subscriptions'],
        ]);
        
        $subscription = Subscription::create([
            'email'=>$request->email,
            'subscription_tokken'=>uniqid(24)
        ]);

        if(!$subscription){
            return redirect()->back()->with('error', 'Something went wrong');
        }
        $this->emailSender->unsubscribeEmail($subscription);
        return redirect()->back()->with('message', 'Subscription successfull');
    }

    public function delete($token)
    {
        \Log::info("Req=SubscriptionsController@delete called");
        $subscription = Subscription::where('subscription_tokken',$token)->first();
        $responseMessage ='';
        $response_status = false;
        if($subscription)
        {
            $responseMessage = $subscription->email." has been unsubscribed from our newslatter.";
            $subscription->delete();
            $response_status = true;
            return view('site.pages.unsubscriberesponse',compact('response_status','responseMessage'));
        }
        $responseMessage = "We don't have any matching record!";

        return view('site.pages.unsubscriberesponse', compact('response_status','responseMessage'));
    }
}
