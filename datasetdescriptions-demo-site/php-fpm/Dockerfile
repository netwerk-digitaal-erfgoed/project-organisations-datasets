FROM phpdockerio/php74-fpm:latest

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
#   && apt-get -y --no-install-recommends install php7.4-mysql \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
	
RUN sed -i 's/9000/9001/' /etc/php/7.4/fpm/pool.d/z-overrides.conf
