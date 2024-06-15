#!/bin/bash

# Color variables
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to kill processes by port
kill_process_by_port() {
    read -rp "Enter the port number: " port
    if [[ -n "$port" ]]; then
        PIDS=$(sudo lsof -t -i :"$port")
        if [ -n "$PIDS" ]; then
            echo "Processes using port $port: $PIDS"
            for PID in $PIDS; do
                echo "Killing process $PID"
                sudo kill -9 "$PID"
                if [ $? -eq 0 ]; then
                    echo -e "${GREEN}Process $PID killed successfully.${NC}"
                else
                    echo -e "${RED}Failed to kill process $PID.${NC}"
                fi
            done
        else
            echo -e "${YELLOW}No process is using port $port.${NC}"
        fi
    else
        echo -e "${RED}Port number cannot be empty.${NC}"
    fi
}

# Main script starts here
kill_process_by_port
