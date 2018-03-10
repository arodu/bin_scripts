#!/usr/bin/env bash

case "$1" in
start)
		echo "WebServer starting..."
		systemctl start mysqld
		#systemctl start php-fpm
		systemctl start httpd
		echo "Started"
	;;
stop)
		echo "WebServer stopping..."
		systemctl stop mysqld
		#systemctl stop php-fpm
		systemctl stop httpd
		echo "Stoped"
	;;
restart)
		echo "WebServer restarting..."
		systemctl restart mysqld
		#systemctl restart php-fpm
		systemctl restart httpd
		echo "Restarted"
	;;
status)
		echo "WebServer status..."
		#echo "  php-fpm: "$(systemctl status php-fpm | grep "Active" | sed 's/Active: //g')
		echo "  mysql:  "$(systemctl status mysqld | grep "Active" | sed 's/Active: //g')
		echo "  apache2: "$(systemctl status httpd | grep "Active" | sed 's/Active: //g')
   ;;
*)
   echo "Usage: $0 {start|stop|status|restart}"
esac

exit 0
