FROM registry.access.redhat.com/ubi9/php-83

# Copy application source
COPY . /opt/app-root/src

EXPOSE 8080

# Correct OpenShift PHP runtime
CMD ["/usr/libexec/s2i/run"]
