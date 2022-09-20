<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use App\Models\DetailsOrder;
use App\Models\Order;
use App\Models\OrderStatus;
use DB;
use App\Repositories\OrderRepository;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Email\OrderEmailsController;

class orderController extends BaseController
{
    protected $emailSender;

    private $order;
    /**
     * @var OrderRepository
     */
    private $orderRepo;

    public function __construct(OrderRepository $orderRepo, OrderEmailsController $emailSender)
    {
        \Log::info("Req=OrderController@__construct called");
        $this->orderRepo = $orderRepo;
        $this->emailSender =  $emailSender;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=OrderController@index called");
		$this->setPageTitle('Order', 'List All Orders');
		$orders = $this->orderRepo->listOrders();
		return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display a new orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function notSent()
    {
        $orders = $this->order->where('order_status', 0)->with(['address', 'giftCard', 'users', 'payment'])->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        \Log::info("Req=OrderController@delete called");
		$deleteOrder = $this->orderRepo->deleteOrder($id);

		if(!$deleteOrder){
			return $this->responseRedirectBack('Error occured while deleting order', 'error', true, true);
		}

		return $this->responseRedirect('admin.orders.index', 'order has been deleted successfully', 'success');
    }


    // Update order status
    public function updateStatus(Request $request){
        // dd($request);
        $id = $request->order_id;
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $orderStatus = new OrderStatus([
            'order_id' => $order->id,
            'status' => $request->status,
            'comments' => $request->comment
        ]);
        $order->orderStatus()->save($orderStatus);
        $order->save();

        $this->emailSender->orderStatusEmail($order, $request);

        $this->setFlashMessage('order status has been updated successfully', 'success');
        $this->showFlashMessages();
        return true;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        \Log::info("Req=OrderController@show called");
		$this->setPageTitle('Order Details', '');
        $order = $this->orderRepo->findOrderById($id);
        $orderItems = $order->items;
        $order->order_status = 1;
        $order->save();

        return view('admin.orders.show', compact('order','orderItems'));
    }



    /**
     * @param $id
     * @return Response
     */
    public function detailDestroy($id)
    {
        $this->orderRepo->checkId($id);
        $d_order = DetailsOrder::findOrFail($id)->delete();
        return $this->orderRepo->passViewAfterDeleted($d_order, 'detailsOrders');

    }

    public function status($id, $status)
    {
        $order = $this->orderRepo->find($id);
        $email = $order->client_email;
        if ($status == 'sent') {
            $editedOrder = $order->update(['order_status' => 2]);
            $order = ['code' => "$order->track_code", 'status' => 'sent '];
        } elseif ($status == 'delivered') {
            $editedOrder = $order->update(['order_status' => 3]);
            $order = ['code' => "$order->track_code", 'status' => 'posted'];
        }
        //should be on jobs
        //        Mail::to($email)->send(new OrderMail($order));
        if (!isset($editedOrder)) {
            $editedOrder = false;
        }
        return $this->orderRepo->passResponse($editedOrder, 'orders', 'status');

    }
}
