<?php

namespace App\Repositories;

use App\Models\Registration;
use App\Models\Member;
use App\Values\MemberValue;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TemporaryRegistrationRepository
{
    public function __construct(Registration $registration, Member $member, MemberValue $memberValue)
    {
        $this->registration = $registration;
        $this->member = $member;
        $this->memberValue = $memberValue;
    }

    public function registrationCreate($email)
    {
        return $this->registration
            ->newQuery()
            ->create([
                'email' => $email,
                'token' => $this->memberValue->getNewTemporaryAccessToken(),
                'expiration_date' => new Carbon('+30 minutes')
            ]);
    }

    public function findByToken($token)
    {
        return $this->registration
            ->newQuery()
            ->where("token", $token)
            ->first();
    }

    public function temporaryMemberCreate($email,$token)
    {
        $password = Str::random(20);

        return $this->member
            ->newQuery()
            ->create([
                'nickname' => 'ゲスト',
                'email' => $email,
                'password' => Hash::make($password),
                'api_token' => $token,
                'status' => 0
            ]);
    }
}