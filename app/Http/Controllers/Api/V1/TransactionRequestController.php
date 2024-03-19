<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\DepositRequestStoreRequest;
use App\Http\Requests\Api\V1\WithdrawRequestStoreRequest;
use App\Http\Resources\Api\V1\TransactionRequestResource;
use App\Http\Resources\Api\V1\TransactionRequestSummaryResource;
use App\Models\DepositRequest;
use App\Models\TransactionRequest;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionRequestController extends Controller
{
    public function index(){
        // TODO: request form from backend

        $requests = TransactionRequest::with("transactionable")->where("user_id", auth()->user()->id)->paginate();

        return response()->success(TransactionRequestSummaryResource::collection($requests));
    }

    public function show(TransactionRequest $request){
        $request->load("transactionable");

        return response()->success(new TransactionRequestResource($request));
    }

    public function storeDepositRequest(DepositRequestStoreRequest $request){
        $deposit_request = DepositRequest::create($request->validated());

        $deposit_request->transactionRequest()->create([
            "user_id" => $request->user()->id,
            "uuid" => Str::uuid(),
        ]);
        
        return response()->success([
            "data" => []
        ]);
    }

    public function storeWithdrawRequest(WithdrawRequestStoreRequest $request){
        $withdraw_request = WithdrawRequest::create($request->validated());

        $withdraw_request->transactionRequest()->create([
            "user_id" => $request->user()->id,
            "uuid" => Str::uuid(),
        ]);
        
        return response()->success([
            "data" => []
        ]);
    }
}   
