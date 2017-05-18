#!/usr/bin/env bash

if [[ "$1" == "--panel" ]]; then
	ping -q -w 1 -c 1 8.8.8.8 > /dev/null && echo "<txt><span foreground=\"#FFF\">Online</span></txt>" || echo "<txt><span foreground=\"#F00\">Offline</span></txt>"
else
	ping -q -w 1 -c 1 8.8.8.8 > /dev/null && echo "Online" || echo "Offline"
fi
