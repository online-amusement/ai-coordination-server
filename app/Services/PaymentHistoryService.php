<?php

namespace App\Services;

use App\Repositories\PaymentHistoryRepository;
use Carbon\Carbon;

class PaymentHistoryService
{
    public function __construct(PaymentHistoryRepository $paymentHistoryRepository)
    {
        $this->paymentHistoryRepository = $paymentHistoryRepository;
    }

    public function findBy($field, $operator, $value)
    {
        return $this->paymentHistoryRepository->findBy($field, $operator, $value);
    }

    public function createHistory($memberId, $amount, $point)
    {
        return $this->paymentHistoryRepository->createHistory($memberId, $amount, $point);
    }

    public function show($date)
    {
        return $this->paymentHistoryRepository->show($date); 
    }
}