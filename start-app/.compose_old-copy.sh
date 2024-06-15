#!/bin/bash

# Color variables
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to display the menu
show_menu() {
    echo "Select an action:"
    echo "1. Start Docker Compose Services"
    echo "2. Stop and Remove Docker Compose Services"
    echo "3. Rebuild and Start Docker Compose Services"
    echo "4. Show Docker Containers"
    echo "5. Execute Command in a Container"
    echo "6. Exit"
}

# Function to execute the selected action
execute_action() {
    case "$1" in
        1) docker compose up -d && echo -e "${GREEN}Services started successfully.${NC}" ;;
        2) docker compose down -v && echo -e "${GREEN}Services stopped and removed.${NC}" ;;
        3) docker compose up --build -d && echo -e "${GREEN}Services rebuilt and started.${NC}" ;;
        4) docker ps -a && echo -e "${GREEN}Docker containers listed.${NC}" ;;
        5) bash exec && echo -e "${GREEN}Executed exec.${NC}" ;;
        6) echo "Exiting..." ;;
        *) echo -e "${RED}Invalid option${NC}" ;;
    esac
}

# Main script starts here
while true; do
    show_menu

    read -rp "Enter your choice: " choice

    case "$choice" in
        1|2|3|4|5) 
            read -rp "Are you sure you want to continue? (y/n): " confirm
            if [[ "$confirm" =~ ^[Yy]$ ]]; then
                execute_action "$choice"
            else
                echo -e "${YELLOW}Action canceled.${NC}"
            fi
            ;;
        6) 
            echo "Exiting..."
            break 
            ;;
        *) 
            echo -e "${RED}Invalid option, please try again${NC}" ;;
    esac
done
