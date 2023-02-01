#!/bin/bash

# Install bundles
composer install

# database
php bin/console d:s:u -f
