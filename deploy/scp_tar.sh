#!/bin/bash

# SCP the tar that was just made to the deploymnent server
scp /home/it490/Documents/backups/* it490@192.168.1.56:/home/it490/Documents/backups/

#delete local bundle after scp to deployment server
rm -r /home/it490/Documents/backups/*

