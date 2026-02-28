<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    //
    public function index()
    {
        return view('payments.razorpay');
    }

    public function payment(Request $request)
    {
        $amount = $request->input('amount');
        $user = Auth::user();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $orderData = [
            'receipt' => 'order_' . rand(1000, 9999),
            'amount' => $amount,
            'currency' => 'INR',
            'payment_capture' => 1,
        ];

        $order = $api->order->create($orderData);
        return view('payments.payment', [
            'orderId' => $order['id'],
            'amount' => $order['amount'],
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $request->contact,
        ]);
    }

    public function callback(Request $request)
    {
        $payId = $request->payId;
        $orderId = $request->orderId;
        $sign = $request->sign;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attr = [
                'razorpay_payment_id' => $payId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $sign,
            ];

            $api->utility->verifyPaymentSignature($attr);
            // echo 'Payment Verified' . $payId;

            // order table entry

            $payment = $api->payment->fetch($payId);
            Payment::create([
                'razorpay_payment_id' => $payId,
                'razorpay_order_id' => $orderId,
                'razorpay_signature' => $sign,
                'amount' => $payment['amount'],
                'method' => $payment['method'],
                'email' => $payment['email'],
                'contact' => $payment['contact'],
                'currency' => $payment['currency'],
                'status' => 'success',
            ]);

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            // echo 'varification Failed';
            Payment::create([
                'razorpay_payment_id' => $payId ?? null,
                'razorpay_order_id' => $orderId ?? null,
                'razorpay_signature' => $sign ?? null,
                'method' => $payment['method'] ?? null,
                'email' => $payment['email'] ?? null,
                'contact' => $payment['contact'] ?? null,
                'amount' => 0,
                'status' => 'failed',
            ]);

            return redirect()->route('payment.failed');
        }
    }
}
