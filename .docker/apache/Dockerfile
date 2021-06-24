FROM httpd:2.4.48-alpine

RUN apk update
RUN apk upgrade

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

# Copy apache vhost file to proxy php requests to php-fpm container
COPY dev.apache.conf /usr/local/apache2/conf/dev.apache.conf
RUN echo "Include /usr/local/apache2/conf/dev.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf