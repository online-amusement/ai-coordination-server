<?php

namespace App\Repositories;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentRepository
{
    const ASC = 'asc';
    const DESC = 'desc';

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function search($paymentId, $amount, $startAt, $endAt, $sort)
    {
        $payments = $this->payment->newQuery();

        if($paymentId != null) {
            $payments = $payments->where("id", $paymentId);
        }

        if($amount != null) {
            $payments = $payments->where("amount", $amount);
        }

        if($startAt != null && $endAt != null) {
            $payments = $payments->where("started_at", ">", $startAt)->where("ended_at", "<", $endAt);
        }

        if($sort == "降順") {
            return $payments
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $payments
                ->orderBy("id", self::ASC)
                ->paginate(10);
        }
    }

    public function payments()
    {
        return $this->payment
            ->newQuery()
            ->get();
    }

    public function findBy($id)
    {
        return $this->payment 
            ->newQuery()
            ->where("id", $id);
    }

    public function createOrUpdate($paymentId, $amount, $points, $startAt, $endAt)
    {
        $payment = $this->payment->newQuery();

        $payment = $payment->updateOrCreate
        (
            ["id" => $paymentId],
            [
                "amount" => $amount,
                "points" => $points,
                "started_at" => $startAt,
                "ended_at" => $endAt
            ],
        );

        return $payment;
    }
}