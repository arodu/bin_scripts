#!/usr/bin/env bash

case "$1" in
left)
	#killall plank && nohup plank &
	xrandr --output LVDS1 --left-of VGA1
	#xfconf-query -c xfce4-panel -p /panels/panel-0/output-name -s monitor-0
	;;
right)
	#killall plank && nohup plank &
	xrandr --output VGA1 --left-of LVDS1
	#xfconf-query -c xfce4-panel -p /panels/panel-0/output-name -s monitor-1
	;;
*)
   echo "Usage: $0 {left|right}"
esac

exit 0
