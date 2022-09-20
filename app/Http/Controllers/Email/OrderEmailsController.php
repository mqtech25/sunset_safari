<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Mail;
use App\Models\Order;

class OrderEMailsController extends BaseController
{


    //Customer order reciept email
    public function customerOrderReceipt(Order $order)
    {
        $name = $order->first_name . " " . $order->last_name;
        Mail::send('emails.new_order_customer_email', compact('order'), function ($message) use ($order, $name) {
            $message->to($order->email, $name)->subject
                ('New Order Email');
            $message->from(config('settings.contect_smtp_user'), config('settings.site_name'));
        });
        if (Mail::failures()) {
            return false;
        }
        return true;
    }


    public function adminOrderReceipt(Order $order)
    {
        Mail::send('emails.new_order_admin_email', compact('order'), function ($message) use ($order) {
            $message->to(config('settings.contect_smtp_to_email'), config('settings.site_name'))->subject
                ('New Order On'.config('settings.site_name'));
            $message->from(config('settings.contect_smtp_user'), config('settings.site_name'));
        });
        if (Mail::failures()) {
            return false;
        }
        return true;
    }

    public function orderStatusEmail(Order $order, Request $request)
    {
        $name = $order->first_name . " " . $order->last_name;
        Mail::send('emails.order_status_email', compact('order','request'), function ($message) use ($order, $name) {
            $message->to($order->email, $name)->subject
                ('Order#: '.$order->order_number.' Updated');
            $message->from(config('settings.contect_smtp_user'), config('settings.site_name'));
        });
        if (Mail::failures()) {
            return false;
        }
        return true;
    }

    public function supportForm(Request $request)
    {
        // dd($request);
        $name = "Support Mail";
        $data = array('name' => $name, 'subject' => $request->issue_subject, 'email' => $request->email, 'mail_message' => $request->issue_details);

        Mail::send('emails.contactmail', $data, function ($message) use ($request, $name) {
            $message->to(config('settings.contect_smtp_to_email'), config('settings.site_name'))->subject
                ($request->issue_subject);
            $message->from(config('settings.contect_smtp_user'), $name);
            // dd($message);
        });
        if (Mail::failures()) {
            return $this->responseRedirectBack('Error occured while sending Email', 'error', true, true);
        }
        return $this->responseRedirect('orders', 'We have received your messag and will get back to you as soon as possible', 'success');
    }

    public function refundEmail($order_number, $email, $customerName)
    {
        $subject = 'Complain Received Regarding Order# ' . $order_number;
        $request_details = 'Hi ' . $customerName . ' We received your complain regarding ' . $order_number . ', We are reviewing your request and after that we will get back to you as soon as possible.';
        $name = config('settings.site_name');
        $data = array('name' => $name, 'subject' => $subject, 'email' => $email, 'mail_message' => $request_details);

        Mail::send('emails.contactmail', $data, function ($message) use ($email, $customerName, $subject, $name) {
            $message->to($email, $customerName)->subject
                ($subject);
            $message->from(config('settings.contect_smtp_user'), $name);
        });
    }

    public function attachment_email()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail', $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
                ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
}
