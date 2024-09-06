<?php
declare(strict_types=1);

namespace Test\Unit;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Epiclesys\ValueMatcher\ArrayMatcher;

class ArrayMatcherTest extends TestCase
{
    #[DataProvider('data')]
    public function test(array $needle, array $haystack, $expected): void
    {
        self::assertEquals($expected, ArrayMatcher::contains($needle, $haystack));
    }

    public static function data(): Generator
    {
        yield 'one' => [
            [
                'item' => 'value',
                'anotherItem' => [
                    1,
                    [
                        'someKey' =>'anotherValue',
                        'key' => [
                            ['something' => [['even' => ['more_weird']]]]
                        ]
                    ]
                ],
            ],
            [
                'data' => [
                    1,
                    'items' => [
                        ['item' => 'value'],
                        [
                            'item' => 'anotherValue'
                        ],
                    ],
                ]
            ],
            false,
        ];

        yield 'empty' => [
            [],
            [],
            true,
        ];

        yield 'two' => [
            [
                'item' => 'value',
                'anotherItem' => [
                    1,
                    [
                        'someKey' =>'anotherValue',
                    ]
                ],
            ],
            [
                'data' => [
                    1,
                    'items' => [
                        ['item' => 'value1'],
                        [
                            'item' => 'value',
                            'anotherItem' => [
                                1,
                                [
                                    'someKey' => 'anotherValue',
                                ]
                            ]
                        ],
                    ],
                ]
            ],
            true,
        ];
    }
}
