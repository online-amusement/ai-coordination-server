<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentHistoryService;
use App\Services\MemberService;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\DB;
use App\Models\Summary;

class PaymentHistoryController extends Controller
{
    public function __construct(PaymentHistoryService $paymentHistoryService, MemberService $memberService)
    {
        $this->paymentHistoryService = $paymentHistoryService;
        $this->memberService = $memberService;
    }

    public function history(Request $request)
    {
        $memberId = $request->input('memberId');
        $amount = $request->input('amount');
        $point = $request->input('point');

        $paymentHistory = $this->paymentHistoryService->createHistory($memberId, $amount, $point);

        //membersのpointsを更新
        $updateMemberPoint = $this->memberService->updatePoint($memberId, $point);

        return response()->json([
            "result" => true,
            "status" => 200,
            "message" => "OK",
        ]);
    }

    public function historyData(Request $request)
    {
        $memberId = $request->input('memberId');

        $paymentHistory = $this->paymentHistoryService->findBy("member_id", "=", $memberId)->orderBy("id","desc")->get();

        if($paymentHistory) {
            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => "OK",
                "data" => $paymentHistory,
            ]);
        }

        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => "データが存在しません",
        ]);
    }
}
