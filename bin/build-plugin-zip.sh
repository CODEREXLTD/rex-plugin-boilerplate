#!/bin/bash

# Exit if any command fails.
set -e

# Change to the expected directory.
cd "$(dirname "$0")"
cd ..

# Enable nicer messaging for build status.
BLUE_BOLD='\033[1;34m';
GREEN_BOLD='\033[1;32m';
RED_BOLD='\033[1;31m';
YELLOW_BOLD='\033[1;33m';
COLOR_RESET='\033[0m';

error () {
	echo -e "\n${RED_BOLD}$1${COLOR_RESET}\n"
}
status () {
	echo -e "\n${BLUE_BOLD}$1${COLOR_RESET}\n"
}
success () {
	echo -e "\n${GREEN_BOLD}$1${COLOR_RESET}\n"
}
warning () {
	echo -e "\n${YELLOW_BOLD}$1${COLOR_RESET}\n"
}

status "💃 Time to build the plugin ZIP file 🕺"

# Run the build.
status "Installing dependencies... 📦"
npm cache verify
npm ci
composer install --no-dev

status "Generating build... 👷‍♀️"
npm run build


# Generate the plugin zip file.
status "Creating archive... 🎁"
zip -r the-plugin-name.zip \
	the-plugin-name.php \
	includes \
	languages \
	views \
	build \
	vendor \
	readme.txt \
	changelog.txt \
	README.md

success "Done. You've built The Plugin Name! 🎉 "
