<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Summary;

class MonthlyAggregateBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:monthlyAggregate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '月ごとの売上集計';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $summaries = DB::select("select DATE_FORMAT(created_at, '%Y-%m') as month, SUM(`amount`) as `amount` FROM `payment_histories` GROUP BY DATE_FORMAT(created_at, '%Y-%m')");
        foreach($summaries as $summary) {
            $now = Carbon::now()->format("Y-m");
                $months[$summary->month][] = Summary::updateOrcreate(
                    [
                        "date" => $summary->month
                    ],
                    [
                        "date" => $summary->month,
                        "total_amount" => $summary->amount
                    ] , 
                );
        }

        return $summaries;
    }
}
