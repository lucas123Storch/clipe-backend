<?php

return [
    \App\Enums\UserGender::class => [
        \App\Enums\UserGender::FEMALE => 'FEMININO',
        \App\Enums\UserGender::MALE => 'MASCULINO'
    ],
    \App\Enums\UserMaritalStatus::class => [
        \App\Enums\UserMaritalStatus::MARRIED => 'CASADO(A)',
        \App\Enums\UserMaritalStatus::DIVORCED => 'DIVORCIADO(A)',
        \App\Enums\UserMaritalStatus::NOT_MARRIED => 'SOLTEIRO(A)',
        \App\Enums\UserMaritalStatus::WIDOWER => 'VIÚVO(A)'
    ]
];
