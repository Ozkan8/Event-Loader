#!/bin/bash

# Number of loaders, default 2
NUM_LOADERS=${1:-2}

# Clear log file
> /app/var/log/events-log.txt

for i in $(seq 1 $NUM_LOADERS); do
    php bin/console app:events:load -vv --no-ansi >> /app/var/log/events-log.txt 2>&1 &
done

wait