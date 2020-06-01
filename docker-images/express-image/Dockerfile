FROM node:8.10.0

RUN apt-get update && \
    apt-get install -y vim

COPY src /opt/app

#LABEL "traefik.backend"="express_dynamic"
#LABEL "traefik.backend.loadbalancer.sticky"="true"
#LABEL "traefik.frontend.rule"="PathPrefixStrip: /api/students"
#LABEL "traefik.port"="80"

CMD ["node", "/opt/app/index.js"]

