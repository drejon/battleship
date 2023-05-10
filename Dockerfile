FROM php:8.1-fpm AS base

ARG USER_ID=1000
ARG GROUP_ID=1000

ENV USERNAME servo
ENV WORKDIR /opt/app/
RUN addgroup --gid ${GROUP_ID} $USERNAME
RUN adduser --uid ${USER_ID} --gid ${GROUP_ID} --disabled-password --gecos '' --system $USERNAME

WORKDIR $WORKDIR
RUN chown -R ${USER_ID}:${GROUP_ID} .
USER $USERNAME


CMD ["php", "game.php"]

FROM base AS dev
COPY --chown=$USERNAME:$USERNAME . $WORKDIR
