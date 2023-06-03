<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class PaymentHistory extends Model
{
    use HasFactory;

    protected $table = "payment_histories";

    protected $fillable = [
        "member_id",
        "amount",
        "point",
        "date",
        "created_at",
        "updated_at"
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
