<?php

namespace App\Service;

use App\Contract\EventStorageInterface;
use App\Entity\Event;

class FakeEventStorage implements EventStorageInterface
{
    /**
     * Array of events
     *
     * @var array
     */
    private array $events = [];

    /**
     * Array of last ID's
     *
     * @var array
     */
    private array $lastIds = [];

    /**
     * Store an event
     *
     * @param Event $event
     * @return void
     */
    public function store(Event $event): void
    {
        $this->events[] = $event;
        $this->lastIds[$event->getSource()] = $event->getId();
    }

    /**
     * Retrieve last stored event ID by source
     *
     * @param string $source
     * @return int
     */
    public function getLastId(string $source): int
    {
        return $this->lastIds[$source] ?? 0;
    }
}