<?php

namespace App\Enums;

enum PrivacyOption: int
{
    case ONLY_ME = 1;
    case EVERYONE = 2;
    case ALL_MEMBERS = 3;

    public function label(): string
    {
        return match ($this) {
            self::ONLY_ME => 'Only Me',
            self::EVERYONE => 'Everyone',
            self::ALL_MEMBERS => 'All Members',
        };
    }
}
