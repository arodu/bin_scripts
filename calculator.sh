#!/usr/bin/env bash

presition=4

echo "scale=$presition; "$@"" | bc -l