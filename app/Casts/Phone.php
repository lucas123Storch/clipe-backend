<?php

namespace App\Casts;

use App\Enums\Masks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Phone implements CastsAttributes
{
    private string $mask;

    public function __construct(string $mask = Masks::MASK_CELL_PHONE)
    {
        $this->mask = $mask;
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string
     */
    public function get($model, string $key, $value, array $attributes): string
    {
        return mask($value, $this->mask);
    }

    /**
     * @param Model $model
     * @param string $key
     * @param string $value
     * @param array $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        return unmask($value, Masks::UNMASK_CLEAN);
    }
}
