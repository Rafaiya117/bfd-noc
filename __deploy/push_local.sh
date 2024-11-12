#!/bin/bash
## "Online NOC Application System" ONAS
SERVER="wcs.softlh.com"
zip_file="$(pwd)/noc.zip"
tmp_folder="$(pwd)/temp_project"
main_folder="$(pwd)"

function create_folder(){
    if [ -d "$1" ]; then  
        echo "remove folder ($1) it??" 
        rm -rf $1
    fi
    mkdir $1
}



function build(){
    echo $main_folder
    create_folder $tmp_folder
    rm -rf $zip_file

    #cd ../

    cp -r ../api $tmp_folder
    cp -r ../f2 $tmp_folder
    # cp -r ../file_upload $tmp_folder
    
    cp $tmp_folder/api/util/config_server.php $tmp_folder/api/util/config.php
    cd $tmp_folder
    zip -r $zip_file .

}

function run_up(){
    ssh $SERVER 'rm /home/nafis/tmp_code/* -rf'
    scp $zip_file $SERVER:/home/nafis/tmp_code/
    rm -rf $tmp_folder
    rm $zip_file
    scp "$main_folder/_remote_unzip_and_run_cities.sh" "$SERVER:/home/nafis/tmp_code/"
    ssh $SERVER 'chmod +x /home/nafis/tmp_code/_remote_unzip_and_run_cities.sh; /home/nafis/tmp_code/_remote_unzip_and_run_cities.sh'
}

build
run_up