<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Models\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $memberId = $request->get("searchMemberId");
        $status = $request->get("searchStatus");
        $started_at = $request->get("searchStartDate");
        $ended_at = $request->get("searchEndDate");
        $sort = $request->get("searchSort");

        $members = $this->memberService->search($memberId, $status, $started_at, $ended_at, $sort);
        

        $members = json_encode($members);

        return view('home', compact('members'));
    }
}
