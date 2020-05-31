

docker kill $(docker ps -q)
docker rm $(docker ps -a -q)

docker build -t res/apache_php apache-php-image/
docker build -t res/express_students express-image/
docker build -t res/apache_rp apache-reverse-proxy/ 

docker run -d res/apache_php
docker run -d res/apache_php
docker run -d res/apache_php
docker run -d --name apache_static res/apache_php

docker run -d res/express_students
docker run -d res/express_students
docker run -d --name express_dynamic res/express_students

docker inspect express_dynamic | grep -i ipaddr
docker inspect apache_static | grep -i ipaddr

docker run  -e STATIC_APP=172.17.0.5:80 -e DYNAMIC_APP=172.17.0.8:2020 --name apache_rp res/apache_rp





