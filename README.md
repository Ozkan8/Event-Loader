# Event Loader App

## Quick Start
1. ``` git clone https://github.com/Ozkan8/Event-Loader.git ```
2. ``` cd Event-Loader ```
3. ``` docker-compose build --no-cache ```
4. ``` docker-compose up -d ```
5. ``` docker exec -it event_loader_app /bin/bash ```
6. ``` composer install ```
7. ``` ./bin/run-multiple-loaders.sh ``` OR ``` php bin/console app:events:load -vv ```

### Troubleshooting Script Execution Errors

If you see the following error when running the bash script:

```bash
bash: ./bin/run-multiple-loaders.sh: cannot execute: required file not found
```
it is likely caused by Windows-style line endings (CRLF) in the script file.

To fix this, convert the script to Unix-style line endings (LF) using the following command (inside docker container):

```bash
dos2unix bin/run-multiple-loaders.sh
```
Then run it again.
