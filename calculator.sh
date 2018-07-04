#!/usr/bin/env bash

presition=4

echo \t"scale=$presition; "$@"" | bc -l
