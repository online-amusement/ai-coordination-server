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

    public function findBy($field, $operator, $value)
    {
        return $this->memberRepository->findBy($field, $operator, $value);
    }

    public function isExistToken($token)
    {
        return $this->memberRepository->isExistToken($token);
    }

    public function updateProfileMember($nickname, $password, $token)
    {
        return $this->memberRepository->updateProfileMember($nickname, $password, $token);
    }

    public function updateMemberEmail($token, $email)
    {
        return $this->memberRepository->updateMemberEmail($token, $email);
    }

    public function updateMemberNickname($token, $nickname)
    {
        return $this->memberRepository->updateMemberNickname($token, $nickname);
    }

    public function updateMemberPassword($token, $password)
    {
        return $this->memberRepository->updateMemberPassword($token, $password);
    }

    public function search($memberId, $status, $startDate, $endDate, $sort)
    {
        return $this->memberRepository->search($memberId, $status, $startDate, $endDate, $sort);
    }
}