<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PaymentHistory;
use Carbon\Carbon;

class PaymentHistoryRepository
{
    public function __construct(PaymentHistory $paymentHistory)
    {
        $this->paymentHistory = $paymentHistory;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->paymentHistory
            ->newQuery()
            ->where($field, $operator, $value);
    }

    public function createHistory($memberId, $amount, $point)
    {
        $date = Carbon::now();
        $date = $date->format("Y-m");
        return $this->paymentHistory
            ->newQuery()
            ->create([
                "member_id" => $memberId,
                "amount" => $amount,
                "point" => $point,
                "date" => $date
            ]);
    }

    public function show($date)
    {
        return $this->paymentHistory
            ->newQuery()
            ->select('member_id')
            ->selectRaw('SUM(amount) as total_amount')
            ->selectRaw('SUM(point) as total_point')
            ->where("date", $date)
            ->groupBy("member_id")
            ->with(['member'])
            ->get();
    }
}