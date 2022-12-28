FROM nginx:alpine

ENV TZ=Europe/Moscow

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
