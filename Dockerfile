FROM quay.io/continuouspipe/symfony-php7.1-nginx:latest
ARG GITHUB_TOKEN=
ARG SYMFONY_ENV=prod
ENV SYMFONY_ENV $SYMFONY_ENV

RUN apt-get update -qq -y && DEBIAN_FRONTEND=noninteractive apt-get -qq -y --no-install-recommends install php-xdebug

COPY docker/etc/ /etc/
COPY . /app
RUN container build