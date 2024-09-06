<?php
declare(strict_types=1);

namespace Epiclesys\ValueMatcher;

use InvalidArgumentException;

class JsonMatcher
{
    public static function contains(string $needle, string $haystack): bool
    {
        if (!json_validate($needle) || !json_validate($haystack)) {
            throw new InvalidArgumentException();
        }

        return ArrayMatcher::contains(
            json_decode($needle, true),
            json_decode($haystack, true)
        );
    }
}
