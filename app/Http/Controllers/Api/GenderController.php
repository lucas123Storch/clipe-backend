<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserGender;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;

class GenderController extends ApiController
{
    public function index():JsonResponse
    {
        return $this->successResponse(data: [
           'genders' => UserGender::asSelectArray()
        ]);
    }
}
