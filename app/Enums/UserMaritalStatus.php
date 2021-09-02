<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class UserMaritalStatus extends Enum implements LocalizedEnum
{
    public const MARRIED = 'married';
    public const DIVORCED = 'divorced';
    public const NOT_MARRIED = 'not_married';
    public const WIDOWER = 'widower';
}
