#!/bin/bash

ip='192.168.1.55'

grn=$'\e[1;32m'
red=$'\e[1;31m'

while true; do
	
	if ping -c 1 $ip &> /dev/null
	then
		echo "${grn}Primary Database is up!"
		sleep 2 
	else
		echo "${red}Primary Database is down, changing to standby DB"
		php changeDBIP.php
		break
	fi
done
