<?php

namespace App\Service;

use App\Contract\EventLoaderInterface;
use App\Contract\EventSourceInterface;
use App\Contract\EventStorageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Lock\LockFactory;

class EventLoader implements EventLoaderInterface
{
    /**
     * @param EventSourceInterface[] $sources
     * @param EventStorageInterface $storage
     * @param LockFactory $lockFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        private array $sources,
        private EventStorageInterface $storage,
        private LockFactory $lockFactory,
        private LoggerInterface $logger
    ) {}

    /**
     * Load events
     *
     * @return void
     */
    public function load(): void
    {
        $this->logger->info("Loading event sources");

        foreach ($this->sources as $source) {

            // lock the source
            $lock = $this->lockFactory->createLock($source->getName(), 5.0);

            // check is already processing
            if (!$lock->acquire()) {
                continue;
            }

            try {
                while (true) {
                    // retrieve events
                    $lastId = $this->storage->getLastId($source->getName());
                    $events = $source->getEvents($lastId);

                    if (empty($events)) {
                        $this->logger->info("[{$source->getName()}] No new events.");
                        break;
                    }

                    $this->logger->info("[{$source->getName()}] Events received");

                    // iterate and store events
                    foreach ($events as $event) {
                        $this->storage->store($event);
                        $this->logger->info("[{$source->getName()}] {$event->getData()->message} stored");
                    }

                    // 200ms delay
                    usleep(200000);
                }
            } catch (\Exception $e) {
                $this->logger->error("Failed to retrieve events from source: {$source->getName()}, {$e->getMessage()}");
            } finally {
                $lock->release();
            }
        }
    }
}
