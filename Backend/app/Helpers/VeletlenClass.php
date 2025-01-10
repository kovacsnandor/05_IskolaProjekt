<?php
namespace App\Helpers;


class VeletlenClass
{
    public static function randomVaros():string
    {
        $varosok = ['Budapest', 'Debrecen', 'Szeged', 'Pécs'];

        $randomIndex = array_rand($varosok);
        $veletlenVaros = $varosok[$randomIndex];
        return $veletlenVaros;
    }
}