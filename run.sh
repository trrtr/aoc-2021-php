#!/bin/bash

docker run --rm --volume $(pwd)/:/solutions php:8-alpine php /solutions/run.php $1
