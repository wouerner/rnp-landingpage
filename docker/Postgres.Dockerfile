FROM postgres:9.5-alpine
COPY ./docker/docker-entrypoint-initdb.d/ /docker-entrypoint-initdb.d/
EXPOSE 5432
