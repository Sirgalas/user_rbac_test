#!/bin/sh

cd $(dirname $0)

cp ./.env.example .env


cp ./config/development.local.php.example ./config/autoload/development.local.php
cp ./config/autoload/local.php.example  ./config/autoload/local.php

chmod 777 .env
chmod 777 ./config/autoload/development.local.php
chmod 777 ./config/autoload/local.php

make install
