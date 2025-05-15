<?php

namespace App\Contract;

use App\Entity\Event;

interface EventSourceInterface
{
    /**
     * Event name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Generates next batch of events
     *
     * @param int|null $lastEventId
     * @return Event[]
     */
    public function getEvents(?int $lastEventId): array;
}
