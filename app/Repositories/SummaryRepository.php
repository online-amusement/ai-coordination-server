<?php

namespace App\Repositories;

use App\Models\Summary;
use App\Models\PaymentHistory;
use Carbon\Carbon;

class SummaryRepository
{
    public function __construct(Summary $summary, PaymentHistory $paymentHistory)
    {
        $this->summary = $summary;
        $this->paymentHistory = $paymentHistory;
    }

    public function getSummary()
    {
        return $this->summary
            ->newQuery()
            ->get();
    }

    
}