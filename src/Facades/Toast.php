<?php

namespace mmerlijn\laravelHelpers\Facades;


use Illuminate\Support\Facades\Facade;
use mmerlijn\laravelHelpers\Enums\ToastPositionEnum;
use mmerlijn\laravelHelpers\Enums\ToastTypeEnum;

/**
 * @method static flash(string $message = "", ToastTypeEnum $type = ToastTypeEnum::INFO, string $title = '', int $duration = 10000, ToastPositionEnum $position = ToastPositionEnum::TOP_RIGHT): self
 * @method static get(): array
 */
class Toast extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \mmerlijn\laravelHelpers\Classes\Toast::class;
    }
}