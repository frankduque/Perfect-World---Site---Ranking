<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('convertToBase64')) {

    function get_guild_icons() {
        $iconlisttxt = FCPATH . 'assets/upload/guildicons/iconlist_guild.txt';
        $iconlistpng = FCPATH . 'assets/upload/guildicons/iconlist_guild.png';
        $handle = fopen($iconlisttxt, "r");
        if ($handle) {
            $i = 1;
            $icones = array();
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, 'dds') !== false) {
                    $line = explode("_", $line);
                    $line = explode(".", $line[1]);
                    $icones[$line[0]] = $i;
                    $i++;
                }
            }
            fclose($handle);
        }
    }

}