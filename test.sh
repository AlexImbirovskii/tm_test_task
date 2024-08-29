#!/bin/bash

vendor/bin/codecept build

chmod +x dump.sh

chmod +x create_test_db.sh

docker compose exec database ./dump.sh

docker compose exec database ./create_test_db.sh

docker compose exec php vendor/bin/codecept run
