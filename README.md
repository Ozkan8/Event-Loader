# Event Loader App

## Quick Start
1. ``` git clone https://github.com/Ozkan8/Event-Loader.git ```
2. ``` cd Event-Loader ```
3. ``` docker-compose build --no-cache ```
4. ``` docker-compose up -d ```
5. ``` docker exec -it app /bin/bash ```
6. ``` ./bin/run-multiple-loaders.sh ``` OR ``` php bin/console app:events:load -vv ```
