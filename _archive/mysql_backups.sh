#!/usr/bin/env bash

dir=/home/eltubazo/mysql_backups/
daysbackup=7
user=user_name
password=password
dbname=database_name
filename=$dbname_$(date +%Y%m%d%H%M%Z)

mysqldump --user=$user --password=$password $dbname > $dir$filename.sql

cd $dir
tar -zcvf $filename.tar.gz *.sql

find -name '*.tar.gz' -type f -mtime +$daysbackup -exec rm -f {} \;