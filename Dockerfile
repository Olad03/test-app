FROM registry.access.redhat.com/ubi9/php-83

# Switch to root to install updates
USER root

# 🔐 Apply security updates (fix brotli CVEs)
RUN dnf -y update \
    && dnf -y upgrade brotli libbrotli brotli-devel \
    && dnf clean all \
    && rm -rf /var/cache/dnf

# Copy application source
COPY . /opt/app-root/src

# Return to OpenShift non-root user
USER 1001

EXPOSE 8080

# Correct OpenShift PHP runtime
CMD ["/usr/libexec/s2i/run"]
