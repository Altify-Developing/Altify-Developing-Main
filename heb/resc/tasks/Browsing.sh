#!/bin/bash

arr[0]="bot: Altify Browser - Statistics | Task"
arr[1]="bot: Altify Browser - Statistics | Task"
arr[2]="bot: Altify Browser - Statistics | Task"
arr[3]="bot: Altify Browser - Statistics | Task"
arr[4]="bot: Altify Browser - Statistics | Task"
arr[5]="bot: Altify Browser - Statistics | Task"
arr[6]="bot: Altify Browser - Statistics | Task"
arr[7]="bot: Altify Browser - Statistics | Task"

ayb[0]="Q. How did the programmer die in the shower?
A. He read the shampoo bottle instructions: Lather. Rinse. Repeat."
ayb[1]="How many programmers does it take to change a light bulb?
None – It’s a hardware problem"
ayb[2]="There are only 10 kinds of people in this world: those who know binary and those who don’t."
ayb[3]="Knock, knock.
Who’s there?
very long pause….
Java."
ayb[4]="Programming is 10% science, 20% ingenuity, and 70% getting the ingenuity to work with the science."
ayb[5]="Programming is like sex:
One mistake and you have to support it for the rest of your life."
ayb[6]="A man is smoking a cigarette and blowing smoke rings into the air.  His girlfriend becomes irritated with the smoke and says, Can’t you see the warning on the cigarette pack?  Smoking is hazardous to your health!
To which the man replies, I am a programmer.  We don’t worry about warnings; we only worry about errors."
ayb[7]="There are three kinds of lies: Lies, damned lies, and benchmarks."
ayb[8]="A programmer is walking along a beach and finds a lamp.  He rubs the lamp, and a genie appears.  I am the most powerful genie in the world.  I can grant you any wish, but only one wish.
The programmer pulls out a map, points to it and says, I’d want peace in the Middle East.
The genie responds, Gee, I don’t know.  Those people have been fighting for millennia.  I can do just about anything, but this is likely beyond my limits.
The programmer then says, Well, I am a programmer, and my programs have lots of users.  Please make all my users satisfied with my software and let them ask for sensible changes.
At which point the genie responds, Um, let me see that map again."
ayb[9]="All programmers are playwrights, and all computers are lousy actors."
ayb[10]="Have you heard about the new Cray super computer?  It’s so fast, it executes an infinite loop in 6 seconds."
ayb[11]="The generation of random numbers is too important to be left to chance."
ayb[12]="I just saw my life flash before my eyes and all I could see was a close tag…"
ayb[13]="The computer is mightier than the pen, the sword, and usually, the programmer."
ayb[14]="Debugging: Removing the needles from the haystack."
ayb[15]="Two strings walk into a bar and sit down. The bartender says, So what’ll it be?
The first string says, I think I’ll have a beer quag fulk boorg jdk^CjfdLk jk3s d#f67howe%^U r89nvy~~owmc63^Dz x.xvcu
Please excuse my friend, the second string says, He isn’t null-terminated."
ayb[16]="From the Random Shack Data Processing Dictionary:
Endless Loop: n., see Loop, Endless.
Loop, Endless: n., see Endless Loop."
ayb[17]="The three most dangerous things in the world are a programmer with a soldering iron, a hardware engineer with a software patch, and a user with an idea.  – The Wizardry Compiled by Rick Cook"


rand=$[$RANDOM % ${#arr[@]}]
joke=$[$RANDOM % ${#ayb[@]}]
d=`date '+%Y-%m-%dT%H:%M:%SZ'`
git config --local user.email "Altify@mail.com"
git config --local user.name "Altify"
git --version > ./heb/resc/tasks/browser/info/version.md
git status > ./heb/resc/tasks/browser/info/status.md
git commit -a -m "${arr[$rand]} (at ${d})" -m "Tasks:
Browsing Information:
- Statistics
Runtime Logging:
- Status: https://github.com/Altify-Developing/Altify-Developing-Main/blob/main/heb/resc/tasks/browser/info/status.md
- Version: https://github.com/Altify-Developing/Altify-Developing-Main/blob/main/heb/resc/tasks/browser/info/version.md
Funny Message:
${ayb[$joke]}
Timestamp:
- Timestamp: ${d}"
