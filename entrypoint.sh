#!/usr/bin/env bash

echo "ENTRYPOINT_XXX"
usermod -u 1000 www-data
groupmod -g 1000 www-data
/usr/local/bin/docker-entrypoint.sh apache2-foreground