#!/usr/bin/env bash

presition=4;

export M="$(echo "scale=$presition; "$@"" | bc -l)"
echo $M


