#!/bin/bash

# Este crontab é opcional. Ele garante que os scripts estejam sendo executados
(crontab -l 2>/dev/null; echo "*/5 * * * * ${PWD}/start.sh") | crontab -