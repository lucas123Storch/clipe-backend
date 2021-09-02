<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserMaritalStatus;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;

class MaritalStatusController extends ApiController
{
    public function index(): JsonResponse
    {
        return $this->successResponse(data: [
            'marital_status' => UserMaritalStatus::asSelectArray()
        ]);
    }
}
