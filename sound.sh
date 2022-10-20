#!/bin/bash

cd "$1";

for FILE in *.webm; do
    echo -e "Processing video '\e[32m$FILE\e[0m'";
    ffmpeg -i "${FILE}" "${FILE%.webm}.mp3";
    rm $FILE;
done;

for FILE in *.wma; do
    echo -e "Processing video '\e[32m$FILE\e[0m'";
    ffmpeg -i "${FILE}" "${FILE%.wma}.mp3";
    rm $FILE;
done;

# sound . 