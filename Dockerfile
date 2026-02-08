FROM registry.access.redhat.com/ubi9/php-83

# Switch to root for package updates
USER root

# 🔐 Apply security updates (fixes brotli CVEs)
RUN microdnf update -y \
    && microdnf upgrade -y brotli libbrotli brotli-devel \
    && microdnf clean all

# Copy application source
COPY . /opt/app-root/src

# Restore OpenShift non-root user
USER 1001

EXPOSE 8080

# Correct OpenShift PHP runtime
CMD ["/usr/libexec/s2i/run"]
