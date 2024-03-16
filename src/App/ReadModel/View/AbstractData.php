<?php

declare(strict_types=1);

namespace App\ReadModel\View;

class AbstractData
{
    public function __construct(array $properties)
    {
        /** @psalm-var mixed $value */
        foreach ($properties as $property => $value) {
            if (true === \is_string($value)) {
                $value = trim($value);

                if ('' === $value) {
                    continue;
                }
            }

            if (null === $value) {
                continue;
            }

            $method = 'set' . str_replace(
                    ' ',
                    '',
                    mb_convert_case(
                        str_replace('_', ' ', (string) $property),
                        \MB_CASE_TITLE,
                        'UTF-8'
                    )
                );

            if (\is_callable([$this, $method])) {
                $this->{$method}($value); /* @phpstan-ignore-line */

                continue;
            }

            if (property_exists(static::class, $property)) {
                $this->{$property} = $value; /* @phpstan-ignore-line */
            }
        }
    }
}