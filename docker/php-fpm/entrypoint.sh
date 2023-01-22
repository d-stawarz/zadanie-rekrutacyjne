#!/bin/bash

php bin/console d:s:u -f
php bin/console d:m:m
php bin/console fos:elastica:populate --no-debug --env=dev