#!/usr/bin/env bash

watch -n 1 "awk 'NR==3 {print \"Signal strength = \" \$3 \"00 %\"}''' /proc/net/wireless"
