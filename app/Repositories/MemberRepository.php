<?php

namespace App\Repositories;

use App\Models\Registration;
use App\Models\Member;
use App\Values\MemberValue;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MemberRepository
{
    public function __construct(Member $member, MemberValue $memberValue)
    {
        $this->member = $member;
        $this->memberValue = $memberValue;
    }

    public function isExistToken($token)
    {
        return $this->member
            ->newQuery()
            ->where('api_token', $token)
            ->exists();
    }

    public function findBy($field, $operator, $value)
    {
        return $this->member
            ->newQuery()
            ->where($field, $operator, $value)
            ->first();
    }

    public function updateProfileMember($nickname, $password, $token)
    {
        return $this->member
            ->newQuery()
            ->where("api_token",$token)
            ->update([
                'nickname' => $nickname,
                'password' => Hash::make($password),
                'api_token' => $this->memberValue->getNewTemporaryAccessToken(),
                'status' => 1
            ]);
    }
}