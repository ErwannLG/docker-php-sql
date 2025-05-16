# Configuration de l'image PHP avec Apache
FROM php:8.3-apache

# Mise à jour du système
RUN apt-get update && apt-get upgrade -y

# Installation et activation des extensions PHP nécessaires pour MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo pdo_mysql

# Port HTTP
EXPOSE 80