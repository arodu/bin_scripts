#! /bin/env bash

ip r | grep default | cut -d ' ' -f 3
