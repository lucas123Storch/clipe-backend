<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\ApiController;
use App\Http\Resources\User\CrudResource;

class UserController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->successResponse(data: [
            'users' => CrudResource::collection(User::paginate())
        ]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create($request->safe()->except('avatar'));

        if ($avatar = $request->get('avatar')) {
            $user->uploadImage($avatar, Str::slug($user->name))->toMediaCollection('avatar');
        }

        return $this->successResponse('Usuário criado com sucesso!', [
            'user' => new CrudResource($user)
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return $this->successResponse(data: [
            'user' => new CrudResource($user)
        ]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->safe()->except('avatar', 'password'));

        if ($password = $request->get('password')) {
            $user->update(['password' => $password]);
        }

        if ($avatar = $request->get('avatar')) {
            $user->uploadImage($avatar, Str::slug($user->name))->toMediaCollection('avatar');
        }

        return $this->successResponse('Usuário atualizado com sucesso!', [
            'user' => new CrudResource($user)
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        abort_if($user->id === auth()->id(), 403);

        $user->delete();

        return $this->successResponse('Usuário excluído com sucesso!');
    }
}
