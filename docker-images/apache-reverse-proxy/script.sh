#!/bin/bash

docker kill $(docker ps -q)
docker rm   $(docker ps -a -q)
docker run --name apache_static -d res/apache_php
docker run --name express_dynamic -d res/express_students

docker build -t res/apache_rp .
docker run --name apache_rp res/apache_rp
