#!/bin/bash
PWPATH='/home'

tail -f -n 1 ${PWPATH}/logs/world2.formatlog | while read LINE0
do	
        
if KILL="$(echo "${LINE0}" | grep 'type=258:attacker\|type=2:attacker')"
then 
  set -- $KILL
  MATOU_ID="$(echo "$7" | cut -d':' -f 5 | cut -d'=' -f 2)"
  MORREU_ID="$(echo "$7" | cut -d':' -f 3 | cut -d'=' -f 2)"
  php index.php competitivo salvar_kill "${MATOU_ID}" "${MORREU_ID}"
fi 
done
