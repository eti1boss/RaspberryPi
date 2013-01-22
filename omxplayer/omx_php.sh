#!/bin/sh
sudo sh -c "./cls.sh"
omxplayer -p -o hdmi -o local "$1" </var/www/omxplayer/omxplayer_fifo >/dev/null 2>&1 &
sleep 1
echo -n . >/var/www/omxplayer/omxplayer_fifo
