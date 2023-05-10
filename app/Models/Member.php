<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        "nickname",
        "email",
        "password",
        "api_token",
        "status",
        "points"
    ];

    const ASC = "asc";
    const DESC = "desc";

    public function scopeSearch($query, $memberId = null, $status = null, $startDate = null, $endDate = null, $sort = null)
    {

        if($memberId != null) {
            $members = Member::where("id", "=", "{$memberId}");
        }

        if($status != null) {
            $members = Member::where("status", "=", "{$status}");
        }

        if($startDate != null && $endDate != null) {
            $members = Member::where("created_at", ">", "{$startDate}")->where("created_at", "<","{$endDate}");
        }
        
        
        if($sort == 'desc') {
            return Member::orderBy('id', self::DESC)->paginate(10);
        }else {
            return Member::orderBy('id', self::ASC)->paginate(10);
        }
    }
}
