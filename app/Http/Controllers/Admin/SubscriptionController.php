<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Traits\UploadAble;


class SubscriptionController extends BaseController
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=SubscriptionController@index called");
        $this->setPageTitle('Subscriptions', 'List All Subscribers');

        $subscriptions = Subscription::all();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function destroy($id)
    {
        \Log::info("Req=SubscriptionController@destroy called");
        $subscriber = Subscription::findOrFail($id);
        if($subscriber)
        {
            $subscriber->delete();
            return $this->responseRedirect('admin.subscriptions.index', 'Subscription has been deleted successfully', 'success');
        }
        return $this->responseRedirectBack('Error occurred while deleting subscription', 'error', true, true);

    }
}
