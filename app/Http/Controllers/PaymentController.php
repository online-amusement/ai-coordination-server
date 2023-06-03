<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(MemberService $memberService, PaymentService $paymentService)
    {
        $this->memberService = $memberService;
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $paymentId = $request->input('searchPaymnetId');
        $amount = $request->input('searchAmount');
        $startAt = $request->input('searchSatrtedAt');
        $endAt = $request->input('searchEndedAt');
        $sort = $request->input('searchSort');

        $payments = $this->paymentService->search($paymentId, $amount, $startAt, $endAt, $sort);

        $payments = json_encode($payments);

        return view('payment', compact('payments'));
    }

    public function create()
    {
        $payments = null;

        return view("payment-edit", compact('payments'));
    }

    public function edit(Request $request, $id)
    {
        $payments = $this->paymentService->findBy($id)->first();

        return view('payment-edit', compact("payments"));
    }

    public function save(Request $request)
    {
        $paymentId = $request->input('id');
        $amount = $request->input('amount');
        $points = $request->input('points');
        $startAt = $request->input('started_at');
        $endAt = $request->input('ended_at');

        $payments = $this->paymentService->createOrUpdate($paymentId, $amount, $points, $startAt, $endAt);

        return redirect()->to("/payment");
    }

    public function delete(Request $request, $id)
    {
        $payments = $this->paymentService->findBy($id)->first();

        $payments->delete();

        return redirect()->to("/payment");
    }

    public function payments(Request $request)
    {
        $payments = $this->paymentService->payments();

        if($payments) {
            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => '取得しました。',
                "data" => $payments,
            ]);
        }
        return response()->json([
            "result" => true,
            "status" => 401,
            "message" => '取得できませんでした。',
            "data" => $payments,
        ]);
    }
}
