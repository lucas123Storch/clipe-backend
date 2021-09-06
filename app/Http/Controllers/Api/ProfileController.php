<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use App\Http\Resources\User\CrudResource;
use App\Http\Requests\Api\ProfileRequest;

class ProfileController extends ApiController
{
    public function show(): JsonResponse
    {
        $user = auth()->user();

        return $this->successResponse(data: [
            'user' => new CrudResource($user)
        ]);
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->update($request->safe()->except('avatar', 'password'));

        if ($password = $request->get('password')) {
            $user->update(['password' => $password]);
        }

        if ($avatar = $request->get('avatar')) {
            $user->uploadImage($avatar, Str::slug($user->name))->toMediaCollection('avatar');
        }

        return $this->successResponse('Perfil atualizado com sucesso!', [
            'user' => new CrudResource($user)
        ]);
    }
}
