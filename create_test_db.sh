#!/bin/bash
set -e

DB_USER=${POSTGRES_USER:-root}
DB_PASSWORD=${POSTGRES_PASSWORD:-secret}
DB_NAME=${POSTGRES_DB:-default}
DB_HOST=${POSTGRES_HOST:-localhost}
TEST_DB_NAME="${DB_NAME}_test"

psql -v ON_ERROR_STOP=1 --username "$DB_USER" --host "$DB_HOST" --dbname "$DB_NAME" <<-EOSQL
    DROP DATABASE IF EXISTS $TEST_DB_NAME;
EOSQL

psql -v ON_ERROR_STOP=1 --username "$DB_USER" --host "$DB_HOST" --dbname "$DB_NAME" <<-EOSQL
    CREATE DATABASE $TEST_DB_NAME;
EOSQL

DUMP_FILE="/tests/_data/dump.sql"
psql -v ON_ERROR_STOP=1 --username "$DB_USER" --host "$DB_HOST" --dbname "$TEST_DB_NAME" < "$DUMP_FILE"
