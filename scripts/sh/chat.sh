#!/bin/bash
PWPATH='/home'

tail -f -n 1 ${PWPATH}/logservice/logs/world2.chat | while read LINE
do	
  set -- $LINE
  CHAR_ID="$(echo "$8" | cut -d'=' -f 2)"
  CANAL="$(echo "$9" | cut -d'=' -f 2)"
  shift
  MENSAGEM_BASE64="$(echo "$9" | cut -c 5-)"
  php index.php chat chat_controll "${CHAR_ID}" "${CANAL}" "${MENSAGEM_BASE64}"
done

 