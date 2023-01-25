<?php

namespace mmerlijn\laravelHelpers\Enums;

enum FlashTypes: string
{
    case danger = "danger";
    case success = "success";

    case notice = "notice";

    case alert = "alert";

    case debug = "debug";

    public static function set(string $type)
    {
        return match (strtolower($type)) {
            "notice", "notify", "debug" => self::notice,
            "danger", "error" => self::danger,
            "success" => self::success,
            "alert", "warning" => self::alert,
            default => throw new Exception("INVALID FlashType " . $type . " only except: danger, success, alert, notice")
        };
    }
}
