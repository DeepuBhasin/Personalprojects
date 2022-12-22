<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\SaveTransactionRequest;
use App\Http\Resources\OrderPaymentResource;
use App\Models\OrderPayment;

class TransactionController extends Controller
{
    public function saveTransaction(SaveTransactionRequest $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $result = Transaction::create($request->validated() + ['added_by' => $user->id]);
            if ($result) {
                return response()->json([
                    'message' => __('apiMessage.transactionSubmitted'),
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
    public function getTransactions(Request $request)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $transactions = Transaction::where('added_by', $user->id)->get();
            if (!$transactions->isEmpty()) {
                return TransactionResource::collection($transactions);
            } else {
                return response()->json([
                    'message' => __('apiMessage.dataNotExist'),
                ]);
            }
        } else {
            return response()->json(['error' => __('apiMessage.unauthorized')], 400);
        }
    }
    public function show(Request $request, $id)
    {
        $user = auth()->user();
        if (!empty($user)) {
            $transactions = OrderPayment::where('order_id', $id)->with('order','order.product')->paginate();
            if (!$transactions->isEmpty()) {
                return OrderPaymentResource::collection($transactions);
            } else {
                return response()->json([
                    'message' => __('apiMessage.dataNotExist'),
                ]);
            }
        } else {
            return response()->json(['error' => __('apiMessage.unauthorized')], 400);
        }
    }
}
