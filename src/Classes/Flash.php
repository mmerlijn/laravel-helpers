<?php

namespace mmerlijn\laravelHelpers\Classes;

use mmerlijn\laravelHelpers\Enums\FlashTypes;

class Flash
{
    private string $message;
    private int $duration = 4000;

    private FlashTypes $type = FlashTypes::notice;

    public function __construct()
    {
    }

    public function message(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function type(string $type): self
    {
        $this->type = FlashTypes::set($type);

        return $this;
    }

    public function duration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function add(): void
    {
        session()->push('flash', [
            'message' => $this->message,
            'type' => $this->type->value,
            'duration' => $this->duration,
        ]);
    }

    //Alias for add()
    public function set(): void
    {
        $this->add();
    }

    public function get()
    {
        //$script = "window.onload=function () {";
        $script = "window.addEventListener('load', function () {";
        foreach (session('flash', []) as $flash) {
            $script .= "flash({type: '" . ($flash['type'] ?? 'notice') . "',text: '" . ($flash['message'] ?? '') . "',duration: " . ($flash['duration'] ?? 4000) . "});";
        }
        $script .= "})";
        session()->forget('flash');
        return $script;
    }
}