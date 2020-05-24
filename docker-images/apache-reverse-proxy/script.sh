#!/bin/bash

# Entré user nom image 
read -p "entrré le nom de l'image: " IMAGE

# Vérifications des entrées utilisateur
if [ -z "$IMAGE" ]; then
    exit
fi
docker kill $(docker ps -q --filter ancestor=$IMAGE)
docker rm   $(docker ps -a -q --filter ancestor=$IMAGE)
docker run -d res/apache_php
docker run -d res/express_students

docker build -t $IMAGE .
docker run $IMAGE
