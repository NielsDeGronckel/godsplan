FROM ubuntu:latest
LABEL authors="niels"

ENTRYPOINT ["top", "-b"]