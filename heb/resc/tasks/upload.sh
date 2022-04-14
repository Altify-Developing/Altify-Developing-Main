#!/bin/bash

arr[0]="bot: Altify Update - requisition | Tasks Running | Funny Message: 503 Internet Poop"
arr[1]="bot: Altify Update - requisition | Tasks Running | Funny Message: 👋 = Command Line Argument Parser"
arr[2]="bot: Altify Update - requisition | Tasks Running | Funny Message: 404 - You have fat fingers"
arr[3]="bot: Altify Update - requisition | Tasks Running | Funny Message: click here for free stuff"
arr[4]="bot: Altify Update - requisition | Tasks Running | Funny Message: code = copy and paste"
arr[5]="bot: Altify Update - requisition | Tasks Running | Funny Message: StackOverflow users"
arr[6]="bot: Altify Update - requisition | Tasks Running | Funny Message: You are a good developer"
arr[7]="bot: Altify Update - requisition | Tasks Running | Funny Message: me writing in shell"

rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`
git log --name-status HEAD^..HEAD
git log -95 > ./heb/resc/tasks/logs/log.md
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify"
git commit -am "${arr[$rand]} (at ${d})"
curl \
  -H "Accept: application/vnd.github.v3+json" \
  https://api.github.com/repos/Altify-Developing/Altify-Developing-Main/traffic/clones
