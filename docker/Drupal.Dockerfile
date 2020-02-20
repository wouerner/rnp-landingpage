# base image
FROM drupal:7.57-apache

# remove a instalação padrão do Drupal
RUN rm -rf /var/www/html/*
# set working directory
WORKDIR /var/www/html/cms

# copiando os arquivos do Drupal 
COPY src/ . 

COPY docker/apache/ /etc/apache2/sites-enabled/
# copiando os certificados
COPY docker/certs/ /etc/apache2/ssl/
#COPY docker/certs/certificate.key /etc/apache2/ssl/

RUN a2enmod ssl 
RUN a2enmod headers

EXPOSE 443 
