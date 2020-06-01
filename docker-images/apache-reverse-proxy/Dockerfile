FROM php:7.2-apache

RUN apt-get update && \
    apt-get install -y vim

COPY apache2-foreground /usr/local/bin/
COPY templates /var/apache2/templates
COPY conf/ /etc/apache2

#LABEL "traefik.backend"="apache_rp"
#LABEL "traefik.backend.loadbalancer.sticky"="false"
#LABEL "traefik.frontend.rule"="PathPrefix: /"
#LABEL "traefik.port"="80"

RUN a2enmod proxy proxy_http
RUN a2enmod proxy_balancer status lbmethod_byrequests
RUN a2ensite 000-* 001-*

