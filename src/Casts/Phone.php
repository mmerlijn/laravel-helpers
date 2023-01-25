<?php


namespace mmerlijn\laravelHelpers\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;


class Phone implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     */

    public function get($model, $key, $value, $attributes)
    {
        return new \mmerlijn\msgRepo\Phone(number: $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        if (!$value instanceof \mmerlijn\msgRepo\Phone)
            $value = (new \mmerlijn\msgRepo\Phone($value))->netNumber($attributes['city'] ?? "");
        return $value->number;
    }

}
