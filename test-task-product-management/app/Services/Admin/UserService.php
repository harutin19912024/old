<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Validators\Admin\UserValidator;
use App\Services\BaseService;

class UserService extends BaseService
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @return string
     */
    protected function getValidatorClass(): string
    {
        return UserValidator::class;
    }
}
