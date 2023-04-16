<?php

namespace App\Values;

use Illuminate\Support\Str;

class MemberValue
{
    protected $accessToken;

    protected $temporaryAccessToken;

    public function __construct()
    {
        $this->accessToken = Str::random(60);
        $this->temporaryAccessToken = Str::random(60);
    }

    public function getNewAccessToken()
    {
        return $this->accessToken;
    }

    public function getNewTemporaryAccessToken()
    {
        return $this->temporaryAccessToken;
    }
}