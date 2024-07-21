<?php

namespace Mguinea\RouteLoader;

use Illuminate\Support\Collection;
use InvalidArgumentException;

abstract class AbstractTypedCollection extends Collection
{
    /** @var list<class-string> */
    protected static array $allowedTypes = [];

    public function __construct($items = [])
    {
        $this->assertValidTypes(...$items);

        parent::__construct($items);
    }

    protected function assertValidTypes(...$items): void
    {
        foreach ($items as $item) {
            $this->assertValidType($item);
        }
    }

    protected function assertValidType($item): void
    {
        foreach (static::$allowedTypes as $allowedType) {
            if ($item instanceof $allowedType) {
                return;
            }
        }
        throw new InvalidArgumentException(
            sprintf(
                'A %s collection only accepts objects of the following type(s): %s.',
                get_class($this),
                implode(', ', static::$allowedTypes)
            )
        );
    }
}
