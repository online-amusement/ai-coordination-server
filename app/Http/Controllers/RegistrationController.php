<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Registration;
use App\Services\MemberService;
use App\Services\TemporaryRegistrationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryRegistration;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function __construct(TemporaryRegistrationService $temporaryRegistrationService, MemberService $memberService)
    {
        $this->temporaryRegistrationService = $temporaryRegistrationService;
        $this->memberService = $memberService;
    }

    public function temporaryRegistration(Request $request)
    {
        //送信されたメールアドレスを取得
        $email = $request->get("email");

        //registrationに登録
        $registration = $this->temporaryRegistrationService->registrationCreate($email);

        //registrationのemailと一致するユーザー取得
        $searchMember = $this->temporaryRegistrationService->findByToken($registration->token);

        //member仮登録
        $member = $this->temporaryRegistrationService->temporaryMemberCreate($email,$searchMember->token);

        //メールアドレス宛にメール送信
        Mail::to($email)->send(new \App\Mail\TemporaryRegistration($registration));

        return response()->json([
            "result" => 'OK',
            "status" => 200,
            "message" => '仮登録が完了しました。'
        ]);
    }

    public function officialRegistration(Request $request)
    {
        $nickname = $request->get('nickname');
        $password = $request->get('password');
        $token = $request->get('token');

        //現在時刻
        $now = Carbon::now();

        //トークンが一致するユーザー取得
        $member = $this->memberService->findByToken($token);
        
        //有効期限が切れてないか確認するためregistration取得
        $registration = $this->temporaryRegistrationService->findByToken($token);

        if($member && $now <= $registration->expiration_date) {
            //memberを更新
            $memberUpdate = $this->memberService->updateProfileMember($nickname, $password);

            //本登録が完了した旨のメールを送信
            Mail::to($member->email)->send(new \App\Mail\officialRegistration());

            return response()->json([
                'result' => 'OK',
                'status' => 200,
                'message' => '本登録が完了しました。',
            ]);
        }

        return response()->json([
            'result' => 'OK',
            'status' => 401,
            'message' => '本登録が完了しませんでした。'
        ]);   
    }
}
