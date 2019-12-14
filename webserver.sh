#!/usr/bin/env bash

case "$1" in
start)
		echo "WebServer starting..."
		systemctl start mysqld
		# systemctl start php-fpm
		systemctl start httpd
		echo "  Started"
		$0 status
	;;
stop)
		echo "WebServer stopping..."
		systemctl stop mysqld
		# systemctl stop php-fpm
		systemctl stop httpd
		echo "  Stoped"
		$0 status
	;;
restart)
		echo "WebServer restarting..."
		systemctl restart mysqld
		# systemctl restart php-fpm
		systemctl restart httpd
		echo "  Restarted"
		$0 status
	;;
status)
		echo "WebServer status..."
		# echo "  php-fpm: "$(systemctl status php-fpm | grep "Active" | sed 's/Active: //g')
		echo "  MySql:  "$(systemctl status mysqld | grep "Active" | sed 's/Active: //g')
		echo "  Apache: "$(systemctl status httpd | grep "Active" | sed 's/Active: //g')
   ;;
*)
   echo "Usage: $0 {start|stop|status|restart}"
esac

exit 0
