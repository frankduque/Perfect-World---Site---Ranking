<?php

use SebastianBergmann\CodeCoverage\Report\PHP;

defined('BASEPATH') or exit('No direct script access allowed');

class Gamed_model extends CI_Model
{

    public $cycle = false;
    public $online;
    public $protocol;
    public $pos = null;

    public function __construct()
    {
        $this->cycle = false;
        $this->online = $this->serverOnline();
        $this->protocol = $this->config->item("protocolo" . $this->config->item("versaoservidor"));
    }

    public function serverOnline()
    {
        return (@fsockopen('127.0.0.1', $this->config->item("ports")['gamedbd'], $errCode, $errStr, 1) ? TRUE : FALSE);
    }

    public function getRole($charid)
    {
        $pack = pack("N*", -1, $charid);
        $pack = $this->createHeader($this->protocol['code']['getRole'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']);

        if (!is_array($user)) {
            $user['base'] = $this->getRoleBase($charid);
            $user['status'] = $this->getRoleStatus($charid);
            $user['pocket'] = $this->getRoleInventory($charid);
            $user['equipment'] = $this->getRoleEquipment($charid);
            $user['storehouse'] = $this->getRoleStoreHouse($charid);
            $user['task'] = $this->getRoleTask($charid);
        }
        return $user;
    }

    public function getRoleBase($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleBase'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']['base']);
        return $user;
    }

