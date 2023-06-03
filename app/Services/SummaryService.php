<?php

namespace App\Services;

use App\Repositories\SummaryRepository;
use Carbon\Carbon;

class SummaryService
{
    public function __construct(SummaryRepository $summaryRepository)
    {
        $this->summaryRepository = $summaryRepository;
    }

    public function getSummary()
    {
        return $this->summaryRepository->getSummary();
    }
}