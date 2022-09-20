<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Mail;
use App\Models\Order;
use App\Models\ContactEmail;

class EmailsController extends BaseController
{

    public function index(){
        \Log::info("Req=EmailsController@index called");
        $this->setPageTitle('Contact US', 'Contact Us Messages');
        $contactMessages = contactEmail::all();
        return view('admin.contactmails.index', compact('contactMessages'));
    }

    public function updateStatus(Request $request)
    {
        \Log::info("Req=EmailsController@updateStatus called");
        $message = ContactEmail::findOrFail($request->id);
        if($message){
            $message->status = 1;
            $message->save();
            return json_encode($message);
        }
        return false;
    }

    public function delete($id)
    {
        \Log::info("Req=EmailsController@delete called");
        $message = ContactEmail::findOrFail($id);
        if($message){
            $message->delete();
            return $this->responseRedirect('admin.contactmails.index', 'Mail deleted successfully', 'success');
        }
        return $this->responseRedirectBack('Error occured while deleting mail', 'error', true, true);
    }

    public function contactEmail(Request $request)
    {
    	\Log::info("Req=EmailsController@contactEmail called");
        // dd($request);
        $name = $request->name;
        $subject = "Contact Form On ".config('settings.site_name');

        $emailData = ContactEmail::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "message"=>$request->message
        ]);

        $data = array('name' => $name, 'subject'=>$subject,'email'=>$request->email, 'mail_message'=>$request->message);
        Mail::send('emails.contactmail', $data, function ($message) use($subject,$name){
            $message->to(config('settings.contect_smtp_to_email'), config('settings.site_name'))->subject
                ($subject);
            $message->from(config('settings.contect_smtp_user'), $name);
        });
        if(Mail::failures()){
            return redirect()->back()->with('error', 'Sorry ! we are unable send message. Please try again later.');
		}
        return redirect()->back()->with('message', 'Message sent successfully.');
    }

    public function unsubscribeEmail($mailData)
    {
    	\Log::info("Req=EmailsController@unsubscribeEmail called");
        $name = $mailData->email;
        $message = "Thank you for subscribing to our news letter. now you will receive latest news updates from ".config('settings.site_name')
        ."<br> to unsubscirbe click on this link: ".route('subscription.unsubscribe',$mailData->subscription_tokken);
        $subject = "Successfully Subscribed on ".config('settings.site_name');

        $data = array('name' => $name, 'subject'=>$subject,'email'=>$mailData->email, 'mail_message'=>$message);
        Mail::send('emails.unsubscribeemail', $data, function ($message) use($subject,$name){
            $message->to($name, $name)->subject
                ($subject);
            $message->from(config('settings.contect_smtp_user'), config('settings.site_name'));
        });
        if(Mail::failures()){
            return false;
		}
        return true;
    }
}
