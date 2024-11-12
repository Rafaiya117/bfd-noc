#!/bin/bash
SERVER_IP=139.180.187.129
SERVER_location=/home/nafis/tmp_code/

scp remote.sh  $SERVER_IP:$SERVER_location
ssh $SERVER_IP $SERVER_location/remote.sh

echo $SERVER_IP





