<?php

namespace App\Http\Controllers\Site;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Paypal;
use Redirect;
use Session;

class PaypalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        if (config('settings.paypal-mode') == 'sandbox') {
            $mode = 'sandbox';
            $endPoint = 'https://api.sandbox.paypal.com';
        } else {
            $mode = 'live';
            $endPoint = 'https://api.paypal.com';
        }
        $this->_apiContext = PayPal::ApiContext(config('settings.paypal_client_id'),config('settings.paypal_client_id'));

        $this->_apiContext->setConfig(array(
            'mode' => $mode,
            'service.EndPoint' => $endPoint,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => public_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE',
        ));
    }

    public function getCheckout(Order $order)
    {

        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
        $amount = PayPal::Amount();
        $amount->setCurrency('USD');

        $amount->setTotal($order->grand_total);
        $description = 'Payment for order completion';

        // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.
        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($description);
        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(url('paypal/payment/done'));
        $redirectUrls->setCancelUrl(url('paypal/payment/cancel'));
        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));
        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to($redirectUrl);
    }

   

    public function getCancel(Request $request)
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        $request->session()->forget('order_id');
        $request->session()->forget('payment_data');
        flash(__('Payment cancelled'))->success();
        return redirect()->route('home');
    }

    public function getDone(Request $request)
    {
        $payment_id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');

        if ($request->session()->has('payment_type')) {

            if ($request->session()->get('payment_type') == 'cart_payment') {
                $this->_apiContext = PayPal::ApiContext(
                    env('PAYPAL_CLIENT_ID'),
                    env('PAYPAL_CLIENT_SECRET'));

                $payment = PayPal::getById($payment_id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $payment = json_encode($executePayment);

                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done($request->session()->get('order_id'), $payment);
            } elseif ($request->session()->get('payment_type') == 'download_payment') {
                $this->_apiContext = PayPal::ApiContext(
                    env('PAYPAL_CLIENT_ID'),
                    env('PAYPAL_CLIENT_SECRET'));

                $payment = PayPal::getById($payment_id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $payment = json_encode($executePayment);

                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done_download(Session::get('order_detail')['id'], $payment);
            } elseif ($request->session()->get('payment_type') == 'seller_payment') {
                $seller = Seller::findOrFail(Session::get('payment_data')['seller_id']);
                $this->_apiContext = PayPal::ApiContext(
                    $seller->paypal_client_id,
                    $seller->paypal_client_secret);

                $payment = PayPal::getById($payment_id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $payment = json_encode($executePayment);

                $commissionController = new CommissionController;
                return $commissionController->seller_payment_done($request->session()->get('payment_data'), $payment);
            } elseif ($request->session()->get('payment_type') == 'wallet_payment') {
                $this->_apiContext = PayPal::ApiContext(
                    env('PAYPAL_CLIENT_ID'),
                    env('PAYPAL_CLIENT_SECRET'));

                $payment = PayPal::getById($payment_id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $payment = json_encode($executePayment);

                $walletController = new WalletController;
                return $walletController->wallet_payment_done($request->session()->get('payment_data'), $payment);
            } elseif ($request->session()->get('payment_type') == 'package_payment') {
                $this->_apiContext = PayPal::ApiContext(
                    env('PAYPAL_CLIENT_ID'),
                    env('PAYPAL_CLIENT_SECRET'));

                $payment = PayPal::getById($payment_id, $this->_apiContext);
                $paymentExecution = PayPal::PaymentExecution();
                $paymentExecution->setPayerId($payer_id);
                $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

                $payment = json_encode($executePayment);

                $customer_package_controller = new CustomerPackageController;
                return $customer_package_controller->purchase_payment_done($request->session()->get('payment_data')['customer_package_id'], $payment);
            }
        }
    }
}
