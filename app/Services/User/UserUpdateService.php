<?php

namespace App\Services\User;

class UserUpdateService
{
    public function __invoke($formData, $user)
    {
        $user->update($formData);
    }
}