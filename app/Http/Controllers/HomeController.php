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
        $members = Member::search();
        dd($members);
        exit;
        

        $members = json_encode($members);

        return view('home', compact('members'));
    }
}
