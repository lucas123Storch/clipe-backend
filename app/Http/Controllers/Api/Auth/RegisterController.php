<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use App\Http\Resources\User\CrudResource;
use App\Http\Requests\Api\Auth\RegisterRequest;

class RegisterController extends ApiController
{
    public function store(RegisterRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create($request->safe()->except('avatar'));

        if ($avatar = $request->get('avatar')) {
            $user->uploadImage($avatar, Str::slug($user->name))->toMediaCollection('avatar');
        }

        return $this->successResponse('Usuário criado com sucesso!', [
            'user' => new CrudResource($user),
            'token' => $user->createToken($request->device_name ?? 'other')->plainTextToken
        ]);
    }
}
