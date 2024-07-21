<?php

namespace Mguinea\RouteLoader;

use Illuminate\Support\Collection;

interface RouteLoaderInterface
{
    public function load(): RouteCollection;
}
