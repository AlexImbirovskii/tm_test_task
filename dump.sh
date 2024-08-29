#!/bin/bash
set -e

DB_USER=${POSTGRES_USER:-root}
DB_PASSWORD=${POSTGRES_PASSWORD:-secret}
DB_NAME=${POSTGRES_DB:-default}
DB_HOST=${POSTGRES_HOST:-localhost}
DUMP_FILE="/tests/_data/dump.sql"

pg_dump --username "$DB_USER" --host "$DB_HOST" --dbname "$DB_NAME" --no-owner --file "$DUMP_FILE"
