<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MemberService;
use Illuminate\Support\Facades\Hash;

class MemberLoginController extends Controller
{
    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $member = $this->memberService->findBy("email", "=", $email);

        if($member->status != 1) {
            return response()->json([
                "result" => false,
                "status" => 401,
                "message" => "登録が完了していません。"
            ]);
        }

        if($member && Hash::check($password, $member->password)) {
            return response()->json([
                "result" => true,
                "status" => 201,
                "message" => "ログインしました。",
                "data" => $member->api_token,
            ]);
        }

    }
}
