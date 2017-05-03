FROM quay.io/continuouspipe/symfony-php7.1-nginx:latest
ARG GITHUB_TOKEN=
ARG SYMFONY_ENV=prod
ENV SYMFONY_ENV $SYMFONY_ENV

RUN apt-get install php-xdebug

COPY . /app
RUN container build