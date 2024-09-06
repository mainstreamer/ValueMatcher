<?php
declare(strict_types=1);

namespace Epiclesys\ValueMatcher;

class ArrayMatcher
{
    public static function contains(array $needle, array $haystack): bool
    {
        $searchFor = self::generatePaths($needle);
        $searchIn = self::generatePaths($haystack);

        $found = [];
        foreach ($searchIn as $haystackItem) {
            foreach ($searchFor as $needleItem) {
                if (str_ends_with($haystackItem['path'], $needleItem['path'])
                    && $haystackItem['value'] === $needleItem['value']) {
                    $found[] = $needleItem;
                }
            }
        }

        $notFound = array_filter($searchFor, function ($key) use ($found) {
            return !in_array($key, $found);
        });

        return empty($notFound);
    }

    private static function generatePaths(array $needle, ?string $currentPath = null): array
    {
        $values = [];
        $currentPath = '';
        foreach ($needle as $key => $value) {
            $key = is_numeric($key) ? '$any' : $key;
            $currentPath = implode('.', [$currentPath, $key]);
            if (is_array($value)) {
                array_map(
                    function (array $currentValues) use ($currentPath, &$values)  {
                        $values[] = [
                            'path' => $currentPath.$currentValues['path'],
                            'value' => $currentValues['value'],
                        ];
                    },
                    self::generatePaths($value, $currentPath),
                );
            } else {
                $values[] = ['path' =>  $currentPath, 'value' => $value];
                $currentPath = null;
            }
        }

        return $values;
    }
}
