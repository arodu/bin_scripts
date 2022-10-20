#!/usr/bin/env bash

vmname="debian"
ip="debian.vm"

case "$1" in
start)
		echo "Server starting..."
		vboxmanage startvm "$vmname" --type headless
   ;;
stop)
		echo "Server stopping..."
		vboxmanage controlvm "$vmname" acpipowerbutton

   ;;
restart)
		echo "Server restarting..."
		vboxmanage controlvm "$vmname" reset
   ;;
status)
		echo "Server status..."
		vboxmanage list runningvms | grep $vmname
		ping -q -w 1 -c 1 $ip > /dev/null && echo "Online" || echo "Offline"
   ;;
*)
   echo "Usage: $0 {start|stop|status|restart}"
esac

exit 0
