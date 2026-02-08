FROM registry.access.redhat.com/ubi9/php-83

# Copy application source
COPY . /opt/app-root/src

USER 1001

EXPOSE 8080

CMD ["/usr/libexec/s2i/run"]
