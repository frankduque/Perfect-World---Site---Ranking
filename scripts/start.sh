#!/bin/bash
SERVICEF="formatlog.sh"
if pgrep -x "$SERVICEF" >/dev/null
then
    echo "O script formatlog já está sendo executado."
else
${PWD}/sh/formatlog.sh >${PWD}/logs/format.log &
    echo "O script formatlog foi iniciado."

fi

SERVICEC="chat.sh"
if pgrep -x "$SERVICEC" >/dev/null
then
    echo "O script de chat já está sendo executado."
else
${PWD}/sh/chat.sh >${PWD}/logs/chat.log &
    echo "O script chat foi iniciado."

fi
 
