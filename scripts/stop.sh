#!/bin/bash

kill $(ps aux | grep 'type=258' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'tail -f' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'tail -f' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'type=2:attacker' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'type=2:attacker' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'formatlog.sh' | awk '{print $2}')  > /dev/null 2>&1 &
kill $(ps aux | grep 'chat.sh' | awk '{print $2}')  > /dev/null 2>&1 &
echo "Os scripts foram stopados" 