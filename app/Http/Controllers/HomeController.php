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
        $memberId = $request->input("searchMemberId");
        $status = $request->input("searchStatus");
        $started_at = $request->input("searchStartDate");
        $ended_at = $request->input("searchEndDate");
        $sort = $request->input("searchSort");
        

        $members = $this->memberService->search($memberId, $status, $started_at, $ended_at, $sort);
        

        $members = json_encode($members);

        return view('home', compact('members'));
    }
}
