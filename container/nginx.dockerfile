FROM nginx:alpine

ARG UID
ARG GID
ARG USER

ENV UID=${UID}
ENV GID=${GID}
ENV USER=${USER}

RUN delgroup dialout

RUN addgroup -g ${GID} --system ${USER}
RUN adduser -G ${USER} --system -D -s /bin/sh -u ${UID} ${USER}
RUN sed -i "s/user nginx/user ${USER}/g" /etc/nginx/nginx.conf

ADD docker/nginx/breeze.local.conf /etc/nginx/conf.d

RUN mkdir -p /var/www/html
