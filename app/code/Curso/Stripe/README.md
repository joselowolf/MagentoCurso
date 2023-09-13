# Módulo Easy Payment

Este módulo tiene por objetivo demostrar de forma sencilla el funcionamiento de un módulo de pago en Magento 2 para tarjet de crédito.

## Instalar stripe
- composer config http-basic.repo.magento.com <public_key> <private_key>
- curl -s https://packages.stripe.dev/api/security/keypair/stripe-cli-gpg/public | gpg --dearmor | sudo tee /usr/share/keyrings/stripe.gpg
- echo "deb [signed-by=/usr/share/keyrings/stripe.gpg] https://packages.stripe.dev/stripe-cli-debian-local stable main" | sudo tee -a /etc/apt/sources.list.d/stripe.list
- sudo apt update
- sudo apt install stripe
- composer require stripe/stripe-php
