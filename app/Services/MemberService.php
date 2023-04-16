<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Registration;
use App\Repositories\MemberRepository;

class MemberService
{
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function findByToken($token)
    {
        return $this->memberRepository->findByToken($token);
    }

    public function isExistToken($token)
    {
        return $this->memberRepository->isExistToken($token);
    }

    public function updateProfileMember($nickname, $password)
    {
        return $this->memberRepository->updateProfileMember($nickname, $password);
    }
}