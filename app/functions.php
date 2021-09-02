<?php

use Illuminate\Support\Facades\Validator;

if (!function_exists('mask')) {
    function mask(string $value, string $mask, string $character = '#'): string
    {
        if (empty($value)) {
            return '';
        }

        $masked = '';

        $key = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == $character) {
                if (isset($value[$key])) {
                    $masked .= $value[$key++];
                }
                continue;
            }

            if (isset($mask[$i])) {
                $masked .= $mask[$i];
            }
        }
        return $masked;
    }
}

if (!function_exists('unmask')) {
    function unmask(string $value, array $characters): string
    {
        if (empty($value)) {
            return '';
        }

        return str_replace($characters, '', $value);
    }
}

if (!function_exists('is_base64_image')) {
    function is_base64_image($image): bool
    {
        $rules = [
            'image' => 'required|base64image'
        ];

        return is_string($image) && !Validator::make(compact('image'), $rules)->fails();
    }
}
