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
        $startDate = $request->input("searchStartDate");
        $endDate = $request->input("searchEndDate");
        $sort = $request->input("searchSort");
        

        $members = $this->memberService->search($memberId, $status, $startDate, $endDate, $sort);
        

        $members = json_encode($members);

        return view('home', compact('members'));
    }

    public function create(Request $request) 
    {
        $members = null;

        return view('member-edit', compact("members"));
    }

    public function edit(Request $request, $id)
    {
        $apiToken = $request->bearerToken();

        $members = $this->memberService->findBy("id", "=", $id);

        $members = json_encode($members);

        return view("member-edit", compact("members"));
    }

    public function save(Request $request)
    {
        $memberId = $request->input("id");
        $memberNickName = $request->input("nickname");
        $memberStatus = $request->input("status");
        $memberPoint = $request->input("points");
 
        $member = $this->memberService->createOrUpdate($memberId, $memberNickName, $memberStatus, $memberPoint);

        return redirect()->to("/home");
    }

    public function delete(Request $request, $id)
    {
        $apiToken = $request->bearerToken();

        $members = $this->memberService->findBy("id", "=", $id);

        $members->delete();

        return redirect()->to("/home");
    }
}
