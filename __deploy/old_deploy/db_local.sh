#!/bin/bash
SERVER_IP=139.180.187.129
SERVER_location=/home/nafis/tmp_code/
scp ../noc-database/cities_noc.sql.gz $SERVER_IP:$SERVER_location
scp db_remote.sh  $SERVER_IP:$SERVER_location
ssh $SERVER_IP $SERVER_location/db_remote.sh

echo $SERVER_IP

