#!/bin/bash

arr[0]="bot: 👋 Hello Github!"
arr[1]="bot: 🥳 Yeayyy!"
arr[2]="bot: 😬 Working from github."
arr[3]="bot: 👨‍💻 Work, work, work!"
arr[4]="bot: 😪 Hufft..."
arr[5]="bot: 😎 I'm working for my master!"
arr[6]="bot: 🙄 Running task, again."
arr[7]="bot: 👻 Thanks master."

rand=$[$RANDOM % ${#arr[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`

echo "## 🤔 LAST UPDATED AT: ${d}" > update.md
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify-Development"
git commit -am "${arr[$rand]} (at ${d})"
#numbers
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers2
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers2/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers3
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers3/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers4
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers4/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers5
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers5/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers6
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers6/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers7
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers7/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers8
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers8/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers9
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers9/10
git commit -am "${arr[$rand]} (at ${d})"
#numbers10
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/1
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/2
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/3
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/4
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/5
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/6
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/7
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/8
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/9
git commit -am "${arr[$rand]} (at ${d})"
rand=$[$RANDOM % ${#arr[@]}]
echo "## 🤔 LAST UPDATED AT: ${d}" > numbers10/10
git commit -am "${arr[$rand]} (at ${d})"
