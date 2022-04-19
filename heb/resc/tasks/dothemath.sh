#!/bin/bash

value=$(<./heb/resc/tasks/maths.txt)
echo "$value"
add=.01
ans=$(( value + add ))
echo "$ans" > ./heb/resc/tasks/maths.txt
