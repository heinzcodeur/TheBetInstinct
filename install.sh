#!/bin/bash

# build docker conatiners
docker-compose up -d 

docker-compose run apache ./install.sh

# stop 
# docker-compose stop
#
# down
# docker-compose down
#
# restart
# docker-compose restart
#
# delete all container
# docker system prune -a