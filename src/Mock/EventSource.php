<?php

namespace App\Mock;

use App\Contract\EventSourceInterface;
use App\Entity\Event;

class EventSource implements EventSourceInterface
{
    /**
     * @const - Maximum number of events that source can have
     */
    private const MAX_MOCK_EVENTS = 2000;

    /**
     * @param string $name - Name of the event source
     */
    public function __construct(private string $name) {}

    /**
     * Get the name of the event source
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Generates next batch of events
     *
     * @param int|null $lastEventId
     * @return array|Event[]
     */
    public function getEvents(?int $lastEventId = null): array
    {
        $startFrom = $lastEventId ? $lastEventId + 1 : 1;

        if ($startFrom >= self::MAX_MOCK_EVENTS) {
            return [];
        }

        $remaining = self::MAX_MOCK_EVENTS - $startFrom + 1;
        $batch = min(rand(500, 1000), $remaining);
        $endAt = $startFrom + $batch - 1;
        $events = [];

        for ($i = $startFrom; $i <= $endAt; $i++) {
            $event = new Event();
            $event->setId($i);
            $event->setSource($this->name);
            $event->setData(['message' => 'Event #' . $i]);
            $events[] = $event;
        }

        return $events;
    }
}