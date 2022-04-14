#!/bin/bash

arr[0]="bot: Altify Update - requisition | Tasks Running | Funny Message: 403 Internet Poop"
arr[1]="bot: Altify Update - requisition | Tasks Running | Funny Message: 👋 = Command Line Argument Parser"
arr[2]="bot: Altify Update - requisition | Tasks Running | Funny Message: 404 - You have fat fingers"
arr[3]="bot: Altify Update - requisition | Tasks Running | Funny Message: click here for free stuff"
arr[4]="bot: Altify Update - requisition | Tasks Running | Funny Message: code = copy and paste"
arr[5]="bot: Altify Update - requisition | Tasks Running | Funny Message: StackOverflow users"
arr[6]="bot: Altify Update - requisition | Tasks Running | Funny Message: You are a good developer"
arr[7]="bot: Altify Update - requisition | Tasks Running | Funny Message: me writing in .sh"

rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`
d2=`date -d '1 days ago' +'%B%d%Y'`
git --help log
git --no-pager --since=${d2} log > ./heb/resc/tasks/logs/log.md
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify-Development"
git commit -am "${arr[$rand]} (at ${d})"
