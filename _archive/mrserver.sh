#!/usr/bin/env bash

case "$1" in
start)
		echo "MR-Server starting..."
		systemctl start mongodb
		systemctl start redis
		echo "  Started"
		$0 status
	;;
stop)
		echo "MR-Server stopping..."
		systemctl stop mongodb
		systemctl stop redis
		echo "  Stoped"
		$0 status
	;;
restart)
		echo "MR-Server restarting..."
		systemctl restart mongodb
		systemctl restart redis
		echo "  Restarted"
		$0 status
	;;
status)
		echo "MR-Server status..."
		echo "  MongoDB: "$(systemctl status mongodb | grep "Active" | sed 's/Active: //g')
		echo "  Redis:   "$(systemctl status redis | grep "Active" | sed 's/Active: //g')
   ;;
*)
   echo "Usage: $0 {start|stop|status|restart}"
esac

exit 0
