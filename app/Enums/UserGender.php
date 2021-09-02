<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class UserGender extends Enum implements LocalizedEnum
{
    public const FEMALE = 'female';
    public const MALE = 'male';
}
