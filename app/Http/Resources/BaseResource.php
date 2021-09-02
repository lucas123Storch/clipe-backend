<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    protected function transformEnum(string $enum, $value): ?array
    {
        if (is_null($value)) {
            return null;
        }

        $value = is_numeric($value) ? (int)$value : (string)$value;

        return [
            'id' => $value,
            'key' => $enum::getKey($value),
            'name' => $enum::getDescription($value)
        ];
    }

    public function withResponse($request, $response): void
    {
        $response->header('Content-type', 'application/json; charset=utf-8');
    }
}
