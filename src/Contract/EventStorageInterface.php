<?php

namespace App\Contract;

use App\Entity\Event;

interface EventStorageInterface
{
    /**
     * Store an event
     *
     * @param Event $event
     * @return void
     */
    public function store(Event $event): void;

    /**
     * Retrieve last stored event ID by source
     *
     * @param string $source
     * @return int
     */
    public function getLastId(string $source): int;
}