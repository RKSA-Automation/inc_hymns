#!/bin/bash

# Start MySQL service
/usr/local/bin/docker-entrypoint.sh mysqld &

# Wait for MySQL to start
sleep 5

# Import the SQL dump file into MySQL
mysql -u inc_hymns -pmasunurin inc_hymns < /docker-entrypoint-initdb.d/inc_hymns.sql

# Keep the container running
tail -f /dev/null
