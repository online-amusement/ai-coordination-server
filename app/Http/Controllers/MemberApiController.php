<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Values\MemberValue;
use App\Services\MemberService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MemberEmailEditRequest;
use App\Http\Requests\MemberPasswordEditRequest;
use App\Http\Requests\MemberNicknameEditRequest;

class MemberApiController extends Controller
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
            $token = new MemberValue();
            $member->api_token = $token->getNewAccessToken();
            $member->save();
            return response()->json([
                "result" => true,
                "status" => 201,
                "message" => "ログインしました。",
                "data" => $member->api_token,
            ]);
        }

    }

    public function memberEmailEdit(MemberEmailEditRequest $request) {
        $token = $request->bearerToken();
        $email = $request->get("email");

        if($email) {
            $memberData = $this->memberService->updateMemberEmail($token, $email);

            return response()->json([
                "result" => true,
                "status" => 201,
                "message" => "ユーザー情報の更新に成功しました。"
            ]);
        }

        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => "ユーザー情報の更新に失敗しました。"
        ]);   
    }

    public function memberNicknameEdit(MemberNicknameEditRequest $request) {
        $token = $request->bearerToken();
        $nickname = $request->get("nickname");

        if($nickname) {
            $memberData = $this->memberService->updateMemberNickname($token, $nickname);

            return response()->json([
                "result" => true,
                "status" => 201,
                "message" => "ユーザー情報の更新に成功しました。"
            ]);
        }

        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => "ユーザー情報の更新に失敗しました。"
        ]);   
    }

    public function memberPasswordEdit(MemberPasswordEditRequest $request) {
        $token = $request->bearerToken();
        $password = $request->get("password");
        $password_confirmation = $request->get("password_confirmation");

        if($password == $password_confirmation) {
            $memberData = $this->memberService->updateMemberPassword($token, $password);

            return response()->json([
                "result" => true,
                "status" => 201,
                "message" => "ユーザー情報の更新に成功しました。"
            ]);
        }else {
            return response()->json([
                "result" => false,
                "status" => 401,
                "message" => "ユーザー情報の更新に失敗しました。"
            ]);   
        }
    }
}
