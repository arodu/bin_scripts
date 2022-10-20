#!/usr/bin/env bash

current=$(xfconf-query -c xfce4-panel -p /panels/panel-$1/autohide-behavior)
 
if [[ "$current" == "1" ]]; then
 	current="0"
else
	current="1"
fi 
 
xfconf-query -c xfce4-panel -p /panels/panel-$1/autohide-behavior -s $current
