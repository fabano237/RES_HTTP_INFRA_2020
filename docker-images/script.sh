


docker kill $(docker ps -q)
docker rm $(docker ps -a -q)

docker build -t res/apache_php apache-php-image/
docker build -t res/express_students express-image/
docker build -t res/apache_rp apache-reverse-proxy/ 

docker run -d --name apache-static1 res/apache_php
docker run -d --name apache-static2 res/apache_php
docker run -d --name apache-static3 res/apache_php
docker run -d --name express-dynamic1 res/express_students
docker run -d --name express-dynamic2 res/express_students
docker run -d --name express-dynamic3 res/express_students
docker run -d -e STATIC_APP1=172.17.0.2:80 -e STATIC_APP2=172.17.0.3:80 -e STATIC_APP3=172.17.0.4:80 \
-e DYNAMIC_APP1=172.17.0.5:2020 -e DYNAMIC_APP2=172.17.0.6:2020 -e DYNAMIC_APP2=172.17.0.7:2020 --name apache-reverse-proxy res/apache_rp





#docker run  -e STATIC_APP=172.17.0.5:80 -e DYNAMIC_APP=172.17.0.8:2020 --name apache_rp res/apache_rp





