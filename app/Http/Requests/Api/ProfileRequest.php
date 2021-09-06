<?php

namespace App\Http\Requests\Api;

use App\Enums\Masks;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property string $email
 * @property string $cpf
 * @property string $avatar
 * @property string $phone
 * @property string $gender
 * @property string $marital_status
 * @property string $password
 */
class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|between:5,70',
            'email' => "required|email|max:200|unique:users,email,{$this->user()->id}",
            'cpf' => 'required|cpf',
            'avatar' => 'nullable|base64image|base64max:300|base64dimensions:ratio=1/1,min_width=200',
            'phone' => 'required|string|between:10,11',
            'gender' => 'required|string|max:30',
            'marital_status' => 'required|string|max:30',
            'password' => ['nullable', 'confirmed', Password::defaults()]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'avatar' => 'imagem',
            'phone' => 'telefone',
            'gender' => 'sexo',
            'marital_status' => 'estado civil',
            'password' => 'senha'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => unmask($this->cpf ?? '', Masks::UNMASK_CLEAN),
            'phone' => unmask($this->phone ?? '', Masks::UNMASK_CLEAN),
        ]);
    }
}
