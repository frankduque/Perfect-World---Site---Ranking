#!/bin/bash
# Este crontab é necessário para ativar as funções do crontab do painel

(crontab -l 2>/dev/null; echo "* * * * * php ${PWD}/index.php cron") | crontab -
