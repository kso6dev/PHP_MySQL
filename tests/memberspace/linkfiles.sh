#!/bin/bash

# linkfiles.sh
# copy this file in a folder and execute to replicate all files
# in another folder with physical link between files

# get curr directory name
currdirname=${PWD##*/}
echo $currdirname

# create same directory name in apache web root
targetdir="/opt/lampp/htdocs/tests/"
targetdir+=$currdirname
echo $targetdir

# it directory exists, we remove it and create it again
if [[ -d $targetdir ]]; then
    rm -r $targetdir
    sleep 1
fi
mkdir $targetdir
sleep 1

# for each file in current directory, we create a physically linked file
for srcfile in `ls`
do
    destfile=$targetdir/"$(echo $srcfile)"
    ln $srcfile $destfile
    echo $destfile
done

echo "process done"
