<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\OrderPayment;
use App\Http\Requests\SavePaymentDetailRequest;
use App\Models\BankDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function submitPaymentDetails(SavePaymentDetailRequest $request)
    {
        $user =  auth()->user();
        // dd($user);
        if (!empty($user)) {
            $paymentSubmitted = OrderPayment::create([
                'order_id' => $request->order_id,
                'transaction_id' => $request->transaction_id,
                'amount' => $request->total_amount,
                'card_number' => $request->card_number,
                'payment_method' => 'online',
                'payment_status' => $request->payment_status,
                'reference_id' => $request->reference_id,
                'payment_by' => $user->id,
                'paid_to' => $request->seller_id,
                'payment_type' => config('constants.payment.PAY-BID-AMOUNT'),
            ]);
            if ($paymentSubmitted) {
                return response()->json([
                    'message' => __('apiMessage.orderPaymentSubmitted'),
                    'status' => 'success'
                ]);
            } else {
                return response()->json(['message' => __('apiMessage.errorMsg')]);
            }
        } else {
            return response()->json([
                'message' => __('apiMessage.unauthorized'),
                'status' => 'error'
            ]);
        }
    }


    public function payNow(Request $request)
    {

        $fundAccountId = $request->fund_account;
        $paymentType = $request->payment_type;
        $amount = $request->amount;
        $productId = $request->product_id;
        $purpose = $request->purpose;
        $notes = $request->notes;

        $referenceId = md5(time());
        $paymentObj = resolve('razorpay');
        $paymentOutput = $paymentObj->makeBankPayment($fundAccountId, $amount * 100, $purpose, $referenceId, [$notes])->json();

        // OrderPayment::
        $dataToSave = [
            'order_id' => $request->order_id,
            'transaction_id' => $paymentOutput['id'],
            'amount' => $request->amount,
            'payment_method' => 'online',
            'payment_status' => $paymentOutput['status'],
            'reference_id' => $referenceId,
            'payment_by' => auth()->user()->id,
            'paid_to' => $request->paid_to,
            'payment_type' => $paymentType,
        ];
        $paymentSubmitted = OrderPayment::create($dataToSave);
        return response()->json([
            'message' => __('apiMessage.orderPaymentSubmitted'),
            'status' => 'success',
            'data'  =>  $paymentOutput
        ]);

        dd($paymentOutput->json());
    }
}
