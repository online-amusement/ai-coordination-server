<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Services\SummaryService;
use App\Services\PaymentHistoryService;

class SummaryController extends Controller
{
    public function __construct(SummaryService $summaryService, PaymentHistoryService $paymentHistoryService) 
    {
        $this->summaryService = $summaryService;
        $this->paymentHistoryService = $paymentHistoryService;
    }

    public function index(Request $request)
    {
        $summaries = $this->summaryService->getSummary();
        
        $summaries = json_encode($summaries);

        return view("summary",compact("summaries"));
    }

    public function show(Request $request, $date)
    {
        $summary = $this->paymentHistoryService->show($date);

        $date = $date;

        $summary = json_encode($summary);
        $date = json_encode($date);
        
        return view("summary-show", compact("summary", "date"));
    }
}
