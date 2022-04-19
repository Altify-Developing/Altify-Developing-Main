#!/bin/bash
arr[0]="bot: Altify Log - Version | History Task"
arr[1]="bot: Altify Log - Version | History Task"
arr[2]="bot: Altify Log - Version | History Task"
rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify"
value=$(<./heb/resc/tasks/maths.txt)
echo "$value"
add=1
ans=$(( value + add ))
echo "$ans" > ./heb/resc/tasks/maths.txt
git log -1 >> ./heb/resc/tasks/logs/userinfo.txt
git commit -a -m "${arr[$rand]} (at ${d})" -m "Math Information:
- Current Verified Commit Counter: $ans Commits
- Last Commit Created By: ${{ github.actor }}
- Timestamp: ${d}"
git fetch --all
