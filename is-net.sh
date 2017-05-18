#!/usr/bin/env bash

if [[ "$1" == "--panel" ]]; then
	ping -q -w 1 -c 1 8.8.8.8 > /dev/null && echo "<txt><span foreground=\"#FFF\">Online</span></txt>" || echo "<txt><span foreground=\"#F00\">Offline</span></txt>"
elif [[ "$1" == "--notify" ]]; then
	ping -q -w 1 -c 1 8.8.8.8 > /dev/null && notify-send "Net" "Online" -i /usr/share/pixmaps/pidgin/emblems/scalable/external.svg || notify-send "Net" "Offline" -i /usr/share/pixmaps/pidgin/emblems/scalable/not-authorized.svg
else
	ping -q -w 1 -c 1 8.8.8.8 > /dev/null && echo "Online" || echo "Offline"
fi
