#!/bin/bash
while read line
do
	num=`echo $line|awk '{print $1}'`
	url=`echo $line|awk '{print $2}'`
	echo $num,$url
	echo "wget -P pages $url"
        wget -P pages $url
done<url_list.txt

