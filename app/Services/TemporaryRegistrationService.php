<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Registration;
use App\Repositories\TemporaryRegistrationRepository;

class TemporaryRegistrationService
{
    public function __construct(TemporaryRegistrationRepository $temporaryRegistrationRepository)
    {
        $this->temporaryRegistrationRepository = $temporaryRegistrationRepository;
    }

    public function findBy()
    {
        return $this->temporaryRegistrationRepository->findBy('api_token', '=', $token);
    }

    public function registrationCreate($email)
    {
        return $this->temporaryRegistrationRepository->registrationCreate($email);
    }

    public function temporaryMemberCreate($email,$token)
    {
        return $this->temporaryRegistrationRepository->temporaryMemberCreate($email,$token);
    }
}