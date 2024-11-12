#!/bin/bash
GIT='git@bitbucket.org:talgol/noc_new.git'
location=/www/wcs.softlh.com/cities

mkdir /tmp/repo_copy/
cd /tmp/repo_copy/
git clone $GIT


rm $location -rf 
mkdir $location

mv noc_new/api/util/config_server.php noc_new/api/util/config.php 

cp noc_new/light/* $location -r
cp noc_new/api $location/.. -r

cd ~
rm /tmp/repo_copy/ -rf

#echo $GIT
# echo $location