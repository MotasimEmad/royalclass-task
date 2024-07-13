<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class UsersRolesEnums extends Enum
{
    const user = 'user';
    const admin = 'admin';
}