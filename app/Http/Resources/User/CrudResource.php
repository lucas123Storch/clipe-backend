<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;

class CrudResource extends BaseResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'marital_status' => $this->marital_status,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
