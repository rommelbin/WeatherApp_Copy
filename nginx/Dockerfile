FROM nginx:1.19.6-alpine

ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait
RUN chmod +x /wait

COPY nginx.conf /etc/nginx/conf.d/default.conf

CMD /bin/sh -c "/wait && nginx -g 'daemon off;'"
