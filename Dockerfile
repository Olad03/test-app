FROM registry.access.redhat.com/ubi9/php-83

# Copy application
COPY . /opt/app-root/src

EXPOSE 8080

CMD ["run-httpd"]
