<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;

class MemberController extends Controller
{
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function member(Request $request)
    {
        $token = $request->bearerToken();

        $member = $this->memberService->findBy('api_token', '=', $token);

        if($member) {
            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => 'ユーザー情報を取得しました。',
                "data" => $member,
            ]);
        }

        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => 'ユーザー情報の取得に失敗しました。'
        ]);
    }
}
