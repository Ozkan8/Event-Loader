<?php

namespace App\Command;

use App\Contract\EventLoaderInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:events:load',
    description: 'Load and store events',
)]
class LoadEventsCommand extends Command
{
    public function __construct(
        private EventLoaderInterface $eventLoader,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->eventLoader->load();
        return Command::SUCCESS;
    }
}
