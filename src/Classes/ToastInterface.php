<?php

namespace mmerlijn\laravelHelpers\Classes;


use mmerlijn\laravelHelpers\Enums\ToastPositionEnum;
use mmerlijn\laravelHelpers\Enums\ToastTypeEnum;

interface ToastInterface
{
    public function flash(string $message = "", int $duration = 10000, ToastTypeEnum $type = ToastTypeEnum::INFO, string $title = '', ToastPositionEnum $position = ToastPositionEnum::TOP_RIGHT): self;

    public function get(): array;
}
