<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('get_guild_icons')) {

    function get_guild_icons() {
        $iconlisttxt = FCPATH . 'assets/upload/guildicons/iconlist_guild.txt';
        $iconlistpng = FCPATH . 'assets/upload/guildicons/iconlist_guild.png';
        if (file_exists($iconlisttxt) and file_exists($iconlistpng)) {
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
                return $icones;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function get_guild_icon($icones, $owner) {
        if ($owner > 0) {
            if (isset($icones[$owner])) {
                $posicao = $icones[$owner];
                $linha = ceil($posicao / 16);
                return array(
                  "linha" => ceil($posicao / 16),
                  "coluna" => $posicao - ($linha - 1) * 16,
                  "default" => false
                );
            } else {
                return array(
                  "linha" => 0,
                  "coluna" => 0,
                  "default" => true
                );
            }
        } else {
            return array();
        }
    }

}