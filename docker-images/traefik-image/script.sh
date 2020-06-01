docker build -t res/traefik .
docker run -d -p 8080:80 -p 9000:9000 -v /var/run/docker.sock:/var/run/docker.sock res/traefik