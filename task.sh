#!/bin/bash

arr[1]="bot: Altify Update - requisition | Tasks Running | Funny Message: 👋 = Command Line Argument Parser"
arr[2]="bot: Altify Update - requisition | Tasks Running | Funny Message: 404 - You have fat fingers"
arr[3]="bot: Altify Update - requisition | Tasks Running | Funny Message: click here for free stuff"
arr[4]="bot: Altify Update - requisition | Tasks Running | Funny Message: code = copy and paste"
arr[5]="bot: Altify Update - requisition | Tasks Running | Funny Message: StackOverflow users"
arr[6]="bot: Altify Update - requisition | Tasks Running | Funny Message: You are a good developer"
arr[7]="bot: Altify Update - requisition | Tasks Running | Funny Message: me writing in .sh"
arr[8]="bot: Altify Update - requisition | Tasks Running | Funny Message: 403 Internet Poop"

col[1]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/tos, 127) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[2]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/tos, 5000) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[3]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/tos, 80) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[4]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/toolstodownload, 127) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[5]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/toolstodownload, 5000) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[6]="function FindProxyForURL(https://altify-developing-001.netlify.app/html/toolstodownload, 80) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[7]="function FindProxyForURL(https://altify-developing-001.netlify.app/, 127) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[8]="function FindProxyForURL(https://altify-developing-001.netlify.app/, 5000) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
col[9]="function FindProxyForURL(https://altify-developing-001.netlify.app/, 80) {
  Creator: 'altify.developing.llc' { json-usage.manager:\n
  {
    'name': 'altify-main-site',
    'version': '1.0.0',
    'description': 'main site',
    'main': 'index.html',
    'scripts': {
      'test': 'echo \'Error: no test specified\' && exit 1'
    },
   'author': 'Altify',
    'license': 'MIT License',
  }  
}"
rand3=$[$RANDOM % ${#col[@]}]


rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`

echo "## 🤔 LAST UPDATED AT: ${d}" > update.md
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify-Development"
git commit -am "${arr[$rand]} (at ${d})"
#heb/resc/numbers
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > heb/resc/numbers/10
git commit -am "${arr[$rand]} (at ${d})"
#heb/resc/sectors
rand3=$[$RANDOM % ${#col[@]}]
echo "${col[$rand3]}" > heb/resc/sectors/sc1.pac
git commit -am "proxy config pt1 (at ${d})"
rand3=$[$RANDOM % ${#col[@]}]
echo "${col[$rand3]}" > heb/resc/sectors/sc2.pac
git commit -am "proxy config pt2 (at ${d})"
rand3=$[$RANDOM % ${#col[@]}]
echo "${col[$rand3]}" > heb/resc/sectors/sc3.pac
git commit -am "proxy config pt3 (at ${d})"
