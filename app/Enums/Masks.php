<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Masks extends Enum
{
    public const MASK_CPF = '###.###.###-##';
    public const MASK_CNPJ = '##.###.###/####-##';
    public const MASK_CEP = '#####-###';
    public const MASK_CELL_PHONE = '(##) #####-####';
    public const MASK_PHONE = '(##) ####-####';
    public const UNMASK_CLEAN = ['.', '/', '-', ' ', ':', ',', '\\', '|', '_', '+', '(', ')'];
    public const UNMASK_CNPJ = ['.', '/', '-'];
    public const UNMASK_CPF = ['.', '-'];
    public const UNMASK_CEP = ['-'];
    public const UNMASK_PHONE = ['(', ')', '-', ' '];
}
