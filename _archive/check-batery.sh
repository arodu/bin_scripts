#!/usr/bin/env bash

upower -i $(upower -e | grep 'BAT') | grep -E "state|to\ full|percentage"