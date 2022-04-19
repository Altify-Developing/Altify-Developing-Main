#!/bin/bash

value=$(<./heb/resc/tasks/maths.txt)
echo "$value"
add=1
ans=${{ value + add }}
echo "$ans"