    public function getRoleStatus($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleStatus'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']['status']);

        return $user;
    }

    public function getRoleInventory($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleInventory'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']['pocket']);

        return $user;
    }

    public function getRoleEquipment($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleEquipment'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']['equipment']);

        return $user;
    }

    public function getRoleStorehouse($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleStoreHouse'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $store = $this->unmarshal($data, $this->protocol['role']['storehouse']);

        return $store;
    }

    public function getRoleTask($role)
    {
        $pack = pack("N*", -1, $role);
        $pack = $this->createHeader($this->protocol['code']['getRoleTask'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $user = $this->unmarshal($data, $this->protocol['role']['task']);

        return $user;
    }

    public function getUser($id)
    {
        $pack = pack("N*", -1, $id, 1, 1);
        $data = $this->cuint($this->protocol['code']['getUser']) . $this->cuint(strlen($pack)) . $pack;
        $send = $this->SendToGamedBD($data);
        $strlarge = unpack("H", substr($send, 2, 1));
        if (substr($strlarge[1], 0, 1) == 8) {
            $tmp = 12;
        } else {
            $tmp = 11;
        }
        $send = substr($send, $tmp);
        $user = $this->unmarshal($send, $this->protocol['user']['info']);
        $user['login_ip'] = $this->getIp($this->reverseOctet(substr($user['login_record'], 8, 8)));
        $user['login_time'] = $this->getTime(substr($user['login_record'], 0, 8));

        return $user;
    }

    public function getUserFaction($charid)
    {
        $tmp = 0;
        $pack = pack("N*", -1, 1, $charid);
        $data = $this->SendToGamedBD($this->createHeader($this->protocol['code']['getUserFaction'], $pack));
        $this->unpackCuint($data, $tmp);
        $this->unpackCuint($data, $tmp);
        $data = substr($data, $tmp + 8);
        return $this->unmarshal($data, $this->protocol['getUserFaction']);
    }

    public function getRoles($conta_id)
    {
        $pack = pack("N*", -1, $conta_id);
        $pack = $this->createHeader($this->protocol['code']['getUserRoles'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        $roles = $this->unmarshal($data, $this->protocol['user']['roles']);
        return $roles;
    }

    public function getFactionDetail($faction_id)
    {
        $pack = pack("N*", -1, $faction_id);
        $pack = $this->createHeader($this->protocol['code']['getFactionDetail'], $pack);
        $send = $this->SendToGamedBD($pack);
        $data = $this->deleteHeader($send);
        return $this->unmarshal($data, $this->protocol['FactionDetail']);
    }

    public function worldChat($role, $msg, $chanel)
    {
        $pack = pack("CCN", $chanel, 0, $role) . $this->packString($msg) . $this->packOctet('');
        $this->SendToProvider($this->createHeader($this->protocol['code']['worldChat'], $pack));
        return true;
    }

    function chat2player($char_id, $mensagem)
    {
        global $config;
        $pack = pack("CC", 1, 0);
        $pack .= $this->packString("") . pack("N", $char_id);
        $pack .= $this->packString("") . pack("N", $char_id);
        $pack .= $this->packString($mensagem) . $this->packOctet('');
        $pack .= pack("N", 0);
        $this->SendToProvider($this->createHeader(96, $pack));
    }

    public function getTerritories()
    {
        $pack = pack("N*", -1, 1);
        $data = $this->SendToGamedBD($this->createHeader($this->protocol['code']['getTerritory'], $pack));
        $length = 0;
        $this->unpackCuint($data, $length);
        $this->unpackCuint($data, $length);
        $length += 6;
        $data = substr($data, $length);
        return $this->unmarshal($data, $this->protocol['GTerritoryDetail']);
    }

    public function getOnlineList()
    {
        // for ($i = 0; $i < 1024; $i++) {
        //     $online = [];
        //     if ($this->online) {
        //         $id = 0;
        //         $pack = pack('N*', 1, $i, $id) . $this->packString('1');
        //         $pack = $this->createHeader($this->protocol['code']['getOnlineList'], $pack);
        //         $send = $this->SendToDelivery($pack);
        //        // $data = $this->deleteHeader($send);
        //         $data = $this->unmarshal($data, $this->protocol['RoleList']);
        //         var_dump($data);
        //         if (isset($data['users'])) {
        //             foreach ($data['users'] as $user) {
        //                 $online[] = $user;
        //             }
        //         }
        //     }
        //     if (count($online) > 0) {
        //         echo "i = $i";
        //         echo PHP_EOL;
        //         echo "buscou personagens: " . count($online);
        //     }

        // }
        $online = [];
        if ($this->online) {
            $id = 0;
            $pack = pack('N*', 1024, 1, $id) . $this->packString('');
            $pack = $this->createHeader($this->protocol['code']['getOnlineList'], $pack);
            $send = $this->SendToDelivery($pack);
            $data = $this->deleteHeader($send);
            $data = $this->unmarshal($data, $this->protocol['RoleList']);
            if (isset($data['users'])) {
                foreach ($data['users'] as $user) {
                    $online[] = $user;
                }
            }
        }
        return $online;
    }

    public function DBGetConsumeInfosArg($id)
    {

        $pack = pack('NCN', -1, 1, $id);
        $data = $this->SendToGamedBD($this->createHeader($this->protocol['code']['getUserExtraInfo'], $pack));
        $retorno = $this->unmarshal($data, $this->protocol['getUserExtraInfo']);
        $ip[0] = $retorno['login_ip'] & 0xFF;
        $ip[1] = ($retorno['login_ip'] >> 8) & 0xFF;
        $ip[2] = ($retorno['login_ip'] >> 16) & 0xFF;
        $ip[3] = ($retorno['login_ip'] >> 24) & 0xFF;
        $retorno['login_ip'] = "{$ip[0]}.{$ip[1]}.{$ip[2]}.{$ip[3]}";
        return $retorno;
    }

    public function sendGold($id, $quantidade)
    {
        $pack = pack('N*', $id, $quantidade);
        $data = $this->SendToGamedBD($this->createHeader($this->protocol['code']['sendGold'], $pack));
        log_message('error', 'sendGold: ' . $this->protocol['code']['sendGold']);
        return $data;

    }

    /*                                                                      /                
     *                                                                      /
     *                                                                      /
     *          --------------------------------------------------          /
     *                                                                      /
     *                                                                      /
     */

    public function deleteHeader($data)
    {
        $length = 0;
        $this->unpackCuint($data, $length);
        $this->unpackCuint($data, $length);
        $length += 8;
        $data = substr($data, $length);
        return $data;
    }

    public function createHeader($opcode, $data)
    {
        return $this->cuint($opcode) . $this->cuint(strlen($data)) . $data;
    }

    public function packString($data)
    {
        $data = iconv("UTF-8", "UTF-16LE", $data);
        return $this->cuint(strlen($data)) . $data;
    }

    public function packLongOctet($data)
    {
        return pack("n", strlen($data) + 32768) . $data;
    }

    public function packOctet($data)
    {
        $data = pack("H*", (string) $data);
        return $this->cuint(strlen($data)) . $data;
    }

    public function packInt($data)
    {
        return pack("N", $data);
    }

    public function packByte($data)
    {
        return pack("C", $data);
    }

    public function packFloat($data)
    {
        return strrev(pack("f", $data));
    }

    public function packShort($data)
    {
        return pack("n", $data);
    }

    public function packLong($data)
    {
        $left = 0xffffffff00000000;
        $right = 0x00000000ffffffff;
        $l = ($data & $left) >> 32;
        $r = $data & $right;
        return pack('NN', $l, $r);
    }

    public function hex2octet($tmp)
    {
        $t = 8 - strlen($tmp);
        for ($i = 0; $i < $t; $i++) {
            $tmp = '0' . $tmp;
        }
        return $tmp;
    }

    public function reverseOctet($str)
    {
        $octet = '';
        $length = strlen($str) / 2;
        for ($i = 0; $i < $length; $i++) {
            $tmp = substr($str, -2);
            $octet .= $tmp;
            $str = substr($str, 0, -2);
        }
        return $octet;
    }

    public function hex2int($value)
    {
        $value = str_split($value, 2);
        $value = $value[3] . $value[2] . $value[1] . $value[0];
        $value = hexdec($value);
        return $value;
    }

    public function getTime($str)
    {
        return hexdec($str);
    }

    public function getIp($str)
    {
        return long2ip(hexdec($str));
    }

    public function putIp($str)
    {
        $ip = ip2long($str);
        $ip = dechex($ip);
        $ip = hexdec($this->reverseOctet($ip));
        return $ip;
    }

    public function cuint($data)
    {
        if ($data < 64)
            return strrev(pack("C", $data));
        else if ($data < 16384)
            return strrev(pack("S", ($data | 0x8000)));
        else if ($data < 536870912)
            return strrev(pack("I", ($data | 0xC0000000)));
        return strrev(pack("c", -32) . pack("i", $data));
    }

    public function unpackLong($data)
    {
        //$data = pack("H*", $data);
        $set = unpack('N2', $data);
        return $set[1] << 32 | $set[2];
    }

    public function unpackOctet($data, &$tmp)
    {
        $p = 0;
        $size = $this->unpackCuint($data, $p);
        $octet = bin2hex(substr($data, $p, $size));
        $tmp = $tmp + $p + $size;
        return $octet;
    }

    public function unpackString($data, &$tmp)
    {
        $size = (hexdec(bin2hex(substr($data, $tmp, 1))) >= 128) ? 2 : 1;
        $octetlen = (hexdec(bin2hex(substr($data, $tmp, $size))) >= 128) ? hexdec(bin2hex(substr($data, $tmp, $size))) - 32768 : hexdec(bin2hex(substr($data, $tmp, $size)));
        $pp = $tmp;
        $tmp += $size + $octetlen;
        return mb_convert_encoding(substr($data, $pp + $size, $octetlen), "UTF-8", "UTF-16LE");
    }

    public function unpackCuint($data, &$p)
    {
        if ($this->config->item('version') != '07') {
            $hex = hexdec(bin2hex(substr($data, $p, 1)));
            $min = 0;
            if ($hex < 0x80) {
                $size = 1;
            } else if ($hex < 0xC0) {
                $size = 2;
                $min = 0x8000;
            } else if ($hex < 0xE0) {
                $size = 4;
                $min = 0xC0000000;
            } else {
                $p++;
                $size = 4;
            }
            $data = (hexdec(bin2hex(substr($data, $p, $size))));
            $unpackCuint = $data - $min;
            $p += $size;
            return $unpackCuint;
        } else {
            $byte = unpack("Carray", substr($data, $p, 1));
            if ($byte['array'] < 0x80) {
                $p++;
            } else if ($byte['array'] < 0xC0) {
                $byte = unpack("Sarray", strrev(substr($data, $p, 2)));
                $byte['array'] -= 0x8000;
                $p += 2;
            } else if ($byte['array'] < 0xE0) {
                $byte = unpack("Iarray", strrev(substr($data, $p, 4)));
                $byte['array'] -= 0xC0000000;
                $p += 4;
            } else {
                $prom = strrev(substr($data, $p, 5));
                $byte = unpack("Iarray", strrev($prom));
                $p += 4;
            }
            return $byte['array'];
        }
    }

    public function sendMail($receiver, $title, $context, $money, $item = array())
    {
        if ($item === array()) {
            $item = array(
                'id' => 0,
                'pos' => 0,
                'count' => 0,
                'max_count' => 0,
                'data' => '',
                'proctype' => 0,
                'expire_date' => 0,
                'guid1' => 0,
                'guid2' => 0,
                'mask' => 0
            );
        }

        $pack = pack("NNCN", 344, 1025, 3, $receiver) . $this->packString($title) . $this->packString($context);
        $pack .= $this->marshal($item, $this->protocol['role']['pocket']['inv']);
        $pack .= pack("N", $money);

        return $this->SendToDelivery($this->createHeader($this->protocol['code']['sendMail'], $pack));
    }

    public function SendToGamedBD($data)
    {
        return $this->SendToSocket($data, $this->config->item('ports')['gamedbd']);
    }

    public function SendToDelivery($data)
    {
        return $this->SendToSocket($data, $this->config->item('ports')['gdeliveryd'], true);
    }

    public function SendToProvider($data)
    {
        return $this->SendToSocket($data, $this->config->item('ports')['gacd']);
    }

    public function SendToSocket($data, $port, $RecvAfterSend = false, $buf = null)
    {
        if (@fsockopen('127.0.0.1', $port, $errCode, $errStr, 1)) {
            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_connect($sock, '127.0.0.1', $port);
            if ($this->config->item('s_block'))
                socket_set_block($sock);
            if ($RecvAfterSend)
                socket_recv($sock, $tmp, 8192, 0);
            socket_send($sock, $data, strlen($data), 0);
            switch ($this->config->item('s_readtype')) {
                case 1:
                    socket_recv($sock, $buf, $this->config->item('maxbuffer'), 0);
                    break;
                case 2:
                    $buffer = socket_read($sock, 1024, PHP_BINARY_READ);
                    while (strlen($buffer) == 1024) {
                        $buf .= $buffer;
                        $buffer = socket_read($sock, 1024, PHP_BINARY_READ);
                    }
                    $buf .= $buffer;
                    break;
                case 3:
                    $tmp = 0;
                    $buf .= socket_read($sock, 1024, PHP_BINARY_READ);
                    if (strlen($buf) >= 8) {
                        $this->unpackCuint($buf, $tmp);
                        $length = $this->unpackCuint($buf, $tmp);
                        while (strlen($buf) < $length) {
                            $buf .= socket_read($sock, 1024, PHP_BINARY_READ);
                        }
                    }
                    break;
            }
            if ($this->config->item('s_block'))
                socket_set_nonblock($sock);
            socket_close($sock);
            return $buf;
        } else {
            //flash()->error( trans( 'pw-api-messages.server_connect_failed' ) );
            return FALSE;
        }
    }

    function debug_packet($pack)
    {

        // Converte a string hexadecimal para um array de valores decimais
        $decimalValues = unpack('C*', $pack);

        // Imprime os valores decimais
        foreach ($decimalValues as $decimal) {
            echo $decimal . ' ';
        }
        echo PHP_EOL;
    }

    public function unmarshal(&$rb, $struct)
    {

        $debug = false;
        $data = array();
        foreach ($struct as $key => $val) {
            if (is_array($val)) {
                if ($this->cycle) {
                    if ($this->cycle > 0) {
                        for ($i = 0; $i < $this->cycle; $i++) {
                            $data[$key][$i] = $this->unmarshal($rb, $val);
                            if (!$data[$key][$i])
                                return false;
                        }
                    }
                    $this->cycle = false;
                } else {
                    $data[$key] = $this->unmarshal($rb, $val);
                    if (!$data[$key])
                        return false;
                }
            } else {
                $tmp = 0;
                switch ($val) {
                    case 'int':
                        //debug
                        $un = unpack("N", substr($rb, 0, 4));
                        $rb = substr($rb, 4);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }

                        $data[$key] = $un[1];
                        break;
                    case 'int64':
                        $un = unpack("N", substr($rb, 0, 8));
                        $rb = substr($rb, 8);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }
                        $data[$key] = $un[1];
                        break;
                    case 'long':
                        $data[$key] = $this->unpackLong(substr($rb, 0, 8));
                        $rb = substr($rb, 8);
                        break;
                    case 'lint':
                        //$un = unpack("L", substr($rb,0,4));
                        $un = unpack("V", substr($rb, 0, 4));
                        $rb = substr($rb, 4);
                        $data[$key] = $un[1];
                        break;
                    case 'byte':
                        $un = unpack("C", substr($rb, 0, 1));
                        $rb = substr($rb, 1);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }
                        $data[$key] = $un[1];
                        break;
                    case 'cuint':
                        $cui = $this->unpackCuint($rb, $tmp);
                        $rb = substr($rb, $tmp);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $cui . PHP_EOL;
                        }
                        if ($cui > 0)
                            $this->cycle = $cui;
                        else
                            $this->cycle = -1;
                        break;
                    case 'octets':
                        $octets = $this->unpackOctet($rb, $tmp);
                        $data[$key] = $octets;
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $octets . PHP_EOL;
                        }
                        $rb = substr($rb, $tmp);
                        break;
                    case 'name':
                        $name = $this->unpackString($rb, $tmp);
                        $data[$key] = $name;
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $name . PHP_EOL;
                        }
                        $rb = substr($rb, $tmp);
                        break;
                    case 'short':
                        $un = unpack("n", substr($rb, 0, 2));
                        $rb = substr($rb, 2);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }
                        $data[$key] = $un[1];
                        break;
                    case 'lshort':
                        $un = unpack("v", substr($rb, 0, 2));
                        $rb = substr($rb, 2);
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }
                        $data[$key] = $un[1];
                        break;
                    case 'float2':
                        $un = unpack("f", substr($rb, 0, 4));
                        $rb = substr($rb, 4);
                        $data[$key] = $un[1];
                        break;
                    case 'float':
                        $un = unpack("f", strrev(substr($rb, 0, 4)));
                        $rb = substr($rb, 4);
                        $data[$key] = $un[1];
                        if ($debug) {
                            echo "Chave: $key - Valor: " . $un[1] . PHP_EOL;
                        }
                        break;
                }
                if ($val != 'cuint' and is_null($data[$key]))
                    return false;
            }
        }
        return $data;
    }

    public function marshal($pack, $struct)
    {
        $this->cycle = false;
        $data = '';
        foreach ($struct as $key => $val) {
            if (substr($key, 0, 1) == "@")
                continue;
            if (is_array($val)) {
                if ($this->cycle) {
                    if ($this->cycle > 0) {
                        $count = $this->cycle;
                        for ($i = 0; $i < $count; $i++) {
                            $data .= $this->marshal($pack[$key][$i], $val);
                        }
                    }
                    $this->cycle = false;
                } else {
                    $data .= $this->marshal($pack[$key], $val);
                }
            } else {
                switch ($val) {
                    case 'int':
                        $data .= $this->packInt((int) $pack[$key]);
                        break;
                    case 'byte':
                        $data .= $this->packByte($pack[$key]);
                        break;
                    case 'cuint':
                        $arrkey = substr($key, 0, -5);
                        $cui = isset($pack[$arrkey]) ? count($pack[$arrkey]) : 0;
                        $this->cycle = ($cui > 0) ? $cui : -1;
                        $data .= $this->cuint($cui);
                        break;
                    case 'octets':
                        if ($pack[$key] === array())
                            $pack[$key] = '';
                        $data .= $this->packOctet($pack[$key]);
                        break;
                    case 'name':
                        if ($pack[$key] === array())
                            $pack[$key] = '';
                        $data .= $this->packString($pack[$key]);
                        break;
                    case 'short':
                        $data .= $this->packShort($pack[$key]);
                        break;
                    case 'float':
                        $data .= $this->packFloat($pack[$key]);
                        break;
                    case 'cat1':
                    case 'cat2':
                    case 'cat4':
                        $data .= $pack[$key];
                        break;
                }
            }
        }
        return $data;
    }

    public function MaxOnlineUserID($arr)
    {
        $max = $arr[0]['userid'];
        for ($i = 1; $i < count($arr); $i++) {
            if ($arr[$i]['userid'] > $max) {
                $max = $arr[$i]['userid'];
            }
        }
        return $max + 1;
    }

    public function getArrayValue($array = array(), $index = null)
    {
        return $array[$index];
    }

}
