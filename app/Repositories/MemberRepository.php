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
    const ASC = "asc";
    const DESC = "desc";
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

    public function updateMemberEmail($token, $email)
    {
        return $this->member
            ->newQuery()
            ->where("api_token",$token)
            ->update([
                'email' => $email,
            ]);
    }

    public function updateMemberNickname($token, $nickname)
    {
        return $this->member
            ->newQuery()
            ->where("api_token",$token)
            ->update([
                'nickname' => $nickname,
            ]);
    }

    public function updateMemberPassword($token, $password)
    {
        return $this->member
            ->newQuery()
            ->where("api_token",$token)
            ->update([
                'password' => Hash::make($password),
            ]);
    }

    public function search($memberId, $status, $startDate, $endDate, $sort)
    {
        $members = $this->member->newQuery();

        if($memberId != null) {
            $members = $members->where("id", $memberId);
        }

        if($status != null) {
            $members = $members->where("status", "=", $status);
        }

        if($startDate != null && $endDate != null) {
            $members = $members
                ->where("created_at", ">", $startDate)
                ->where("created_at", "<", $endDate);
        }
        
        
        if($sort == '降順') {
            return $members
                ->orderBy('id', self::DESC)
                ->paginate(10);
        }else {
            return $members
                ->orderBy('id', self::ASC)
                ->paginate(10);
        }
    }

    public function createOrUpdate($memberId, $memberNickName, $memberStatus, $memberPoint)
    {
        $members = $this->member->newQuery();

        $memberData = $members->find($memberId);
        $memberEmail = $memberData->email;


        $members = $members->updateOrCreate(
            ["id" => $memberId],
            [
                "nickname" => $memberNickName,
                "email" => $memberEmail,
                "status" => $memberStatus,
                "points" => $memberPoint
            ],
        );
        return $members;
    }

    public function updatePoint($memberId, $point)
    {
        return $this->member
            ->newQuery()
            ->where("id",$memberId)
            ->increment('points',$point);
    }
}