<?php
declare(strict_types=1);

namespace Test\Unit;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Epiclesys\ValueMatcher\JsonMatcher;

class JsonMatcherTest extends TestCase
{
    #[DataProvider('data')]
    public function testJson(string $needle, string $haystack, bool $expected): void
    {
        self::assertEquals($expected, JsonMatcher::contains($needle, $haystack));
    }

    public static function data(): Generator
    {
        yield 'one' => [
            file_get_contents('test/Resources/needle1.json'),
            file_get_contents('test/Resources/haystack1.json'),
            true,
        ];

        yield 'two' => [
            file_get_contents('test/Resources/needle2.json'),
            file_get_contents('test/Resources/haystack2.json'),
            true,
        ];

        yield 'three' => [
            file_get_contents('test/Resources/needle1.json'),
            file_get_contents('test/Resources/haystack2.json'),
            false,
        ];

        yield 'four' => [
            file_get_contents('test/Resources/needle2.json'),
            file_get_contents('test/Resources/haystack1.json'),
            false,
        ];

        yield 'empty' => [
            '{}',
            '{}',
            true,
        ];
    }
}
