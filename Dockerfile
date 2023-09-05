FROM webdevops/php-nginx:8.2
ARG APP_ENV=production
ENV APP_ENV "$APP_ENV"
ENV fpm.pool.clear_env no
ENV fpm.pool.pm=ondemand
ENV fpm.pool.pm.max_children=50
ENV fpm.pool.pm.process_idle_timeout=10s
ENV fpm.pool.pm.max_requests=500
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1

COPY ./infra/nginx/*.conf /opt/docker/etc/nginx/vhost.common.d/

# Define an alias for 'php bin/console'
RUN echo 'alias sf="php bin/console"' >> ~/.bashrc

#Crontab setup
COPY ./infra/cron/* /etc/cron.d
RUN chmod 0644 /etc/cron.d/crontab
RUN touch /var/log/cron.log
CMD cron && tail -f /var/log/cron.log

# Set the working directory
WORKDIR /tmp

# Install procps (if needed)
RUN apt-get update && apt-get install -y procps

# Install Composer
RUN wget -O composer-setup.php --progress=bar:force https://getcomposer.org/installer
RUN php composer-setup.php --install-dir=/usr/bin --version=2.5.5
RUN rm -f composer-setup.php

# Copy the Symfony project files into the container
COPY --chown=www-data:www-data ./app /app

# Set the working directory to /app
WORKDIR /app

# Install required libraries for Symfony
RUN apt-get install libxrender1 libxext6 -y

# Install Symfony dependencies based on the environment
RUN if [ "$APP_ENV" = "development" ]; then composer install; else composer install --no-dev --optimize-autoloader; fi
