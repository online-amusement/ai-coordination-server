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
}
