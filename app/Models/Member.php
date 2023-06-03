<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentHistory;

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

    public function payment_histories() {
        return $this->hasMany(PaymentHistory::class);
    }
}
