#!/bin/bash
location="/home/nafis/sites/wcs/bfd-noc/"
# file_upload="/home/nafis/sites/wcs/noc_images/file_upload"

this_file_location="/home/nafis/tmp_code/noc"

function create_folder(){
    if [ -d "$1" ]; then  
        echo "remove folder ($1) it??" 
        rm -rf $1
    fi
    mkdir $1
}


function action(){
    
    create_folder $this_file_location
    mv /home/nafis/tmp_code/noc.zip $this_file_location/
    cd $this_file_location

    unzip noc.zip
    rm noc.zip
    # mv file_upload $file_upload
     rm "$location/api" -rf
     rm "$location/f2" -rf
    cp -r * $location
}

action