<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use Carbon\Carbon;

class PaymentService
{
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function search($paymentId, $amount, $startAt, $endAt, $sort)
    {
        return $this->paymentRepository->search($paymentId, $amount, $startAt, $endAt, $sort);
    }

    public function payments()
    {
        $payments = $this->paymentRepository->payments();
        $paymentsData = [];
        foreach($payments as $payment) {
            if($payment["started_at"] == null) {
                $paymentsData["generally"][] = $payment;
            }else {
                $now = new Carbon();
                if($payment->started_at <= $now && $payment->ended_at >= $now) {
                    $paymentsData["limits"][] = $payment;
                }
            }
        }
        return $paymentsData;
    }

    public function findBy($id)
    {
        return $this->paymentRepository->findBy($id);
    }

    public function createOrUpdate($paymentId, $amount, $points, $startAt, $endAt)
    {
        return $this->paymentRepository->createOrUpdate($paymentId, $amount, $points, $startAt, $endAt);
    }
}