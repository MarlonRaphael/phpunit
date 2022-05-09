FROM php:8.1-cli

WORKDIR /app

ENV DEBIAN_FRONTEND noninteractive
ENV TZ="America/Sao_Paulo"

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git libcap2-bin libpng-dev python2 \
    && php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#COPY ./docker/8.1/timezone-pt-br.ini /etc/php/8.1/cli/conf.d/timezone-pt-br.ini

COPY start-container /usr/local/bin/start-container
#COPY php.ini /etc/php/8.1/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80

ENTRYPOINT ["start-container"]
