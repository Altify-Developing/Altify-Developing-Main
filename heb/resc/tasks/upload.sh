#!/bin/bash

arr[0]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: 503 Internet Poop"
arr[1]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: 👋 = Command Line Argument Parser"
arr[2]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: 404 - You have fat fingers"
arr[3]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: click here for free stuff"
arr[4]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: code = copy and paste"
arr[5]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: StackOverflow users"
arr[6]="bot: Altify Log - Launched By: ${{ github.actor }}- information | Storage Task | Funny Message: You are a good developer"
arr[7]="bot: Altify Log - Launched By: ${{ github.actor }} - information | Storage Task | Funny Message: me writing in shell"

rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify"
git log -95 > ./heb/resc/tasks/logs/log.md
curl -H "Accept: application/vnd.github.v3+json owner: ${{ github.actor }}" https://api.github.com/repos/Altify-Developing/Altify-Developing-Main/traffic/clones > ./heb/resc/tasks/logs/traffic.md
curl -H "Accept: application/vnd.github.v3+json" https://api.github.com/repos/OWNER/REPO/stats/code_frequency 
git commit -am "${arr[$rand]} (at ${d})"
git --version > ./heb/resc/tasks/logs/git/version.md
git status > ./heb/resc/tasks/logs/git/status.md
git commit -a -m "${arr[$rand]} (at ${d})" -m "Logging Information:
- Status: https://github.com/Altify-Developing/Altify-Developing-Main/blob/main/heb/resc/tasks/logs/git/status.md
- Version: https://github.com/Altify-Developing/Altify-Developing-Main/blob/main/heb/resc/tasks/logs/git/version.md
- Timestamp: ${d}"
