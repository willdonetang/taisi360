#!/bin/bash
while read line
do
	num=`echo $line|awk '{print $1}'`
	url=`echo $line|awk '{print $2}'`
	echo $num,$url
	echo "wget -O $num.jpg $url"
	wget -O $num.jpg $url
done<img_url.txt

