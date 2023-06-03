<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    protected $fillable = [
        "amount",
        "points",
        "started_at",
        "ended_at",
        "created_at",
        "updated_at",
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
