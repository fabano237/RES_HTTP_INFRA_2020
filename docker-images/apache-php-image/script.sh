#!/bin/bash

# Entré user nom image 
read -p "entrré le nom de l'image: " IMAGE

# Vérifications des entrées utilisateur
if [ -z "$IMAGE" ]; then
    exit
fi
docker kill $(docker ps -q --filter ancestor=$IMAGE)
docker rm   $(docker ps -a -q --filter ancestor=$IMAGE)
docker build -t $IMAGE .
docker run -d $IMAGE
