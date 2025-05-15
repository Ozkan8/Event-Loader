<?php

namespace App\Contract;

interface EventLoaderInterface
{
    /**
     * Load events
     *
     * @return void
     */
    public function load(): void;
}